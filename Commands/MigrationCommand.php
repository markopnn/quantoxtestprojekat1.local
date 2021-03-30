<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

include_once 'Model/Migration.php';

class MigrationCommand extends Command
{
    protected $commandName = 'migrate:run';
    protected $commandDescription = "Successful migration";

    protected $commandArgumentName = "migrate";
    protected $commandArgumentDescription = "Who do you want to migrate?";

    protected $commandOptionName = "migrate";

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::OPTIONAL,
                $this->commandArgumentDescription
            )
            ->addOption(
                $this->commandOptionName,
                null,
                InputOption::VALUE_NONE
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = new Migration();
        $result->delete();

        $name = $input->getArgument($this->commandArgumentName);
        $text = 'Successful migration';

        $output->writeln($text);
    }
}