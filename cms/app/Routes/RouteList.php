<?php

namespace App\Routes;

class RouteList
{

    /*
    |--------------------------------------------------------------------------
    | Main Application Route List
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    |
    */

    /**
    * Returns a list of active routes
    * @return array list of routes
    */
    public static function routes()
    {
        return [
            ["uri" => "/", "action" => "get" ,"uses" => "IndexController@index"],
            ["uri" => "/queue", "action" => "get" ,"uses" => "IndexController@resolveAllQueues"],
            ["uri" => "/show", "action" => "get" ,"uses" => "IndexController@show"],
            ["uri" => "/", "action" => "post" ,"uses" => "IndexController@handle"],
        ];
    }
}
