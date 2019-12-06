<?php
require_once "../../vendor/autoload.php";
require_once "../../generated-conf/config.php";
require_once "UserModel.php";

$userId = $_POST['id'];

$userModel = new UserModel();
$userModel->deleteUserById($userId);

echo "{updatedUser: true}";
