<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Processor;

use SimpleXMLElement;

class EventProcessor
{
    private static array $events = [];

    public function process(SimpleXMLElement $process): void
    {
        if (!isset($process->events)) {
            return;
        }

        foreach ($process->events->event as $event) {
            $name = (string)$event['name'];
            if (!isset(self::$events[$name])) {
                self::$events[$name] = [
                    'name' => $name,
                    'timeout' => $event['timeout'],
                    'command' => $event['command'],
                    'onEnter' => $event['onEnter'],
                    'manual' => $event['manual'],
                ];
            }
        }
    }

    public function getEventLabel(string $eventName): string
    {
        if (isset(self::$events[$eventName])) {
            $eventData = self::$events[$eventName];

            if ($eventData === null) {
                return '';
            }

            $icons = '';

            $timeout = $eventData['timeout'] !== null ? sprintf('<br>⌛ %s', $eventData['timeout']) : '';
            $command = $eventData['command'] !== null ? sprintf('<br>➤ %s', $eventData['command']) : '';
            $icons .= $eventData['onEnter'] !== null ? ' 🔄' : '';
            $icons .= $eventData['manual'] !== null ? ' ✋' : '';

            $icons = $icons === '' ? '' : '<br>' . $icons;

            return sprintf('<strong>%s</strong> %s%s%s', $eventData['name'], $timeout, $command, $icons);
        }

        return '';
    }
}
