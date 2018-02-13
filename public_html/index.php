<?php
# Starting Time
$start = microtime(true);

# Require The App.php File
require_once __DIR__ . '/../bootstrap/app.php';

$app->run();

# End Time
$end = microtime(true);

# Output in comment tag, the total excuted time
echo "\n<!-- ".($end - $start)." -->";