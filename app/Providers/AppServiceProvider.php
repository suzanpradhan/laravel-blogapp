<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        //

        // Custom Email Format Sent to User

        VerifyEmail::toMailUsing(function($notifiable, $url){
            return (new MailMessage)
            ->subject("Email Verification For Blog App")
            ->line("Hi! \n Please click the button below to verify your account."
            )->action("Verify My Account", $url);
        });

    }
}
