<?php

namespace App\Livewire\Navigation\Header;

use Livewire\Component;

class HamburgerIcon extends Component {

	public bool $open = false;

	public function toggleMenu() {
		$this->open = !$this->open;
	}

	public function render() {
		return view('livewire.navigation.header.hamburger-icon');
	}
}
