<?php

// load vendor dependencies.
require dirname(__DIR__) . '/vendor/autoload.php';

define('WP_ENVIRONMENT_TYPE', 'local');
get_post();
ds()->getLastQuery();
