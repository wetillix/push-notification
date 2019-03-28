# push-notification
FCM push notification with PHP
```php
<?php

$firebase = new \VyconsultingGroup\PushNotification('API_KEY');
$firebase->setMessage('test','Hello wolrd',1,1);
$firebase->setField('User_Token');
$firebase->execute();
```
