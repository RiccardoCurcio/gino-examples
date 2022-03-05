<?php
namespace Src\Domain\Services\v1\HealtCheckPostServices;

use Src\Domain\Services\v1\HealtCheckPostServices\HealtCheckPostServiceInterface;
use Src\Infrastructure\Repositories\v1\HealtCheckRepositories\HealtCheckRepositoryInterface;
use \Psr\Log\LoggerInterface;
use Gino\Src\Process\Process;

class HealtCheckPostService implements HealtCheckPostServiceInterface
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Repository
     *
     * @var HealtCheckRepositoryInterface
     */
    private $healtCheckRepository;

    /**
     * Costructor HealtCheckPostController
     * 
     * @param Src\Infrastructure\Repositories\v1\HealtCheckRepositories\HealtCheckRepositoryInterface   $healtCheckRepository
     * @param \Psr\Log\LoggerInterface                                                                  $logger
     *
     * @dependency Src\Infrastructure\Repositories\v1\HealtCheckRepositories\HealtCheckRepository   $healtCheckRepository
     * @dependency Gino\Src\Logger\Logger                                                           $logger
     */
    public function __construct(
        HealtCheckRepositoryInterface $healtCheckRepository,
        LoggerInterface $logger
    ) {
        $this->healtCheckRepository = $healtCheckRepository;
        $this->logger = $logger; 
    }

    public function execute(mixed $body) : array
    {
        $logger = $this->logger;
        $callback1 = function(mixed $input) use ($logger) {
            $logger->info("CB1 Start event callback");
            $logger->info($input);
            sleep(2);
            $logger->info("CB1 Finish event callback");
            return $input . " -> return cb1";
        };

        $callback2 = function(mixed $input) use ($logger) {
            $logger->info("CB2 Start event callback");
            $logger->info($input);
            sleep(2);
            $logger->info("CB2 Finish event callback");
            return $input . " -> return cb2";
        };

        $callback3 = function(mixed $input) use ($logger) {
            $logger->info("CB3 Start event callback");
            $logger->info($input);
            sleep(2);
            $logger->info("CB3 Finish event callback");
        };
        Process::asyncPipeline('input', [$callback1, $callback2, $callback3]);
        
        
        return $this->healtCheckRepository->checkPost($body);
    }
}
