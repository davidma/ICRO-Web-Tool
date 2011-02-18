<?php

//-------------------------------------------------------
// config.php
//
// Main config file - move this outside the webroot
// and then update classes/DBLink.php to read the
// contents with a call to require() in the constructor
//
// Dave Masterson, Oct 2009
//-------------------------------------------------------

// Login Credentials for the DB
$DB_TYPE='mysql';
$DB_USER='root';
$DB_PASS='';
$DB_HOST='127.0.0.1';
$DB_NAME='icroweb';

// Login details for our clickatell.com account
$SMS_USERID = '';
$SMS_PASSWORD = '';
$SMS_API_ID = '';
$SMS_BASEURL = 'http://api.clickatell.com';
$SMS_FROMNUM  = '';

// Is this the main site or a mobile XAMMP copy?
// If its mobile, we disable stuff that won't work without internet access
$OFFLINE_SITE=false;

// Google Maps API Key
$MAPS_API_KEY = 'ABQIAAAAbnBxNRuqK_xq-3RWSAcTuhSYIHjq4wXVg1q_VOeO8u4GoSRl4hTYHp4V2aSR0o2-me1C0eix_E0DJQ';

?>
