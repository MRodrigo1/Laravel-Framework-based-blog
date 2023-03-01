<?php

namespace App\Providers;

use App\Models\User;
use App\Services\Newsletter; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Services\MailchimpNewsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function(){
            $client = new \MailchimpMarketing\ApiClient();

            $client->setConfig([
                'apiKey' =>config('services.mailchimp.key'),
                'server' => 'us21'
            ]);
            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Evitar erros mass assigning
        Model::unguard();

        Gate::define('admin', function(User $user){
            return $user->username === 'RMRodrigo';
        });
    }
}
