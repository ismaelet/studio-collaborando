<?php

use App\Models\Admin\AdminSection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('admin_sections', function (Blueprint $table) {
			$table->id();
			$table->foreignId('admin_category_id')->constrained()->onDelete('cascade');
			$table->string('name');
			$table->string('slug');
			$table->integer('order')->default(0);
			$table->boolean('hidden')->default(0);
			$table->boolean('for_supervisors')->default(0);
			$table->timestamps();
		});

		AdminSection::create([
			'admin_category_id' => 1,
			'name' => 'Menu - Categorie',
			'slug' => 'categories/list',
			'for_supervisors' => true,
		]);

		AdminSection::create([
			'admin_category_id' => 1,
			'name' => 'Menu - Sezioni',
			'slug' => 'sections/list',
			'for_supervisors' => true,
		]);

		AdminSection::create([
			'admin_category_id' => 1,
			'name' => 'Aggiungi una categoria',
			'slug' => 'categories/add',
			'for_supervisors' => true,
			'hidden' => true,
		]);

		AdminSection::create([
			'admin_category_id' => 1,
			'name' => 'Aggiungi una sezione',
			'slug' => 'sections/add',
			'for_supervisors' => true,
			'hidden' => true,
		]);
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('admin_sections');
	}
};
