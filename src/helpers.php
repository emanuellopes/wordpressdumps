<?php

use Ramsey\Uuid\Uuid;
use WordpressDumps\WordpressDumps\WordpressDumps;

if (!function_exists('appBasePath')) {
    function appBasePath(): string
    {
        return apply_filters('WordpressDumps/appBasePath', get_stylesheet_directory());
    }
}

if (!function_exists('ds')) {
    function ds(mixed ...$args)
    {
        $stack = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS | DEBUG_BACKTRACE_PROVIDE_OBJECT)[0];

        $sendRequest = function ($args, WordpressDumps $laradumps) use ($stack) {
            if ($args) {
                foreach ($args as $arg) {

                    $laradumps->write($arg, trace: $stack);
                }
            }
        };

        $laradumps = new WordpressDumps(
            notificationId: Uuid::uuid4()->toString(),
        );

        $sendRequest($args, $laradumps);

        return $laradumps;
    }
}
