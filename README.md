# push-notification
FCM push notification with PHP
```php
<?php

require_once ('PushNotification.php');

$firebase = new PushNotification(API_KEY);
$firebase->setMessage('test','Hello wolrd',1,1);
$firebase->setField(User_Token);
$firebase->execute();
```
