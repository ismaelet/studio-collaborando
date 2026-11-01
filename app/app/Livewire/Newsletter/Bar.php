<?php

namespace App\Livewire\Newsletter;

use App\Models\Newsletter\Subscriber;
use Livewire\Component;

class Bar extends Component {

	public $email;
	public $success = false;
	public $processing = false;

	public function render() {
		return view('livewire.newsletter.bar');
	}

	public function subscribe() {
		$this->processing = true;

		$this->validate([
			'email' => 'required|email|unique:newsletter_subscribers',
		]);

		Subscriber::createAndSend([
			'email' => $this->email,
		]);

		$this->reset('email');
		$this->success = true;
	}
}
