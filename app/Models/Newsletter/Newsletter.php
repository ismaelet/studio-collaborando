<?php

namespace App\Models\Newsletter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model {

	use HasFactory;

	protected $table = 'newsletters';
	protected $fillable = ['content', 'subject', 'sent'];
}
