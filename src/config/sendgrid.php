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
      | Raise Exception On Error
      |--------------------------------------------------------------------------
      |
      | Specifies if an exception has to be thrown when an error occurs in the channel.
     */
    'raise_exception_on_error' => (bool) env('SENDGRID_RAISE_EXCEPTION_ON_ERROR', false),
];
