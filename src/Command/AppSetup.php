<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Process;

class AppSetup extends Command
{
	protected static $defaultName = 'app:setup';

	public function __construct(private EntityManagerInterface $entityManager)
	{
		parent::__construct();
	}

	protected function configure(): void
	{
		$this->setDescription('Создаёт базу данных, выполняет миграции и загружает фикстуры.');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$io = new SymfonyStyle($input, $output);
		$dbName = 'db_test_oborot';
		$connection = $this->entityManager->getConnection();
		$schemaManager = $connection->createSchemaManager();

		try {
			$connection->beginTransaction();

			// Проверяем, существует ли база
			if (in_array($dbName, $schemaManager->listDatabases())) {
				$io->success("База данных '$dbName' уже существует.");
			} else {
				// Создаём базу
				$connection->executeStatement("CREATE DATABASE $dbName");
				$io->success("База данных '$dbName' создана.");
			}

			// Запускаем миграции
			$this->runProcess(['php', 'bin/console', 'doctrine:migrations:migrate', '--no-interaction'], $io, 'Миграции выполнены.');

			// Загружаем фикстуры
			$this->runProcess(['php', 'bin/console', 'doctrine:fixtures:load', '--no-interaction'], $io, 'Фикстуры загружены.');

			$connection->commit();
			return Command::SUCCESS;
		} catch (\Throwable $e) {
			$connection->rollBack();

			// Если база была создана в процессе, удаляем её
			if (!in_array($dbName, $schemaManager->listDatabases())) {
				$connection->executeStatement("DROP DATABASE IF EXISTS $dbName");
				$io->warning("База данных '$dbName' удалена из-за ошибки.");
			}

			$io->error('Ошибка: ' . $e->getMessage());
			return Command::FAILURE;
		}
	}

	private function runProcess(array $command, SymfonyStyle $io, string $successMessage): void
	{
		$process = new Process($command);
		$process->run();

		if (!$process->isSuccessful()) {
			throw new \RuntimeException($process->getErrorOutput() ?: 'Произошла ошибка при выполнении команды.');
		}

		$io->success($successMessage);
	}
}
