<?php

declare(strict_types=1);

namespace Cobweb\ExternalimportTest\Step;

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

use Cobweb\ExternalImport\Step\AbstractStep;

/**
 * Class demonstrating how to use custom steps for external import.
 *
 * @package Cobweb\ExternalimportTest\Step
 */
class EnhanceDataStep extends AbstractStep
{
    /**
     * Performs some dummy operation to demonstrate custom steps.
     *
     * @return void
     */
    public function run(): void
    {
        $records = $this->getData()->getRecords();
        foreach ($records as $index => $record) {
            $records[$index]['name'] = $record['name'] . $this->parameters['tag'];
        }
        $this->getData()->setRecords($records);
        // Set the filtered records as preview data
        $this->importer->setPreviewData($records);
    }

    /**
     * Define the data as being downloadable
     *
     * @return bool
     */
    public function hasDownloadableData(): bool
    {
        return true;
    }
}