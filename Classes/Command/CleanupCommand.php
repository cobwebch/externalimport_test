<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Cobweb\ExternalimportTest\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Command-line tool to clean up all the test data.
 *
 * @package Cobweb\ExternalimportTest\Command
 */
class CleanupCommand extends Command
{
    protected array $tablesToCleanUp = [
        'tx_externalimporttest_bundle',
        'tx_externalimporttest_designer',
        'tx_externalimporttest_invoice',
        'tx_externalimporttest_order',
        'tx_externalimporttest_order_items',
        'tx_externalimporttest_product',
        'tx_externalimporttest_store',
        'tx_externalimporttest_store_product',
        'tx_externalimporttest_tag',
        'tx_externalimporttest_product_designer_mm',
        'tx_externalimporttest_bundle_product_mm',
    ];

    /**
     * Configures the command by setting its name, description and options.
     *
     * @return void
     */
    public function configure(): void
    {
        $this->setDescription('Cleans up all the test data, optionnally also the logs.')
            ->addOption(
                'logs',
                'l',
                InputOption::VALUE_NONE,
                'Also empty the log table.'
            );
    }

    /**
     * Executes the command to clean up the data.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title($this->getDescription());

        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $recordsDeleted = 0;
        // Clean up tables where all records can be deleted
        foreach ($this->tablesToCleanUp as $table) {
            $queryBuilder = $connectionPool->getQueryBuilderForTable($table);
            $recordsDeleted += $queryBuilder->delete($table)->executeStatement();
        }
        // Some tables require finer control
        $queryBuilder = $connectionPool->getQueryBuilderForTable('sys_file_reference');
        $recordsDeleted += $queryBuilder->delete('sys_file_reference')
            ->where(
                $queryBuilder->expr()->eq('tablenames', $queryBuilder->createNamedParameter('tx_externalimporttest_designer'))
            )->orWhere($queryBuilder->expr()->eq('tablenames', $queryBuilder->createNamedParameter('tx_externalimporttest_product')))->executeStatement();
        $queryBuilder = $connectionPool->getQueryBuilderForTable('sys_file');
        $recordsDeleted += $queryBuilder->delete('sys_file')->where($queryBuilder->expr()->like('identifier', $queryBuilder->createNamedParameter('/imported_images/%')))->executeStatement();
        $queryBuilder = $connectionPool->getQueryBuilderForTable('pages');
        $recordsDeleted += $queryBuilder->delete('pages')->where($queryBuilder->expr()->neq('product_sku', $queryBuilder->createNamedParameter('')))->executeStatement();
        $queryBuilder = $connectionPool->getQueryBuilderForTable('sys_category');
        $recordsDeleted += $queryBuilder->delete('sys_category')->where($queryBuilder->expr()->neq('external_key', $queryBuilder->createNamedParameter('')))->executeStatement();

        // If requested, also empty the logs table
        $logs = $input->getOption('logs');
        if ($logs) {
            $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_externalimport_domain_model_log');
            $recordsDeleted += $queryBuilder->delete('tx_externalimport_domain_model_log')->executeStatement();
        }

        $io->success(
            sprintf(
                'All test data cleaned up. %d records deleted.',
                $recordsDeleted
            )
        );
        return Command::SUCCESS;
    }
}