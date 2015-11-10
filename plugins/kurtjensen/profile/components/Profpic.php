<?php namespace KurtJensen\Profile\Components;

use Auth;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Input;
use Redirect;
use System\Models\File as File;

class Profpic extends ComponentBase {
	/**
	 * @var User The user model used for display
	 * of a single user.
	 */
	public $AvaUser;

	public $AvaUserid;

	public function componentDetails() {
		return [
			'name' => 'Avatar Display & Form',
			'description' => 'Frontend display and form for user to manage their avatar',
		];
	}

	public function defineProperties() {
		return [
			'redirect' => [
				'title' => 'Form Redirect',
				'description' => 'Page to redirect to after submiting new avatar image.',
				'type' => 'dropdown',
				'default' => '',
				'group' => 'Links',
			],
		];
	}

	function init() {
		// This code will be executed before
		// an AJAX request is handled.

		$this->page['AvaUser'] = $this->AvaUser = Auth::getUser();

		if (!$this->AvaUser) {
			return null;
		}

		$this->AvaUserid = intval($this->AvaUser->id);
		$this->page['avatarThumb'] = $this->AvaUser->getAvatarThumb(200);
	}

	/**
	 * Executed when this component is bound to a page or layout.
	 */

	function onRun() {
	}

	public function getRedirectOptions() {
		return ['' => '- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
	}

	protected function onAvatarForm() {
		if (!$this->AvaUserid) {
			return null;
		}

	}

	public function onAvatarUpdate() {
		$file = new File;
		$file->data = Input::file('avatar');
		$file->save();
		$this->AvaUser->avatar()->add($file);

		return Redirect::intended($this->pageUrl($this->property('redirect')));
	}

}
