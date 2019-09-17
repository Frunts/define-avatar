<?php
/**
 * @IDE: VS code 
 * @created_at: 2019-09-16 14:41 
 * @author: Fxp
 * 
 */
namespace Fxp\Avatar\Facades;

use Illuminate\Support\Facades\Facade;

class Avatar extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'avatar';
    }

}