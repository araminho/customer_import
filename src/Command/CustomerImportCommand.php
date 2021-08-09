<?php
/**
 * Created by PhpStorm.
 * User: Aram
 * Date: 09/08/2021
 * Time: 12:04
 */

namespace App\Command;

use App\Service\CustomerApi;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CustomerImportCommand extends Command
{
    protected static $defaultName = 'app:import-customer';

    private $customerApi;

    public function __construct(CustomerApi $customerApi)
    {
        $this->customerApi = $customerApi;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Imports customers')
            ->setHelp('This command allows you to import customers from an API')
        ;

        $this
            ->addArgument('count', InputArgument::OPTIONAL, 'How many customers do you want to import')
            ->addArgument('country_code', InputArgument::OPTIONAL, 'Which country (ISO Alpha 2 code) are you interested in?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->customerApi->import(
            $input->getArgument('count') ?? 100,
            $input->getArgument('country_code') ?? 'AU'
        );
        return Command::SUCCESS;
    }
}