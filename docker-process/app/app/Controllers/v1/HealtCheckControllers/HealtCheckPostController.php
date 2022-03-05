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
use Src\Domain\Services\v1\HealtCheckPostServices\HealtCheckPostServiceInterface;

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
     * Logger
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Service
     *
     * @var HealtCheckPostServiceInterface
     */
    private $healtCheckPostService;


    /**
     * Costructor HealtCheckPostController
     *
     * @param Src\Domain\Services\v1\HealtCheckPostServices\HealtCheckPostServiceInterface          $healtCheckPostService
     * @param \Psr\Log\LoggerInterface                                                              $logger
     *
     * @dependency Src\Domain\Services\v1\HealtCheckPostServices\HealtCheckPostService          $healtCheckPostService
     * @dependency Gino\Src\Logger\Logger                                                       $logger
     */
    public function __construct(
        HealtCheckPostServiceInterface $healtCheckPostService,
        LoggerInterface $logger
    ) {
        $this->healtCheckPostService = $healtCheckPostService;
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
            $this->healtCheckPostService->execute($request->get("body")),
            201
        );
    }
}
