<?php

namespace KurtJensen\Profile\models;

use Model;

class Settings extends Model {

	public $implement = ['System.Behaviors.SettingsModel'];

	// A unique code
	public $settingsCode = 'kurtjensen_profile_settings';

	// Reference to field configuration
	public $settingsFields = 'fields.yaml';

	protected $cache = [];

}
