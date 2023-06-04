<?php
// src/Command/CreateUserCommand.php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:build-db')]
class CreateDatabase extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Running shell script...');
        $output->writeln('');

        // Execute the shell script
        $scriptPath = 'bin/build-dev-db';
        chmod('bin/build-dev-db', 0700);
        shell_exec($scriptPath);

        $output->writeln('');
        $output->writeln('Shell script executed.');

        return Command::SUCCESS;
    }
}