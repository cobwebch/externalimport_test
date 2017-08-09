<?php
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
    public function run()
    {
        $records = $this->getData()->getRecords();
        foreach ($records as $index => $record) {
            $records[$index]['name'] = $record['name'] . ' (base)';
        }
        $this->getData()->setRecords($records);
    }
}