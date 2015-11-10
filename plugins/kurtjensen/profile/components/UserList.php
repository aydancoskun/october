<?php namespace KurtJensen\Profile\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use KurtJensen\Profile\Components\ExtendedInfo;
use RainLab\User\Models\User as user;
use ShahiemSeymor\Roles\Models\UserGroup;

class UserList extends ComponentBase {
	public $people = [];

	public $person = [];

	public $userGroups = [];

	public $showCountry;

	public $sort = '';

	public $vcardPage = '';

	public $UserSelected = 0;

	public function componentDetails() {
		return [
			'name' => 'User List',
			'description' => 'Shows a list of users and their information when selected',
		];
	}

	public function defineProperties() {
		return [
			'SLSlug' => [
				'title' => 'Selected User Slug',
				'description' => '( Optional ) Slug for displaying a single users information.  If used, page will only display user with an id that matches the slug.',
				'type' => 'string',
				'default' => '{{ :slug }}',
			],
			'showCountry' => [
				'title' => 'Show Country Field',
				'description' => 'Country field for allowing users to choose a country.',
				'type' => 'dropdown',
				'default' => 0,
				'options' => [0 => 'No', 1 => 'Yes'],
			],
			'defSort' => [
				'title' => 'Default Sort Order',
				'description' => 'Sort order of users when directory first opened.',
				'type' => 'dropdown',
				'default' => 0,
				'options' => ['group' => 'group', 'given' => 'given  name', 'surname' => 'surnane'],
			],
			'vcard' => [
				'title' => 'Vcard Page',
				'description' => 'Page that contains the VCard component.',
				'type' => 'dropdown',
				'default' => '',
			],
		];
	}

	public function init() {
		$this->getPrimaryUsergroups();
		$this->showCountry = $this->property('showCountry');
		$this->vcardPage = $this->property('vcard', 0);
	}

	public function onRun() {
		$this->addCss('/plugins/kurtjensen/profile/assets/css/myinfo.css');

		$this->UserSelected = intval($this->property('SLSlug'));
		if ($this->UserSelected) {
			return $this->UserDisplayOne();
		}

		$this->page['sort'] = $this->sort = get('sort', $this->property('defSort'));

		$this->loadUserInfo();
		$this->page['people'] = $this->people;

	}

	public function getVcardOptions() {
		return ['' => '- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
	}

	public function loadUserInfo() {
		$sort3 = null;
		/*
		 * Sorting
		 */
		switch ($this->sort) {
		case 'group':
			$sort1 = 'primary_usergroup';
			$sort2 = 'surname';
			$sort3 = 'name';
			break;
		case 'given':
			$sort1 = 'name';
			$sort2 = 'surname';
			break;
		default:
			$sort1 = 'surname';
			$sort2 = 'name';
		}

		$people = user::orderBy($sort1)->
			orderBy($sort2);

		if ($sort3) {
			$people->orderBy($sort3);
		}

		$this->people = $people->get();

		return $this->people;
	}

	public function UserDisplayOne() {
		$this->oneUser($this->UserSelected);
	}

	public function onUserDisplay() {
		$this->oneUser(post('id'));
	}

	public function onUserVcard() {
		$this->oneUser(post('id'));
		return $this->renderPartial('vcard');
	}

	public function oneUser($id) {
		$this->page['person'] = $this->person = user::find($id);

		$this->page['avatarThumb'] = $this->person->getAvatarThumb(200);

		$this->page['epsettings'] = ExtendedInfo::loadSettings($this->person);
		//$this->page['hint'] = count($this->page['epsettings']);

	}

	public function getPrimaryUsergroups() {
		$this->userGroups = UserGroup::lists('name', 'id');

		$this->page['userGroups'] = $this->userGroups;
	}

}
