<?php

//Database
define('DB_HOST', 'rdbms.strato.de');
define('DB_NAME', 'dbs10429580');
define('DB_USER', 'dbu4571259');
define('DB_PASS', 'Anton17032000$');

// PayPal Configuration
$website_url = "https://ansgarhufnagel.de";
$api_url = "https://ansgarhufnagel/api";
define('PAYPAL_EMAIL', 'stein.torben@gmx.net'); 
define('IBAN', 'DE59 6809 2000 0050 6309 00');
define('BIC', 'GENODE61EMM');
define('KONTO_INHABER', 'Torben Stein');
define('RETURN_URL', $website_url . '/payment_success'); 
define('CANCEL_URL', $website_url . '/cancel'); 
define('NOTIFY_URL', $api_url . '/ipn'); 
define('CURRENCY', 'EUR'); 
define('SANDBOX', FALSE); // TRUE or FALSE 
define('LOCAL_CERTIFICATE', FALSE); // TRUE or FALSE

define('PASSWORD_BCRYPT', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e');
define('JWT_SECRET', 'farsightfestival2023');

if (SANDBOX === TRUE){
	$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
}else{
	$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
// PayPal IPN Data Validate URL
define('PAYPAL_URL', $paypal_url);

//mail
define('SMTP_HOST', 'smtp.strato.de');
define('SMTP_USER', 'mail@farsight-festival.de');
define('SMTP_PASSWORD', 'roterdino6');
define('MAIL_FROM', 'Farsight Festival');
define('MAIL_FROM_EMAIL', 'mail@farsight-festival.de');