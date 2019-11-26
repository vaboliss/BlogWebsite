<?php

error_reporting(E_ALL);

date_default_timezone_set('Europe/Vilnius');



$key = "";
$iss = "https://BlogApi.com";
$aud = "Basic User";
$iat = time() - 60;
$nbf = time();
$exp = date(strtotime("+1 hour"));
