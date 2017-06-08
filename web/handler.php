<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/Test/Test.php';
require_once __DIR__ . '/../src/Payment/Payment.php';
require_once __DIR__ . '/../src/Storage/Storage.php';

echo 'ОК ' . file_get_contents('php://input');