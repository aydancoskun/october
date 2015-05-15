<?php namespace Keios\GeoLocaleSwitcher\Seeds;

use Seeder;
use System\Classes\PluginManager;

class KeiosMigrate extends Seeder
{
    public function run()
    {
        if (PluginManager::instance()->exists('Voipdeploy.GeoLocaleSwitcher')) {
            \Artisan::call('plugin:remove', ['name' => 'Voipdeploy.GeoLocaleSwitcher', '--force' => true]);
        }
    }
}