# push-notification
FCM push notification with PHP

## INSTALLATION ##

```
 composer require vyconsulting-group/push-notification
 ```
 
-For one device :

```php
<?php
require 'vendor/autoload.php';
$firebase = new \VyconsultingGroup\PushNotification('API_KEY');
$firebase->setMessage('test','Hello wolrd',1,'default','high');
$firebase->setField('User_Token');
$firebase->execute();
```
-For multiple device:

```php
<?php
require 'vendor/autoload.php';
$firebase = new \VyconsultingGroup\PushNotification('API_KEY');
$firebase->setMessage('test','Hello wolrd',1,'default','high');
$firebase->setFields('Users_Token');//Users_tokens should be an array
$firebase->execute();
```
