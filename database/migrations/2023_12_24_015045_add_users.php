<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		User::create([
			'first_name' => 'Flavia',
			'last_name' => 'Colombara',
			'email' => 'jerry18@libero.it',
			'password' => Hash::make('studiocollaborando'),
		]);
		User::create([
			'first_name' => 'Quipopi',
			'last_name' => '',
			'email' => 'quipopi@gmail.com',
			'password' => Hash::make('studiocollaborando'),
		]);
		User::create([
			'first_name' => 'DSA Trentino',
			'last_name' => '',
			'email' => 'dsa.trentino@gmail.com',
			'password' => Hash::make('studiocollaborando'),
		]);
		User::create([
			'first_name' => 'Quadrifoglio DSA',
			'last_name' => '',
			'email' => 'quadrifoglio.dsa.tn@gmail.com',
			'password' => Hash::make('studiocollaborando'),
		]);
		User::create([
			'first_name' => 'Sara',
			'last_name' => 'Sperandio',
			'email' => 'sara.sperandio92@gmail.com',
			'password' => Hash::make('studiocollaborando'),
		]);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		User::where('email', 'jerry18@libero.it')->delete();
		User::where('email', 'quipopi@gmail.com')->delete();
		User::where('email', 'dsa.trentino@gmail.com')->delete();
		User::where('email', 'quadrifoglio.dsa.tn@gmail.com')->delete();
		User::where('email', 'sara.sperandio92@gmail.com')->delete();
	}
};
