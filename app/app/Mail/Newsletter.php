<?php

namespace App\Mail;

use App\Models\Newsletter\Newsletter as NewsletterNewsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class Newsletter extends Mailable {

	use Queueable, SerializesModels;

	public $subject;
	public $content;
	public $subscriberEmail;

	public function __construct($subscriber, $newsletterId) {
		$newsletterRecord = NewsletterNewsletter::find($newsletterId);

		$this->subscriberEmail = $subscriber->email;
		$this->subject = $newsletterRecord->subject;
		$this->content = $newsletterRecord->content;
		$this->content = str_replace('{{ $email }}', $subscriber->email, $newsletterRecord->content);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array<int, \Illuminate\Mail\Mailables\Attachment>
	 */
	public function attachments(): array {
		return [
			Attachment::fromPath(base_path() . '/resources/attachments/1.pdf')
				->as('Orario Scuola e Planner.pdf')
				->withMime('application/pdf'),
		];
	}

	public function build() {
		return $this
			->subject($this->subject)
			->view('emails.default-email');
	}
}
