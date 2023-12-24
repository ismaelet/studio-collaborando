<?php

namespace App\Models\Newsletter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model {

	use HasFactory;

	protected $table = 'newsletter_subscribers';
	protected $fillable = ['email', 'first_name', 'last_name'];
}
