<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'keitaYoussouf:entity:create',
    description: 'Crée une entité Doctrine'
)]
class KeitaYoussoufEntityCreateCommand extends Command
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $helper = $this->getHelper('question');

        $question = new Question(
            'Nom de l’entité à créer (exemple : Membre) : '
        );

        $entity = $helper->ask($input, $output, $question);

        if (!is_string($entity) ||
            !preg_match('/^[A-Z][A-Za-z0-9]*$/', $entity)) {
            $output->writeln('<error>Nom d’entité invalide.</error>');
            return Command::FAILURE;
        }

        $process = new \Symfony\Component\Process\Process([
            PHP_BINARY,
            'bin/console',
            'make:entity',
            $entity,
        ]);
        $process->run();

        return $process->isSuccessful()
            ? Command::SUCCESS
            : Command::FAILURE;
    }
}
