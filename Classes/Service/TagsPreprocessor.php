<?php
namespace Cobweb\ExternalimportTest\Service;

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

/**
 * Example preprocessor for the 'externalimport_test' extension
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 */
class TagsPreprocessor
{

    /**
     * Filters out some records from the raw data for the tags table.
     *
     * Any name containing an asterisk is considered censored and thus removed.
     *
     * This method is used to test pre-processors and the maintaining of continuous
     * array structures by the tx_externalimport_importer class after hooks may
     * have unset items in the record set.
     *
     * @param array $records The record set to pre-process
     * @param Importer $importer Back-reference to the calling object
     * @return array The filtered record set
     */
    public function preprocessRawRecordset($records, $importer)
    {
        if ($importer->getExternalConfiguration()->getTable() === 'tx_externalimporttest_tag') {
            $numRecords = count($records);
            for ($i = 0; $i < $numRecords; $i++) {
                if (strpos($records[$i]['name'], '*') !== false) {
                    unset ($records[$i]);
                }
            }
        }
        return $records;
    }
}
