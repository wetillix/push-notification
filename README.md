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
    title: 'Notification Title',
    body: 'Notification Body',
    data: [
        'key1' => 'value1',
        'key2' => 'value2'
    ]
);

if ($response->isSuccessful()) {
    echo 'Notification sent successfully';
} else {
    echo 'Error: ' . $response->getError();
}
```

---

### **Sending a Notification to a Topic**

Use the `sendPushNotificationToTopic` method to send a notification to all users subscribed to a topic:

```php
$response = $pushNotification->sendPushNotificationToTopic(
    topic: 'topic_name',
    title: 'Notification Title',
    body: 'Notification Body',
    data: [
        'key1' => 'value1',
        'key2' => 'value2'
    ]
);

if ($response->isSuccessful()) {
    echo 'Notification sent successfully to the topic';
} else {
    echo 'Error: ' . $response->getError();
}
```

---

## **Error Handling**

Each response includes methods to check for success or detect errors:

- `isSuccessful()`: Returns `true` if the operation was successful.
- `getError()`: Returns the error message in case of failure.
- `getFailedTokens()`: Lists the tokens for which notification delivery failed.

---

## **Testing**

### **Configure the Testing Environment**

Create a `.env.testing` file with the FCM test parameters:

```env
FCM_CREDENTIALS_PATH=/path/to/firebase_credentials_test.json
```

### **Run Unit Tests**

The package includes PHPUnit tests. Run them with:

```bash
vendor/bin/phpunit
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
