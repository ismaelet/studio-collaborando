<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table('admin_sections', function (Blueprint $table) {
			$table->renameColumn('admin_category_id', 'category_id');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('admin_sections', function (Blueprint $table) {
			$table->renameColumn('category_id', 'admin_category_id');
		});
	}
};
