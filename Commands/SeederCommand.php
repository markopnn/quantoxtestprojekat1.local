<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

include_once 'Model/Seeder.php';

class SeederCommand extends Command
{
    protected $commandName = 'seeder:run';
    protected $commandDescription = "Successful seeder";

    protected $commandArgumentName = "seeder";
    protected $commandArgumentDescription = "Who do you want to use seeder?";

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
        $result = new Seeder();
        $result->insert();

        $name = $input->getArgument($this->commandArgumentName);
        $text = 'Successful seeder';

        $output->writeln($text);
    }
}