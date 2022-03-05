<?php
/**
 * Main
 *
 * PHP version 8
 *
 * @category Main
 * @package  Main
 * @author   Riccardo Curcio <curcioriccardo@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://url.com
 */
require_once __DIR__ . '/vendor/autoload.php';

use Swoole\HTTP\Server as SwoolServer;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Gino\Routing;
use Gino\Src\Logger\Logger;

use \App\Routes\HealtCheck\HealtCheck;

Gino\LoadEnv::load('.');


$app = new Routing();

HealtCheck::group($app, 'v1', 'exampleone', [\App\Middlewares\HealtMiddleware::class]);

$server = new SwoolServer(getenv("HOST"), getenv("PORT"));
$server->set(['enable_coroutine' => false]);

$server->on(
    "start",
    function (SwoolServer $server) {
        $logger = new Logger();
        $logger->info("Server http://" . $server->host . ":" . $server->port);
    }
);

$server->on(
    "request",
    function (SwooleRequest $request, SwooleResponse $response) use ($app) {
        $app->run($request, $response);
    }
);

$server->start();