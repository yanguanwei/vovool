<?php
require __DIR__ . '/../../app/App.php';

class VovoolApp extends App
{
    protected function registerLocations()
    {
        $this->registerLocator('site', __DIR__)
            ->registerLocator('web', __DIR__ . '/web');

        parent::registerLocations();
    }
}