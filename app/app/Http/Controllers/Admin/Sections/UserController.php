<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Http\Controllers\Admin\AdminSectionController;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends AdminSectionController {

	/**
	 * Index configuration
	 */
	protected array $indexFields = [
		['label' => 'ID', 'name' => 'id'],
		['label' => 'Nome', 'name' => 'first_name'],
		['label' => 'Cognome', 'name' => 'last_name'],
		['label' => 'E-mail', 'name' => 'email',],
		['label' => 'Registrazione', 'name' => 'created_at'],
	];

	/**
	 * Index
	 */
	public function prepareIndex(Request $request): void {
		// Prepare the query
		$this->records = User::select('*');

		// Add search filter
		if ($request->search) {
			$this->records = $this->records->where('id', $request->search)
				->orWhere('email', 'like', '%' . $request->search . '%');
		}

		// Add the buttons
		$this->buttons = [
			[
				'label' => 'Login',
				'icon' => 'login',
				'name' => 'login',
				'color' => 'green',
			],
			[
				'label' => 'Modifica',
				'icon' => 'edit',
				'color' => 'blue',
				'url' => '/admin/users/{id}',
			],
			[
				'label' => 'Elimina',
				'icon' => 'delete',
				'name' => 'delete',
				'color' => 'red',
				'confirmation' => true,
			],
		];
	}

	/**
	 * Show
	 */
	public function prepareShow(int $id): void {
		$this->record = User::find($id);
		$this->title = $this->record->email;
	}
}
