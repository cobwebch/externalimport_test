<?php
namespace Cobweb\ExternalimportTest\Command;

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

use Cobweb\ExternalImport\Importer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Command-line tool to test the import API.
 *
 * @package Cobweb\ExternalimportTest\Command
 */
class ImportCommand extends Command
{

    /**
     * Configures the command by setting its name, description and options.
     *
     * @return void
     */
    public function configure(): void
    {
        $this->setDescription('Runs External Import using its import API for testing purposes.')
                ->setHelp('Just run the command and check in the backend or in the DB if the expected records are there.');
    }

    /**
     * Executes the command that runs the selected import.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Make sure the _cli_ user is loaded
        Bootstrap::initializeBackendAuthentication();

        $io = new SymfonyStyle($input, $output);
        $io->title($this->getDescription());

        $importer = GeneralUtility::makeInstance(Importer::class);
        $result = $importer->import(
                'tx_externalimporttest_tag',
                'api',
                [
                        [
                                'code' => 'useful',
                                'name' => 'Useful Stuff (API)'
                        ],
                        [
                                'code' => 'useless',
                                'name' => 'Useless Stuff (API)'
                        ]
                ]
        );
        $outputTable = [];
        foreach ($result as $status => $messages) {
            if (count($messages) > 0) {
                foreach ($messages as $message) {
                    $outputTable[] = [$status, $message];
                }
            }
        }
        $io->table(
                ['Status', 'Message'],
                $outputTable
        );

        if (count($result[AbstractMessage::ERROR]) > 0 || count($result[AbstractMessage::WARNING]) > 0) {
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}