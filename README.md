# Wetillix Push Notification Documentation

`wetillix/push-notification` is a simple and efficient PHP package for sending notifications via Firebase Cloud Messaging (FCM).

---

## **Installation**

Install the package via Composer:

```bash
composer require wetillix/push-notification
```

---

## **Configuration**

After installation, prepare your `firebase_credentials.json` file containing your FCM credentials. Store this file securely in your project.

---

## **Usage**

### **Initialization**

Import and initialize the service in your project, providing the path to the FCM credentials file in the constructor:

```php
use Wetillix\PushNotification\PushNotification;

$pushNotification = new PushNotification('/path/to/firebase_credentials.json');
```

---

### **Sending a Notification to a Specific Device**

Use the `sendPushNotificationToDevice` method to send a notification to a user:

```php
$response = $pushNotification->sendPushNotificationToDevice(
    token: 'device_token',
    data: [
        'key1' => 'value1',
        'key2' => 'value2'
    ]
);

```

---

### **Sending a Notification to a Topic**

Use the `sendPushNotificationToTopic` method to send a notification to all users subscribed to a topic:

```php
$response = $pushNotification->sendPushNotificationToTopic(
    topic: 'topic_name',
    data: [
        'key1' => 'value1',
        'key2' => 'value2'
    ]
);

```

---

## **Contribution**

Contributions are welcome! Follow these steps:

1. Fork the project.
2. Create a new branch: `git checkout -b my-branch`.
3. Make your changes.
4. Submit a Pull Request.

---

## **License**

This project is licensed under the [MIT](LICENSE) license.

---
