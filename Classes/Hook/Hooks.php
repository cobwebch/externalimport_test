<?php
namespace Cobweb\ExternalimportTest\Hook;

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
 * Example hooks for the 'externalimport_test' extension
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 */
class Hooks
{
    /**
     * Pre-processes the given connector parameters.
     *
     * @param array $parameters List of connector parameters
     * @param Importer $importer Back-reference to the calling object
     * @return array Modified parameters
     */
    public function processParameters($parameters, $importer)
    {
        foreach ($parameters as $key => $value) {
            // Remove the "SILLYMARKER" string from the "uri" parameter, if it exists
            if ($key === 'uri' && strpos($value, 'SILLYMARKER') !== false) {
                $parameters[$key] = str_replace('SILLYMARKER', '', $value);
            }
        }
        return $parameters;
    }
}
