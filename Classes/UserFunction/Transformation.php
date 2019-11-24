<?php
namespace Cobweb\ExternalimportTest\UserFunction;

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

/**
 * Example user functions for the 'externalimport_test' extension
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 */
class Transformation
{
    /**
     * Takes a XML structure of <quality> tags and transforms it into a <ul><li>...</li></ul> structure.
     *
     * @param array $record The full record that is being transformed
     * @param string $index The index of the field to transform
     * @param array $params Additional parameters from the TCA
     * @return string HTML structure
     */
    public function processAttributes($record, $index, $params): string
    {
        $html = $record[$index];
        if (empty($html)) {
            return '';
        }
        $html = str_replace('quality', 'li', $html);
        return '<ul>' . $html . '</ul>';
    }
}
