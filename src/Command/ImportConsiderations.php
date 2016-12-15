<?php
/**
 * Copyright © 2016 H&O E-commerce specialisten B.V. (http://www.h-o.nl/)
 * See LICENSE.txt for license details.
 */

namespace Ho\Review\Command;

use Ho\Bin\Helper\ConsoleOutput as ConsoleOutputHelper;
use Ho\Bin\Model\CleanQuotes\CriteriaPool;
use Ho\Bin\Model\CleanQuotes\QuoteCleanerResource;
use Magento\Framework\Api\SearchCriteriaInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportConsiderations extends Command
{
    const COMMAND_NAME      = 'ho:review:import';
    const OPTION_EXECUTE    = 'execute';

    /**
     * @var CriteriaPool
     */
    private $criteriaPool; // todo, remove

    /**
     * @var QuoteCleanerResource
     */
    private $quoteCleanerResource; // todo, remove

    /**
     * @var ConsoleOutputHelper
     */
    private $consoleOutputHelper; // todo, remove

    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    private $resourceConnection;

    /**
     * Constructor
     *
     * @param CriteriaPool         $criteriaPool
     * @param QuoteCleanerResource $quoteCleanerResource
     * @param ConsoleOutputHelper  $consoleOutputHelper
     * @param null                 $name
     */
    public function __construct(
//        CriteriaPool $criteriaPool,
//        QuoteCleanerResource $quoteCleanerResource,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        ConsoleOutputHelper $consoleOutputHelper,
        $name = null
    ) {
        parent::__construct($name);
//        $this->criteriaPool = $criteriaPool;
//        $this->quoteCleanerResource = $quoteCleanerResource;
        $this->resourceConnection = $resourceConnection;
        $this->consoleOutputHelper = $consoleOutputHelper;
    }

    /**
     * Configure the command.
     *
     * @return  void
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription("Import considerations from Magento 1.");
        $this->addOption(self::OPTION_EXECUTE, '-e', InputOption::VALUE_NONE, false);
    }

    /**
     * Import considerations.
     *
     * @param   InputInterface  $input
     * @param   OutputInterface $output
     *
     * @return  void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dbh = $this->resourceConnection->getConnection('m1_setup');
        var_dump($dbh);



//        $execute = $input->getOption(self::OPTION_EXECUTE);
//        if ($execute) {
//            $this->consoleOutputHelper->coolDownWarning($output, 'Deleting Quotes');
//        }

//        foreach ($this->criteriaPool->getList() as $criteria) {
//            $label = $criteria->getLabel();
//            // @codingStandardsIgnoreStart
//            $criteriaCount = count($criteria->getSearchCriteria());
//            // @codingStandardsIgnoreEnd
//
//            $progressBar = $this->consoleOutputHelper->createProgressBar($output, $criteriaCount);
//            $progressBar->setFormat($label . " => step %current%/%max% count: %message%");
//            $progressBar->start();
//
//            $count = 0;
//            foreach ($criteria->getSearchCriteria() as $searchCriteria) {
//                $quoteCollection = $this->quoteCleanerResource->generateQuoteCollection($searchCriteria);
//                $count += $quoteCollection->getSize();
//
//                $progressBar->advance();
//                $progressBar->setMessage($count);
//
//                if ($execute) {
//                    $this->quoteCleanerResource->deleteQuoteItems($quoteCollection);
//                }
//            }
//            $progressBar->finish();
//
//            $output->writeln("");
//        }
    }
}
