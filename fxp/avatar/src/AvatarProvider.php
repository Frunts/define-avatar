<?php
/**
 * @IDE: VS code 
 * @created_at: 2019-09-16 14:41 
 * @author: Fxp
 * 
 */
namespace Fxp\Avatar;

use Illuminate\Support\ServiceProvider;

class AvatarProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/avatar.php' => config_path('avatar.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('avatar', function($app){
            return new Avatar($app['config']);
        });
    }

}