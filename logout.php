<?php

require_once('classes/Sentry.php');

$theSentry = new Sentry();

$theSentry->logout();

header('Location: login.php');

?>
