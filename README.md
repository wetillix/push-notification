# push-notification
FCM push notification with PHP
<?php

require_once ('PushNotification.php');

$firebase = new VyconsultingGroup\PushNotifications\PushNotification(API_KEY);
$firebase->setMessage('test','Hello wolrd','1','1');
$firebase->setField(User_Token);
$firebase->execute();
