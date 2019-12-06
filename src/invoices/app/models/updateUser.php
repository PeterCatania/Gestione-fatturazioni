<?php

require_once "../../vendor/autoload.php";
require_once "../../generated-conf/config.php";
require_once "UserModel.php";


// Takes raw data from the request
$user = json_decode($_POST['user'], true);

$userModel = new UserModel();
$userModel->updateUser($user['ids[]'], $user['usernames[]'], $user['emails[]'], $user['enabled']);

echo "true";
