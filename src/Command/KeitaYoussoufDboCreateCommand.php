<?php

namespace App\Command;

use Doctrine\DBAL\DriverManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'keitaYoussouf:dbo:create',
    description: 'Crée la base de données si elle n’existe pas'
)]
class KeitaYoussoufDboCreateCommand extends Command
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $url = $_ENV['DATABASE_URL'] ?? $_SERVER['DATABASE_URL'] ?? '';

        $params = parse_url($url);
        $password = $params['pass'] ?? '';

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_pgsql',
            'host' => '127.0.0.1',
            'port' => 5432,
            'user' => 'postgres',
            'password' => $password,
            'dbname' => 'postgres',
        ]);

        $exists = $connection->fetchOne(
            "SELECT 1 FROM pg_database WHERE datname = ?",
            ['gestion_tontine']
        );

        if (!$exists) {
            $connection->executeStatement('CREATE DATABASE gestion_tontine');
            $output->writeln('<info>Base gestion_tontine créée.</info>');
        } else {
            $output->writeln('<comment>La base gestion_tontine existe déjà.</comment>');
        }

        $connection->close();

        return Command::SUCCESS;
    }
}