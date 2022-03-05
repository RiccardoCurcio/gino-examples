<?php
/**
 * Controller healtcheck
 *
 * PHP version 8
 *
 * @category Controller
 * @package  Controllers
 * @author   Riccardo Curcio <curcioriccardo@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://url.com
 */
namespace App\Controllers\v1\HealtCheckControllers;

use App\Controllers\Controller;
use \Gino\Src\Request\Request;
use \Gino\Src\Response\Response;

use Src\Application\Adapters\v1\HealtCheckAdapters\HealtCheckAdapterInterface;
use Src\Domain\Services\v1\HealtCheckServices\HealtCheckServiceInterface;

use \Psr\Log\LoggerInterface;

/**
 * Controller healtcheck
 *
 * @category Controller
 * @package  Controllers
 * @author   Riccardo Curcio <curcioriccardo@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://url.com
 */
class HealtCheckPostController extends Controller
{

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $logger;


    /**
     * Costructor HealtCheckPostController
     *
     * @param \Psr\Log\LoggerInterface                                                  $logger
     *
     * @dependency Gino\Src\Logger\Logger                                           $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Check methods
     *
     * @param \Gino\Src\Request\Request  $request
     * @param \Gino\Src\Response\Response $response
     *
     * @return void
     */
    public function check(Request $request, Response $response)
    {
        $this->logger->info("HealtCheckPostController v1");
        $response->response(
            $request,
            [
                "msg" => ["example" => "check post"]
            ],
            201
        );
    }
}
