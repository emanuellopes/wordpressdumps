<?php

namespace WordpressDumps\WordpressDumps\Payloads;

use LaraDumps\LaraDumpsCore\Payloads\Payload;

class QueriesPayload extends Payload
{
    public function __construct(
        private string $querySql,
        private float  $executedTime,
        public array  $trace = [],
    ) {
    }

    public function type(): string
    {
        return 'queries';
    }

    public function content(): array
    {
        return array(
            'sql' => $this->querySql,
            'time' => $this->executedTime * 1000,
            'database'       => DB_NAME,
            'connectionName' => 'mysql'
        );
    }
}
