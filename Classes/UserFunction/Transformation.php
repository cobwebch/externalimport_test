<?php
declare(strict_types=1);
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

use Cobweb\ExternalImport\ImporterAwareInterface;
use Cobweb\ExternalImport\ImporterAwareTrait;

/**
 * Example user functions for the 'externalimport_test' extension
 *
 * @author Francois Suter (Cobweb) <typo3@cobweb.ch>
 * @package TYPO3
 */
class Transformation implements ImporterAwareInterface
{
    use ImporterAwareTrait;

    /**
     * Takes a XML structure of <quality> tags and transforms it into a <ul><li>...</li></ul> structure.
     *
     * @param array $record The full record that is being transformed
     * @param string $index The index of the field to transform
     * @param array $params Additional parameters from the TCA
     * @return string HTML structure
     */
    public function processAttributes(array $record, string $index, array $params): string
    {
        $html = $record[$index];
        if (empty($html)) {
            return '';
        }

        $html = str_replace('quality', 'li', $html);
        $html = '<ul>' . $html . '</ul>';
        // Rather silly, but demonstrates checking the preview mode thanks to the reference to the Importer class
        if ($this->importer->isPreview()) {
            $html = 'PREVIEW: ' . $html;
        }
        return $html;
    }

    /**
     * Removes the opening # character (well, any # actually)
     *
     * @param array $record The full record that is being transformed
     * @param string $index The index of the field to transform
     * @param array $params Additional parameters from the TCA
     * @return string
     */
    public function stripPositionMarker(array $record, string $index, array $params): string
    {
        return str_replace('#', '', $record[$index]);
    }

    /**
     * Checks if a store is ok or not, removes it if not
     *
     * @param array $record The full record that is being transformed
     * @param string $index The index of the field to transform
     * @param array $params Additional parameters from the TCA
     * @return string
     * @throws \Cobweb\ExternalImport\Exception\InvalidRecordException
     */
    public function checkStoreStatus(array $record, string $index, array $params): string
    {
        if ($record[$index] === 'ko') {
            throw new \Cobweb\ExternalImport\Exception\InvalidRecordException(
                'Store status is ko',
                1628877369
            );
        }
        return $record[$index];
    }
}
