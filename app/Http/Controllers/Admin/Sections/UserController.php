<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Http\Controllers\Admin\AdminSectionController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends AdminSectionController {

	/**
	 * Index configuration
	 */
	protected array $columns = [
		['label' => 'ID', 'name' => 'id'],
		['label' => 'Nome', 'name' => 'first_name'],
		['label' => 'Cognome', 'name' => 'last_name'],
		['label' => 'E-mail', 'name' => 'email',],
		['label' => 'Registrazione', 'name' => 'created_at', 'type' => 'date'],
	];

	/**
	 * Show configuration
	 */
	protected string $titleField = 'email';

	/**
	 * Index
	 */
	public function prepareIndex(Request $request): void {
		// Prepare the query
		$this->query = User::select('*');

		// Add search filter
		if ($request->search) {
			$this->query = $this->query->where('id', $request->search)
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
	}
}
