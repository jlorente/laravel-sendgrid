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

namespace Jlorente\Laravel\SendGrid;

use Illuminate\Support\ServiceProvider;
use SendGrid;

/**
 * Class SendGridServiceProvider.
 * 
 * @author Jose Lorente <jose.lorente.martin@gmail.com>
 */
class SendGridServiceProvider extends ServiceProvider
{

    /**
     * @inheritdoc
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/sendgrid.php' => config_path('sendgrid.php'),
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->registerSendGrid();
    }

    /**
     * {@inheritDoc}
     */
    public function provides()
    {
        return [
            'sendgrid'
            , SendGrid::class
        ];
    }

    /**
     * Register the SendGrid API class.
     *
     * @return void
     */
    protected function registerSendGrid()
    {
        $this->app->singleton('sendgrid', function ($app) {
            return new SendGrid(config('sendgrid.api_key'));
        });

        $this->app->alias('sendgrid', SendGrid::class);
    }

}
