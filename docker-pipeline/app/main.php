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
use Gino\Src\Process\Process;
use Gino\Src\Logger\Logger;

Gino\LoadEnv::load('.');


$app = new Routing();
$logger = new Logger();

$callback1 = function(mixed $input) use (&$logger) {
    $logger->info("**** Process CB1 Start calback");
    $input["data"] = 1;
    $logger->info("**** Process CB1 Finish calback");
    return $input;
};

$callback2 = function(mixed $input) use (&$logger) {
    $logger->info("**** Process CB2 Start calback");
    $input["data"] = $input["data"] + 1;
    $logger->info("**** Process CB2 Finish calback");
    return $input;
};

$callback3 = function(mixed $input) use (&$logger) {
    $logger->info("**** Process CB3 Start calback");
    $input["data"] = $input["data"] + 1;
    $logger->info("**** Process CB3 Finish calback");
    
    $input["response"]->response(
        $input["request"],
        [
            "msg" => $input["data"]
        ],
        200
    );
};

$app->get(
    'v1/pipeline',
    Process::class,
    [$callback1, $callback2, $callback3]
);

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