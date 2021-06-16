SendGrid SDK for Laravel
=======================
Laravel integration for the [SendGrid PHP SDK](https://github.com/sendgrid/sendgrid-php) including a notification channel.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

With Composer installed, you can then install the extension using the following commands:

```bash
$ php composer.phar require jlorente/laravel-sendgrid
```

or add 

```json
...
    "require": {
        "jlorente/laravel-sendgrid": "*"
    }
```

to the ```require``` section of your `composer.json` file.

## Configuration

1. Register the ServiceProvider in your config/app.php service provider list.

config/app.php
```php
return [
    //other stuff
    'providers' => [
        //other stuff
        \Jlorente\Laravel\SendGrid\SendGridServiceProvider::class,
    ];
];
```

2. Add the following facade to the $aliases section.

config/app.php
```php
return [
    //other stuff
    'aliases' => [
        //other stuff
        'SendGrid' => \Jlorente\Laravel\SendGrid\Facades\SendGrid::class,
    ];
];
```

3. Publish the package configuration file.

```bash
$ php artisan vendor:publish --provider='Jlorente\Laravel\SendGrid\SendGridServiceProvider'
```

4. Set the api_key in the config/sendgrid.php file or use the predefined env 
variables.

config/sendgrid.php
```php
return [
    'api_key' => 'YOUR_API_KEY',
    //other configuration
];
```
or 
.env
```
//other configurations
SENDGRID_API_KEY=<YOUR_API_KEY>
```

## Usage

You can use the facade alias SendGrid to execute api calls. The authentication 
params will be automaticaly injected.

```php
SendGrid::send($mail);
```

## Notification Channels

A notification channel is included in this package and allow you to integrate 
the SendGrid send email service.

You can find more info about Laravel notifications in [this page](https://laravel.com/docs/5.6/notifications).

### SendGridEmailChannel

If you want to send an email through SendGrid, you should define a toSendGrid method 
on the notification class. This method will receive a $notifiable entity and 
should return a \SendGrid\Mail\Mail instance.

```php
/**
 * Get the Mail object instance.
 *
 * @param  mixed  $notifiable
 * @return \SendGrid\Mail\Mail
 */
public function toSendGrid($notifiable)
{
    $mail = new \SendGrid\Mail\Mail();
    $mail->setFrom();
    $mail->setTemplateId('d-4n23blaasjdgdg3242');
    $mail->addDynamicTemplateData('username', 'John');

    return $mail;
}
```

Once done, you must add the notification channel in the array of the via() method 
of the notification:

```php
/**
 * Get the notification channels.
 *
 * @param  mixed  $notifiable
 * @return array|string
 */
public function via($notifiable)
{
    return [SendGridEmailChannel::class];
}
```

### Routing the Notifications

When sending notifications via SendGrid channel, the notification system will 
automatically look for an email attribute on the notifiable entity. If 
you would like to customize the number you should define a routeNotificationForSendGrid
method on the entity:

```php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Route notifications for the SendGrid SMS channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSendGrid($notification)
    {
        return $this->email;
    }
}
```

## License 
Copyright &copy; 2021 José Lorente Martín <jose.lorente.martin@gmail.com>.

Licensed under the BSD 3-Clause License. See LICENSE.txt for details.
