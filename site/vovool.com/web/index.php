<?php
use Symfony\Component\HttpFoundation\Request;

require '../VovoolApp.php';
$app = new VovoolApp('dev', true);

$response = $app->handle(Request::createFromGlobals());
$response->send();
