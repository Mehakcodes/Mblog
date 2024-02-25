<?php
require 'config/constants.php';
//destroy all session and session data
session_destroy();
//redirect backto homepage
header('location:'. ROOT_URL);
die();