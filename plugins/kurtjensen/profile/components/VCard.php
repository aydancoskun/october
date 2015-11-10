<?php namespace KurtJensen\Profile\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Http\Response;
use RainLab\User\Models\User as user;
use ShahiemSeymor\Roles\Models\Permission;
use ShahiemSeymor\Roles\Models\UserGroup;

class VCard extends ComponentBase {
	public function componentDetails() {
		return [
			'name' => 'VCard Component',
			'description' => 'Allows users to download V-Cards for easily adding info to electronic address books.',
		];
	}

	public function defineProperties() {
		return [
			'SLSlug' => [
				'title' => 'Selected User Slug',
				'description' => 'Slug for returning user v-card.',
				'type' => 'string',
				'default' => '{{ :slug }}',
			],
			'permission' => [
				'title' => 'Permission For Access',
				'description' => 'Permission name required to download V-Cards.',
				'type' => 'dropdown',
				'default' => '',
			],
		];
	}

	public function getPermissionOptions() {
		return [0 => '- none required -'] + Permission::orderBy('name')->lists('name', 'name');
	}

	public function onRun() {
		$userPermision = $this->property('permission');
		if ($userPermision) {
			if (!UserGroup::can($userPermision)) {
				return;
			}

		}

		$person = user::find(intval($this->property('SLSlug')));
		if ($person) {

			$filename = $person->surname . '_' . $person->name . '.vcf';
			return response($this->renderPartial('@vcard', ['person' => $person]))
				->header('Content-Type', 'text/directory')
				->header('Content-Disposition', 'attachment; filename=' . $filename)
				->header('Pragma', 'public');
		}
	}

}