<?php

/**
 * Part of the SendGrid Laravel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    SendGrid Laravel
 * @version    1.0.0
 * @author     Jose Lorente
 * @license    BSD License (3-clause)
 * @copyright  (c) 2019, Jose Lorente
 */

namespace Jlorente\Laravel\SendGrid\Notifications\Channel;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Jlorente\SendGrid\SendGrid;

/**
 * Class SendGridEmailChannel.
 * 
 * A notification channel to send emails through SendGrid API.
 *
 * @author Jose Lorente <jose.lorente.martin@gmail.com>
 */
class SendGridEmailChannel
{

    /**
     * The SendGrid client instance.
     *
     * @var SendGrid
     */
    protected $client;

    /**
     * Create a new SendGrid channel instance.
     *
     * @param SendGrid $client
     * @return void
     */
    public function __construct(SendGrid $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return array|bool
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('sendgrid', $notification)) {
            $to = $notifiable->email;
            if (!$to) {
                return;
            }
        }

        $message = $notification->toSendGrid($notifiable);

        if (config('sendgrid.is_channel_active') === false) {
            return true;
        }

        try {
            return $this->client->send($message);
        } catch (\Exception $ex) {
            Log::error('SendGrid API Exception', [
                'code' => $ex->getCode()
                , 'file' => $ex->getFile()
                , 'line' => $ex->getLine()
                , 'message' => $ex->getMessage()
            ]);

            if (config('sendgrid.raise_exception_on_error') === true) {
                throw $ex;
            }
        }
    }

}
