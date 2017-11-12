![img](http://botomatic.io/themes/botomatic/assets/images/logo_green@2x.png)

# Botomatic v1.0

MIT License (MIT) Copyright (c) Links der Isar <http://www.linksderisar.com>


Botomatic is a web application framework build with [Laravel](http://laravel.com) designed for building chatbots for [Messenger Platform](https://developers.facebook.com/docs/messenger-platform/). Before reading this guide it is recommended to read the official documentation of Messenger Platform for a better understanding.

The approach is different that regular "one size fits all" frameworks, instead, by focusing on a specific platform we can make better use of it's functionality and approach.

---


### 1. Installation and configuration


__1.1 Clone the repository__

```cli
git clone https://github.com/Botomatic-PHP/Workbench.git Botomatic
```

__1.2 Environment configuration__

* Move `.env.example` to `.env`
* Make sure BOTOMATIC_FACEBOOK_DEBUG is set to true
* Set BOTOMATIC_FACEBOOK_TEST_URL to your local project url
* Setup any needed env. variables like database connection

__1.3 Install Botomatic__

* Install the framework with dependencies: `composer install`
* Generate an application key: `php artisan key:generate`
* Run migrations: `php artisan migrate`

---

### 2. Test locally

To test the bot locally, you have to use the CLI Bot. Keep in mind it's very limited and made to be used only for development purposes

```cli
php artisan bf:cli
```

You should see "Starting CLI Bot...:"

Type `hi`

It should respond with "Hello John Doe"

---

### 3. Hello World

In the most simple form, a chat conversation is a simple input -> output application and Botomatic is build around this concept. The conversations are split into smaller objects called __States__ that listen to messages and sends responses.

The default __State__ that picks up the message is called __Listener__. 

```php
App\Bot\Facebook\States\Listener\Listener
```

When you type "hi", the __Message Handler__ detects it


```php
App\Bot\Facebook\States\Listener\Handlers\Message
```


The state than sends the proper response from the __Responses Handler__

```php
App\Bot\Facebook\States\Listener\Handlers\Responses
```

Each __State__ has it's own __Message__ and __Response Handlers__

---

### 4. Register your bot with Facebook

Chatbots for Messenger Platform are Apps that are connected to specific Facebook pages. 

__4.1. Create Facebook App__

Go to [Facebook Apps](https://developers.facebook.com/apps/) and create a new one. From the Products selection choose __Messenger__

__4.2. Setup Webhook__

The webhook is the URL where Facebook will send messages from users, for development purposes it is recommeded you use services like ngrok to publicly share a local url. If you use Laravel Valet it's very easy, simply run `valet share`

Working with local url means you will need to update it evertime you run ngrok, you can update it from Facebook App's page under __Webhooks__ -> Edit Subscription

__4.3. Follow these steps to register your bot:__

* set "BOTOMATIC_FACEBOOK_CONFIRMATION" to true in .env file
* click on __Setup Webhooks__ from the App's settings and add your url with this route: `https://ngrok-url/webhook/facebook`
* inside "Verify Token" type "botomatic"
* from "Subscription Fields" select "messages" and "messaging_postbacks"
* click "Verify and Save"
* set BOTOMATIC_FACEBOOK_CONFIRMATION to false
* set BOTOMATIC_FACEBOOK_DEBUG to false

__4.4 Facebook Page__

Next, you need a Facebook page where the bot will be accesibly from, under "Token Generation" select the Facebook page you want to link your bot; a "Page Access Token" is now generated. 

Next we need to tell botomatic to what pages it responds, go `config/botomatic/facebook.php` to, in __pages__ node we store all pages that the bot has access to, grab the Facebook Page ID (you find this on Page's about section) and add it to the array with the access token.

Of course, you should store this information in .env file.

```php
   'pages' => [
        'page-id' => "Page Access Token"
    ],
```

Finally, we need to subscribe the Webhook to this page, under __Webhooks__ select the proper Facebook Page.

Now go to Facebook page and send a message.