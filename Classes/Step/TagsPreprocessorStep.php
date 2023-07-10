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
class TagsPreprocessorStep extends AbstractStep
{

    /**
     * Filters out some records from the raw data for the tags table.
     *
     * Any name containing an asterisk is considered censored and thus removed.
     *
     * NOTE: since external_import 6.0.0, this would be better achieved by calling
     * a user function during the transformation step throwing
     * \Cobweb\ExternalImport\Exception\InvalidRecordException.
     * See: \Cobweb\ExternalimportTest\UserFunction\Transformation::checkStoreStatus
     */
    public function run(): void
    {
        $records = $this->getData()->getRecords();
        foreach ($records as $index => $record) {
            if (strpos($record['name'], '*') !== false) {
                unset($records[$index]);
            }
        }
        $records = array_values($records);
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
