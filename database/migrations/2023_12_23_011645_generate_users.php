<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		DB::statement('
			INSERT INTO users (email, password, first_name, last_name)
			SELECT email, ?, firstName, lastName
			FROM ecommerce_addresses
			INNER JOIN ecommerce_carts ON ecommerce_carts.addressId = ecommerce_addresses.id
			WHERE statusId > 0
		', [Hash::make('studiocollaborando')]);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		DB::table('users')->truncate();
	}
};
