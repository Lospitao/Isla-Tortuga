<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Notifications.php");


$limit = 10; //Number of Notifications to load
$notification = new Notifications($conn, $_REQUEST['userLoggedIn']);
echo $notification->getConvosDropdown($_REQUEST, $limit);