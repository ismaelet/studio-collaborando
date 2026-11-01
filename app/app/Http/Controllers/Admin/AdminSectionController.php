<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminSection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View as FacadesView;

class AdminSectionController extends Controller {

	/**
	 * Index configuration
	 */
	protected Builder $records;
	protected string $orderBy = 'id';
	protected string $orderDirection = 'desc';
	protected array $indexFields = [];
	protected array $buttons = [];
	protected int $pageSize = 50;
	protected bool $interactiveRows = true;
	protected bool $addButton = false;
	protected bool $searchBar = true;

	/**
	 * Store configuration
	 */
	protected ?object $record = null;
	protected ?string $title = null;

	/**
	 * Index
	 */
	public function index(Request $request): View {
		// Prepare the index
		$this->prepareIndex($request);

		// Add the sorting, if set
		if ($request->has('order_by')) {
			$this->orderBy = $request->order_by;
		}

		// Add the sorting direction, if set
		if ($request->has('order_direction')) {
			$this->orderDirection = $request->order_direction;
		}

		// Add a column for the buttons
		if (!empty($this->buttons)) {
			$this->indexFields[] = [];
		}

		// Calculate the record count before applying the pagination
		$recordCount = $this->records->count();

		// Apply the pagination
		$records = $this->paginateRecords($request);

		// Display the view
		return view('components.templates.admin-table')->with([
			'title' => $this->getSection()->name,
			'fields' => $this->indexFields,
			'records' => $records,
			'recordCount' => $recordCount,
			'buttons' => $this->buttons,
			'orderBy' => $this->orderBy,
			'orderDirection' => $this->orderDirection,
			'interactiveRows' => $this->interactiveRows,
			'addButton' => $this->addButton,
			'searchBar' => $this->searchBar,
			'pageSize' => $this->pageSize,
		]);
	}

	/**
	 * Show
	 */
	public function show(int $id) {
		// Generate the title
		$this->title = $this->getSection()->name;

		// Prepare the data
		$this->prepareShow($id);

		// Get the view name
		$viewName = Route::currentRouteName();
		$viewName = FacadesView::exists($viewName) ? $viewName : ArrayHelper::explodeLast('.', $viewName)[0] . '.manage';

		// Return the view
		return view($viewName)
			->with([
				'title' => $this->title,
				'record' => $this->record,
				'type' => $this->record ? 'edit' : 'add',
			]);
	}

	/**
	 * Get the current page
	 */
	private function currentPage(Request $request): int {
		return $request->page ?? 1;
	}

	/**
	 * Get the current section
	 */
	private static function getSection(): AdminSection {
		// Get the current section
		$sectionPath = explode('.', Route::currentRouteName(), 3);
		$groupSlug = $sectionPath[1];
		$sectionSlug = $sectionPath[2] ?? 'list';

		$section = AdminSection::join('admin_categories', 'admin_categories.id', '=', 'admin_sections.category_id')
			->where('admin_categories.slug', $groupSlug)
			->where('admin_sections.slug', $sectionSlug)
			->select('admin_sections.*')
			->first();

		return $section;
	}

	/**
	 * Generate the data for the table
	 */
	private function paginateRecords(Request $request): Collection {
		return $this->records
			->orderBy($this->orderBy, $this->orderDirection)
			->skip(($this->currentPage($request) - 1) * $this->pageSize)
			->take($this->pageSize)
			->get();
	}
}
