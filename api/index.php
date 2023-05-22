<?php
// Path: index.php

/* Handle CORS */

// Specify domains from which requests are allowed 'https://farsight-festival.de'
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

// Specify which request methods are allowed
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

// Set the age to 1 day to improve speed/caching.
header('Access-Control-Max-Age: 86400');


// Exit early so the page isn't fully loaded for options requests
if (strtolower($_SERVER['REQUEST_METHOD']) == 'options') {
    exit();
}

//require config file
require_once('config/config.php');
//require database class
require_once('classes/database.php');
//require customer class
require_once('classes/customer.php');
//require mail class
require_once('classes/mail.php');
//require user class
require_once('classes/user.php');
//require php mailer

$db = new DB();

//handle incoming post request on route index.php/checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/checkout') {
    //get post body
    $body = file_get_contents('php://input');
    //decode json
    $json = json_decode($body, true);
    //create customer object
    try {
        $customer = new customer($json['name'], $json['last_name'], $json['email'], $json['phone'], $json['street'], $json['city'], $json['zip'], $json['state'], $json['country'], $json['lineItems'], $json['total'], $json['payment_method']);
    } catch (Exception $e) {
        echo json_encode(array('error' => $e->getMessage()));
        die();
    }
    $mail = new mail($json['name'], $json['last_name'], $json['email'], $json['phone'], $json['street'], $json['city'], $json['zip'], $json['state'], $json['lineItems'], $json['total'], $json['payment_method']);
    $mail->sendConfirmationMail();
    //create customer in database
    $customer->create();
    //return customer id

    if ($customer->payment_method == "PayPal") {
        /* 
        $lineItems = $customer->lineItems;

        $products = json_decode($lineItems, true);

        $ids = [];
        $names = [];
        $prices = [];
        $quantities = [];
        $productIds = [];
        foreach ($products as $product) {
            $ids[] = $product['id'];
            $names[] = $product['name'];
            $prices[] = $product['price'];
            $quantities[] = $product['quantity'];
            $productIds[] = $product['id'];
        }

        //generate Paypal payment url
        $paypal_url = PAYPAL_URL;
        $paypal_id = PAYPAL_EMAIL;
        $return_url = RETURN_URL;
        $cancel_url = CANCEL_URL;
        $notify_url = NOTIFY_URL;
        $item_name = $names;
        $item_number = $productIds;
        $amount = $prices;
        $quantity = $quantities;
        $currency_code = CURRENCY;
        $custom = $customer->id;
        $total = 0;
        $querystring = '?business=' . urlencode($paypal_id) . '&';
        $querystring .= 'cmd=' . urlencode('_cart') . '&';
        $querystring .= 'return=' . urlencode(stripslashes($return_url) . '?cid=' . $customer->id) . '&';
        $querystring .= 'upload=' . 1 . '&';
        $querystring .= 'cancel_return=' . urlencode(stripslashes($cancel_url)) . '&';
        $querystring .= 'notify_url=' . urlencode($notify_url) . '&';
        $querystring .= 'currency_code=' . urlencode($currency_code);
        //add multiple items
        for ($i = 0; $i < count($products); $i++) {
            $item_id = $products[$i]['id'];
            $item_name = urlencode($products[$i]['name']);
            $item_price = $products[$i]['price'];
            $item_qty = $products[$i]['quantity'];

            $total += $item_price * $item_qty;
            $icount = $i + 1;
            $querystring .= "&item_name_$icount=$item_name&amount_$icount=$item_price&quantity_$icount=$item_qty";
        }
        /* $querystring .= '&item_count=' . count($products) . '&amount=' . $total; */
        //return json response with url key
        //echo json_encode(array('url' => $paypal_url . $querystring));
        echo json_encode(array('url' => 'https://ansgar-hufnagel.de/payment_success?cid=' . $customer->id . '&payment_method=' . $customer->payment_method));
    } else {
        echo json_encode(array('url' => 'https://ansgar-hufnagel.de/payment_success?cid=' . $customer->id . '&payment_method=' . $customer->payment_method));
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/approve_payment') {
    //get post body
    $body = file_get_contents('php://input');
    //decode json
    $json = json_decode($body, true);

    $customer = new customer();
    $customer_id = $json['customer_id'];
    $payment_id = $json['payment_id'];
    try {
        $customer->approvePayment($customer_id, $payment_id);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    echo json_encode(array('success' => true));
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/ipn') {
    //use notify.php to handle ipn
    /*
Read POST data
reading posted data directly from $_POST causes serialization
issues with array data in POST.
Reading raw POST data from input stream instead.
*/
    define("IPN_LOG_FILE", "ipn.txt");
    $raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
        $keyval = explode('=', $keyval);
        if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
    }

    // Build the body of the verification post request, 
    // adding the _notify-validate command.
    $req = 'cmd=_notify-validate';
    if (function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
    }
    foreach ($myPost as $key => $value) {
        if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
        } else {
            $value = urlencode($value);
        }
        $req .= "&$key=$value";
    }

    /*
Post IPN data back to PayPal using curl to 
validate the IPN data is valid & genuine
Anyone can fake IPN data, if you skip it.
*/
    $ch = curl_init(PAYPAL_URL);
    if ($ch == FALSE) {
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

    /*
This is often required if the server is missing a global cert
bundle, or is using an outdated one.
Please download the latest 'cacert.pem' from 
http://curl.haxx.se/docs/caextract.html
*/
    if (LOCAL_CERTIFICATE == TRUE) {
        curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/cert/cacert.pem");
    }

    // Set TCP timeout to 30 seconds
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Connection: Close',
        'User-Agent: PHP-IPN-Verification-Script'
    ));

    $res = curl_exec($ch);

    // cURL error
    if (curl_errno($ch) != 0) {
        curl_close($ch);
        exit;
    } else {
        curl_close($ch);
    }

    /* 
 * Inspect IPN validation result and act accordingly 
 * Split response headers and payload, a better way for strcmp 
 */
    $tokens = explode("\r\n\r\n", trim($res));
    $res = trim(end($tokens));

    if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {
        // assign posted variables to local variables
        $item_number = $_POST['item_number1'];
        $item_name = $_POST['item_name1'];
        $payment_status = $_POST['payment_status'];
        $amount = $_POST['mc_gross'];
        $currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        $receiver_email = $_POST['receiver_email'];
        $payer_id = $_POST['payer_id'];
        // $payer_email = $_POST['payer_email'];

        // check that receiver_email is your PayPal business email
        if (strtolower($receiver_email) != strtolower(PAYPAL_EMAIL)) {
            error_log(date('[Y-m-d H:i e] ') .
                "Invalid Business Email: $req" . PHP_EOL, 3, IPN_LOG_FILE);
            exit();
        }

        // check that payment currency is correct
        if (strtolower($currency) != strtolower(CURRENCY)) {
            error_log(date('[Y-m-d H:i e] ') .
                "Invalid Currency: $req" . PHP_EOL, 3, IPN_LOG_FILE);
            exit();
        }

        //Check Unique Transcation ID
        $dbConnection = new DB;
        $db->query("SELECT * FROM `payment_info` WHERE txn_id=:txn_id");
        $db->bind(':txn_id', $txn_id);
        $db->execute();
        $unique_txn_id = $db->rowCount();

        if (!empty($unique_txn_id)) {
            error_log(date('[Y-m-d H:i e] ') .
                "Invalid Transaction ID: $req" . PHP_EOL, 3, IPN_LOG_FILE);
            $db->close();
            exit();
        } else {
            $db->query("INSERT INTO `payment_info`
			(`item_number`, `item_name`, `payment_status`,
				 `amount`, `currency`, `txn_id`, `payer_id`)
			VALUES
			(:item_number, :item_name, :payment_status, 
				:amount, :currency, :txn_id, :payer_id)");
            $db->bind(":item_number", $item_number);
            $db->bind(":item_name", $item_name);
            $db->bind(":payment_status", $payment_status);
            $db->bind(":amount", $amount);
            $db->bind(":currency", $currency);
            $db->bind(":txn_id", $txn_id);
            $db->bind(":payer_id", $payer_id);
            $db->execute();
            /* error_log(date('[Y-m-d H:i e] '). 
		"Verified IPN: $req ". PHP_EOL, 3, IPN_LOG_FILE);
		*/
        }
        $db->close();
    } else if (strcmp($res, "INVALID") == 0) {
        //Log invalid IPN messages for investigation
        error_log(date('[Y-m-d H:i e] ') .
            "Invalid IPN: $req" . PHP_EOL, 3, IPN_LOG_FILE);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/api/votes') {
    $dbConnection = new DB;
    $db->query("SELECT * FROM `votes`");
    $db->execute();
    $votes = $db->resultSet();
    $db->close();
    echo json_encode(array('votes' => $votes));
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/user/create') {
    //handle user registration
    //get post body
    $body = file_get_contents('php://input');
    //decode json
    $json = json_decode($body, true);
    //get user info
    $name = $json['name'];
    $last_name = $json['last_name'];
    $email = $json['email'];
    $password = $json['password'];
    //get user email

    $newUser = new User;
    $status = $newUser->createUser($name, $last_name, $email, $password);
    if ($status) {
        echo json_encode(array('registered' => true));
    } else {
        echo json_encode(array('registered' => false));
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/user/login') {
    //handle user login
    //get post body
    $body = file_get_contents('php://input');
    //decode json
    $json = json_decode($body, true);
    //get user info
    $email = $json['email'];
    $password = $json['password'];

    $newUser = new User;
    $registered = $newUser->getUser($email);
    if ($registered) {
        if ($newUser->verifyPassword($password, $registered['password'])) {
            $customer = new Customer;
            $allCustomer = $customer->getAllCustomers();

            //return customer array
            echo json_encode(array('customers' => $allCustomer));
        } else {
            echo json_encode(array('logged_in' => false, 'message' => 'Keinen Benutzer gefunden mit dieser Email und Passwort'));
        }
    } else {
        echo json_encode(array('logged_in' => false, 'message' => 'Benutzer nicht registriert', 'email' => $email));
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/api/customer/payment') {
    //update customer payment status
    //get post body
    $body = file_get_contents('php://input');
    //decode json
    $json = json_decode($body, true);
    //get user info
    $customer_id = $json['customer_id'];
    $status = $json['status'];

    $customer = new Customer;
    $customer->updatePaymentStatus($customer_id, $status);
    echo json_encode(array('payment_status' => true));
} else {
    echo "Error: Invalid Request";
}
