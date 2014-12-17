<?php
// define site name
define('SITE_NAME', 'SimpleLance DEV');

// define site URL
define('SITE_URL', 'simplelance.dev');

// define database settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'vagrant');
define('DB_NAME', 'vagrant');

// define currency
define('CURRNAME', 'Euro');
define('CURRSYM', '&euro;');
define('CURRCODE', 'EUR');

// define email settings
define('EMAIL_SERVER', 'smtp-server');
define('EMAIL_PORT', 'smtp-port'); // 25/587
define('EMAIL_SECURITY', 'smtp-security'); // tls/ssl/none
define('EMAIL_USER', 'smtp-user');
define('EMAIL_PASSWORD', 'smtp-password');
define('EMAIL_FROM_ADDRESS', 'smtp-from');
define('EMAIL_FROM_NAME', SITE_NAME);

// define admin user details
define('ADMIN_NAME', 'ADMIN USER');
define('ADMIN_EMAIL', 'admin@simplelance.com');

// set stripe keys
$stripe = array(
    "publishable_key" => "pk_key",
    "secret_key" => "sk_key"
);
