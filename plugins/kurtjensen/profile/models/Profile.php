<?php namespace KurtJensen\Profile\Models;

use Auth;
use Model;

/**
 * Profile Model
 */
class Profile extends Model {

	/**
	 * @var string The database table used by the model.
	 */
	public $table = 'kurtjensen_profile_profiles';

	/**
	 * @var array Guarded fields
	 */
	protected $guarded = [];

	/**
	 * @var array Fillable fields
	 */
	protected $fillable = [];

	/**
	 * @var array Relations
	 */
	public $belongsTo = [
		'user' => ['RainLab\User\Models\User',
			'key' => 'user_id'],
	];

	public static function getFromUser($user = null) {
		if ($user === null) {
			$user = Auth::getUser();
		}

		if (!$user) {
			return null;
		}

		if (!$user->profile) {

			$profile = new static;
			$profile->user = $user;
			$profile->save();

			$user->profile = $profile;
		}

		return $user->profile;
	}
}
