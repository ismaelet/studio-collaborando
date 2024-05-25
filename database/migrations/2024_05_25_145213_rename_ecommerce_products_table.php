<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::rename('ecommerce_products', 'products');

		Schema::table('products', function (Blueprint $table) {
			$table->renameColumn('typeId', 'product_type_id');
			$table->renameColumn('recentSales', 'recent_sales');
			$table->renameColumn('time', 'created_at');
			$table->timestamp('updated_at')->default(now())->after('time');
		});

		Schema::table('products', function (Blueprint $table) {
			$table->unsignedBigInteger('product_type_id')->nullable(false)->change();
			$table->unsignedInteger('sales')->default(0)->change();
			$table->unsignedInteger('recent_sales')->default(0)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::rename('products', 'ecommerce_products');

		Schema::table('ecommerce_products', function (Blueprint $table) {
			$table->renameColumn('type_id', 'typeId');
			$table->renameColumn('recent_sales', 'recentSales');
			$table->renameColumn('created_at', 'time');
			$table->dropColumn('updated_at');
		});
	}
};
