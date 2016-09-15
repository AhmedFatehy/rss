<?php

namespace App\Providers;

//use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use SimplePie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Carbon::setLocale(config('app.locale'));
        Validator::extend('responded', function($attribute, $value, $parameters, $validator) {

            $feeds = new SimplePie();
            $feeds->set_feed_url($value);
            $feeds->set_timeout(1800);
            $feeds->cache = false;
            $feeds->force_feed(true);
            $feeds->init();
            $feeds->handle_content_type();
            if ($feeds->error()){
                return false;
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
