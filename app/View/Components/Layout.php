<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Layout extends Component {

	public string $appName;
	public string|null $appDescription;

	/**
	 * Create a new component instance.
	 */
	public function __construct() {
		$this->appName = config('app.name');
		$this->appDescription = config('custom.meta_data.description');
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string {
		return view('components.layout');
	}
}
