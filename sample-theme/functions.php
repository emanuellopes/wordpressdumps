<?php

// load vendor dependencies.
require dirname(__DIR__) . '/vendor/autoload.php';


ds()->queriesOn('teste')->color('red');
get_posts();
ds()->queriesOff();

ds(1)->label('Creator of Laradumps');
