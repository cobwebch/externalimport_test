<?php

declare(strict_types=1);

namespace Cobweb\ExternalimportTest\EventListener;

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


use Cobweb\ExternalImport\Event\ProcessConnectorParametersEvent;

/**
 * Reacts to the event for processing connector parameters
 *
 * @package Cobweb\ExternalimportTest\EventListener
 */
class ParametersProcessor
{
    public function __invoke(ProcessConnectorParametersEvent $event): void
    {
        $parameters = $event->getParameters();
        foreach ($parameters as $key => $value) {
            // Remove the "SILLYMARKER" string from the "uri" parameter, if it exists
            if ($key === 'uri' && str_contains((string)$value, 'SILLYMARKER')) {
                $parameters[$key] = str_replace('SILLYMARKER', '', $value);
            }
        }
        $event->setParameters($parameters);
    }
}