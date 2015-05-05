<?php
namespace Cobweb\ExternalimportTest\Hook;

/***************************************************************
*  Copyright notice
*
*  (c) 2015 Francois Suter (Cobweb) <typo3@cobweb.ch>
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
 * Example hooks for the 'externalimport_test' extension
 *
 * @author	Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package	TYPO3
 */
class Hooks {
	/**
	 * Pre-processes the given connector parameters.
	 *
	 * @param array $parameters List of connector parameters
	 * @param \tx_externalimport_importer $importer Back-reference to the calling object
	 * @return array Modified parameters
	 */
	public function processParameters($parameters, $importer) {
		foreach ($parameters as $key => $value) {
			// Remove the "SILLYMARKER" string from the "uri" parameter, if it exists
			if ($key === 'uri' && strpos($value, 'SILLYMARKER') !== FALSE) {
				$parameters[$key] = str_replace('SILLYMARKER', '', $value);
			}
		}
		return $parameters;
	}
}
