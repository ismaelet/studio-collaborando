<?php

use App\Models\Newsletter\Subscriber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::dropIfExists('newsletter_subscribers');

		Schema::create('newsletter_subscribers', function (Blueprint $table) {
			$table->id();
			$table->string('email')->unique();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->timestamps();
		});

		DB::statement('
			INSERT INTO newsletter_subscribers (email, first_name, last_name)
			SELECT email, firstName, lastName
			FROM ecommerce_addresses
			INNER JOIN ecommerce_carts ON ecommerce_carts.addressId = ecommerce_addresses.id
			WHERE statusId > 0
		');

		$extraSubscriber = ['jerry18@libero.it', 'quipopi@gmail.com', 'dsa.trentino@gmail.com', 'quadrifoglio.dsa.tn@gmail.com'];

		foreach ($extraSubscriber as $subscriber) {
			Subscriber::create([
				'email' => $subscriber,
			]);
		}

		Subscriber::where('email', 'sara.sperandio92@gmail.com')->delete();
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('newsletter_subscribers');
	}
};
