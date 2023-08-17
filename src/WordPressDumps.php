<?php

namespace WordpressDumps\WordpressDumps;

use LaraDumps\LaraDumpsCore\LaraDumps;
use WordpressDumps\WordpressDumps\Hooks\SQLQueries;

class WordpressDumps extends LaraDumps
{
    private SQLQueries $sqlQueries;

    public function __construct(string $notificationId = '', array $trace = [])
    {
        parent::__construct($notificationId, $trace);
        $this->sqlQueries = new SQLQueries();
    }

    public function queriesOn(string $label = null): WordpressDumps
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        $this->sqlQueries->enable($label);
        $this->sqlQueries->setTrace($trace);

        return $this;
    }

    public function queriesOff(): WordpressDumps
    {
        $this->sqlQueries->disable();
        return $this;
    }
}
