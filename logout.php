<?php

require_once('classes/Sentry.php');
require_once('classes/DBLink.php');
require_once('classes/Logger.php');

$theSentry = new Sentry();
$theDB     = new DBLink();
$theLogger = new Logger($theDB);

$theLogger->log("User ".$_SESSION['username']." logged out");
$theSentry->logout();

header('Location: login.php');

?>
