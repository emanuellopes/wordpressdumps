<?php

namespace WordpressDumps\WordpressDumps\Hooks;

use LaraDumps\LaraDumpsCore\Concerns\Traceable;
use LaraDumps\LaraDumpsCore\Contracts\TraceableContract;
use WordpressDumps\WordpressDumps\Payloads\QueriesPayload;

class SQLQueries implements TraceableContract
{
    use Traceable;

    private bool $enabled = false;
    private ?string $label = null;

    public function enable(?string $label = null): void
    {
        if ($this->enabled) {
            return;
        }

        $this->enabled = true;
        $this->label = $label;
        $this->enableEnvironmentSaveQueries();

        add_filter('log_query_custom_data', array($this, 'observerCallbackQueries'), 1, 3);

    }

    public function disable(): void
    {
        $this->enabled = false;
        remove_filter('log_query_custom_data', array($this, 'observerCallbackQueries'), 1);
        $this->disableEnvironmentSavedQueries();
    }

    private function enableEnvironmentSaveQueries(): void
    {
        if (! defined('SAVEQUERIES') || ! SAVEQUERIES) {
            define('SAVEQUERIES', true);
        }

        if (SAVEQUERIES && property_exists($GLOBALS['wpdb'], 'save_queries')) {
            $GLOBALS['wpdb']->save_queries = true;
        }
    }

    private function disableEnvironmentSavedQueries(): void
    {
        if (! defined('SAVEQUERIES') || ! SAVEQUERIES) {
            define('SAVEQUERIES', false);
        }

        if (SAVEQUERIES && property_exists($GLOBALS['wpdb'], 'save_queries')) {
            $GLOBALS['wpdb']->save_queries = false;
        }
    }

    public function observerCallbackQueries(
        array $queryData,
        string $query,
        float $queryTime,
    ): array {
        $payload = new QueriesPayload($query, $queryTime, $this->trace);
        ds()->send($payload);
        return $queryData;
    }

    public function setTrace(array $trace): array
    {
        $this->trace = $trace;

        return $trace;
    }
}
