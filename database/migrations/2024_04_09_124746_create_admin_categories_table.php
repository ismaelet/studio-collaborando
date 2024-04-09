<?php

use App\Models\Admin\AdminCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('admin_categories', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug')->unique();
			$table->integer('order')->default(0);
			$table->boolean('for_supervisors')->default(0);
			$table->timestamps();
		});

		AdminCategory::create([
			'name' => 'Impostazioni',
			'slug' => 'settings',
			'for_supervisors' => true,
		]);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('admin_categories');
	}
};
