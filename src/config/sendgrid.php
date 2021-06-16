<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Api Key
      |--------------------------------------------------------------------------
      |
      | The sendgrid API key.
     */
    'api_key' => env('SENDGRID_API_KEY'),
    /*
      |--------------------------------------------------------------------------
      | Is Channel Active
      |--------------------------------------------------------------------------
      |
      | Activates or deactivates the SendGrid channel.
     */
    'is_channel_active' => (bool) env('SENDGRID_CHANNEL_ACTIVE', true),
    /*
      |--------------------------------------------------------------------------
      | From Default Address
      |--------------------------------------------------------------------------
      |
      | Default address to set the message from value.
     */
    'from_default_address' => env('SENDGRID_FROM_DEFAULT_ADDRESS', env('MAIL_FROM_ADDRESS')),
    /*
      |--------------------------------------------------------------------------
      | From Default Name
      |--------------------------------------------------------------------------
      |
      | Default name to set the message from value.
     */
    'from_default_name' => env('SENDGRID_FROM_DEFAULT_NAME', env('MAIL_FROM_NAME')),
    /*
      |--------------------------------------------------------------------------
      | Raise Exception On Error
      |--------------------------------------------------------------------------
      |
      | Specifies if an exception has to be thrown when an error occurs in the channel.
     */
    'raise_exception_on_error' => (bool) env('SENDGRID_RAISE_EXCEPTION_ON_ERROR', false),
];
