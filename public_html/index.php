<?php
<<<<<<< HEAD
define('IS_AJAX', (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'));
# Starting Time
=======

// Starting Time
>>>>>>> d3af033c353ca7b36320ceeec45aeaad424f61d7
$start = microtime(true);

// Require The App.php File
require_once __DIR__.'/../bootstrap/app.php';

$app->run();

// End Time
$end = microtime(true);

<<<<<<< HEAD
if(!IS_AJAX)
{
    # Output in comment tag, the total excuted time
    echo "\n<!-- ".($end - $start)." -->";
}
=======
// Output in comment tag, the total excuted time
echo "\n<!-- ".($end - $start).' -->';
>>>>>>> d3af033c353ca7b36320ceeec45aeaad424f61d7
