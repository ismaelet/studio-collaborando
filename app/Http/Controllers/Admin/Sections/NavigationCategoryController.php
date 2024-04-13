<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Http\Controllers\Admin\AdminSectionController;
use App\Models\Admin\AdminCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class NavigationCategoryController extends AdminSectionController {

	/**
	 * Index configuration
	 */
	protected array $columns = [
		['label' => 'ID', 'name' => 'id'],
		['label' => 'Nome', 'name' => 'name'],
		['label' => 'Slug', 'name' => 'slug'],
		['label' => 'Ordine', 'name' => 'order', 'type' => 'int'],
		['label' => 'Per supervisori', 'name' => 'for_supervisors', 'type' => 'bool'],
	];
	protected array $orderBy = ['for_supervisors' => 'asc', 'order' => 'asc', 'name' => 'asc'];

	/**
	 * Show configuration
	 */
	protected string $titleField = 'name';

	/**
	 * Index
	 */
	public function prepareIndex(Request $request): void {
		// Prepare the query
		$this->query = AdminCategory::select('*');

		// Add search filter
		if ($request->search) {
			$this->query = $this->query->where('id', $request->search)
				->orWhere('email', 'like', '%' . $request->search . '%');
		}

		// Add the buttons
		$this->buttons = [
			[
				'label' => 'Modifica',
				'icon' => 'edit',
				'color' => 'blue',
				'url' => '/' . Route::current()->uri() . '/{id}',
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
		$this->record = AdminCategory::find($id);
	}
}
