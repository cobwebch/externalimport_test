<?php
namespace Cobweb\ExternalimportTest\Service;

/***************************************************************
*  Copyright notice
*
*  (c) 2014 Francois Suter (Cobweb) <typo3@cobweb.ch>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Example preprocessor for the 'externalimport_test' extension
 *
 * @author	Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package	TYPO3
 */
class TagsPreprocessor {

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
	 * @param \tx_externalimport_importer $importer Back-reference to the calling object
	 * @return array The filtered record set
	 */
	public function preprocessRawRecordset($records, $importer) {
		if ($importer->getTableName() == 'tx_externalimporttest_tag') {
			$numRecords = count($records);
			for ($i = 0; $i < $numRecords; $i++) {
				if (strpos($records[$i]['name'], '*') !== FALSE) {
					unset ($records[$i]);
				}
			}
		}
		return $records;
	}
}
