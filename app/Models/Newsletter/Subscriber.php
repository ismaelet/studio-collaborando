<?php

namespace App\Models\Newsletter;

use App\Mail\Welcome;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscriber extends Model {

	use HasFactory;

	protected $table = 'newsletter_subscribers';
	protected $fillable = [
		'email',
		'first_name',
		'last_name',
		'last_sent_newsletter_id'
	];

	/**
	 * Create a new subscriber and send them a welcome email.
	 */
	public static function createAndSend(array $data, bool $isRegistered = false) {
		if (!self::where('email', $data['email'])->exists()) {
			$subscriber = Subscriber::create($data);

			// Send welcome email
			Mail::to($subscriber->email)->send(new Welcome($isRegistered));
		} else {
			$subscriber = self::where('email', $data['email'])->first();
		}

		return $subscriber;
	}
}
