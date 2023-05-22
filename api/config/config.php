<?php

//Database
define('DB_HOST', 'rdbms.strato.de');
define('DB_NAME', 'dbs11006893');
define('DB_USER', 'dbu1504319');
define('DB_PASS', 'khri8gr4f1k2');

// PayPal Configuration
$website_url = "https://ansgar-hufnagel.de";
$api_url = "https://ansgar-hufnagel/api";
define('RETURN_URL', $website_url . '/payment_success'); 
define('CANCEL_URL', $website_url . '/cancel'); 
define('NOTIFY_URL', $api_url . '/ipn'); 
define('CURRENCY', 'EUR'); 
define('SANDBOX', FALSE); // TRUE or FALSE 
define('LOCAL_CERTIFICATE', FALSE); // TRUE or FALSE

define('PASSWORD_BCRYPT', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e');

if (SANDBOX === TRUE){
	$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
}else{
	$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
// PayPal IPN Data Validate URL
define('PAYPAL_URL', $paypal_url);

//mail
define('SMTP_HOST', 'smtp.strato.de');
define('SMTP_USER', 'shop@ansgar-hufnagel.de');
define('SMTP_PASSWORD', 'khri8gr4f1k2');
define('MAIL_FROM', 'Ansgar Hufnagel');
define('MAIL_FROM_EMAIL', 'shop@ansgar-hufnagel.de');