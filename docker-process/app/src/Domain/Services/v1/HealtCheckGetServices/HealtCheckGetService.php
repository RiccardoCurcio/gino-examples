<?php
namespace Src\Domain\Services\v1\HealtCheckGetServices;

use Src\Domain\Services\v1\HealtCheckGetServices\HealtCheckGetServiceInterface;
use Src\Infrastructure\Repositories\v1\HealtCheckRepositories\HealtCheckRepositoryInterface;
use \Psr\Log\LoggerInterface;
use Gino\Src\Process\Process;

class HealtCheckGetService implements HealtCheckGetServiceInterface
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
     * Costructor HealtCheckController
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

    public function execute() : array
    {
        $logger = $this->logger;
        $callbackStorm1 = function() use (&$logger) {
            $logger->info("STORM CB1 Start event callback");
            sleep(5);
            $logger->info("STORM CB1 Finish event callback");
        };

        $callbackStorm2 = function() use (&$logger)  {
            $logger->info("STORM CB2 CB2 Start event callback");
            sleep(8);
            $logger->info("STORM CB2 Finish event callback");
        };

        $callbackStorm3 = function() use (&$logger)  {
            $logger->info("STORM CB3 CB3 Start event callback");
            sleep(6);
            $logger->info("STORM CB3 Finish event callback");
        };

        Process::asyncStorm([$callbackStorm1, $callbackStorm2, $callbackStorm3]);
        
        return $this->healtCheckRepository->checkGet();
    }
}
