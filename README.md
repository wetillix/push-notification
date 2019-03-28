# push-notification
FCM push notification with PHP
-For one device :
```php
<?php

$firebase = new \VyconsultingGroup\PushNotification('API_KEY');
$firebase->setMessage('test','Hello wolrd',1,1);
$firebase->setField('User_Token');
$firebase->execute();
```
-For multiple device:
<?php

$firebase = new \VyconsultingGroup\PushNotification('API_KEY');
$firebase->setMessage('test','Hello wolrd',1,1);
$firebase->setFields('Users_Token');//Users_token should be an json
$firebase->execute();
