<?php
namespace App\Middlewares;

use \Gino\Src\Request\Request;
use \Gino\Src\Middleware\Middleware;
use \Gino\Src\Logger\Logger;
use \Gino\Src\Exceptions\HttpExceptions\Unauthorized;

/**
 * Undocumented class
 */
class HealtMiddleware implements Middleware
{
    /**
     * Example Middleware
     *
     * @param Routing\Src\Request\Request $request
     *
     * @return void
     */
    public static function run(Request $request) : void
    {
        $logger = new Logger();
        $logger->info("Middleware check ok");
        $request->set('addFromMiddleware', ["key" => "value"]);
        // throw new Unauthorized('middelware not authorize!', 0);
    }
}