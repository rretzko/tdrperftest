<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;

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
    public function boot(UrlGenerator $url)
    {
        /**
         * since FJR 2021.02.20
         * added per https:/laravel-news.com/laravel-5-4-key-too-long-error
         * to correct problem with Maria db max length
         *
         * edit includes adding: use Illuminate\Support\Facades\Schema;
         */
        Schema::defaultStringLength(191);

        /**
         * From caleb porzio
         * macro to make search function easier
         */
        Builder::macro('search', function($field, $string){

            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });

        /**
         * FROM: https://laracasts.com/discuss/channels/laravel/mixed-content-issue-content-must-be-served-as-https
         * to attempt to solve 'mixed content' error
         */
        //if(env('APP_ENV') !== 'local'){
        //    $url->forceSchema('https');
        //}

    }
}
