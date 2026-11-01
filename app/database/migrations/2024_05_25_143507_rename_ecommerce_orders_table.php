<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::rename('ecommerce_orders', 'order_items');

		Schema::table('order_items', function (Blueprint $table) {
			$table->renameColumn('cartId', 'order_id');
			$table->renameColumn('customerId', 'user_id');
			$table->renameColumn('productId', 'product_id');
			$table->renameColumn('staticFullPrice', 'price');
			$table->renameColumn('staticDiscount', 'product_discount');
			$table->decimal('product_price', 10, 2)->nullable(false)->default(0)->after('productId');
			$table->unsignedInteger('status')->default(1)->nullable(false);
			$table->renameColumn('time', 'created_at');
			$table->timestamp('updated_at')->default(now())->after('time');
		});

		Schema::table('order_items', function (Blueprint $table) {
			$table->unsignedBigInteger('order_id')->nullable(false)->change();
			$table->unsignedBigInteger('user_id')->nullable()->change();
			$table->unsignedBigInteger('product_id')->nullable(false)->change();
			$table->decimal('price', 10, 2)->nullable(false)->default(0)->change();
			$table->decimal('product_discount', 10, 2)->nullable(false)->default(0)->change();
			$table->unsignedInteger('quantity')->nullable(false)->default(1)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::rename('order_items', 'ecommerce_orders');

		Schema::table('ecommerce_orders', function (Blueprint $table) {
			$table->renameColumn('order_id', 'cartId');
			$table->renameColumn('user_id', 'customerId');
			$table->renameColumn('product_id', 'productId');
			$table->renameColumn('price', 'staticFullPrice');
			$table->renameColumn('product_discount', 'staticDiscount');
			$table->renameColumn('created_at', 'time');
			$table->dropColumn('product_price');
			$table->dropColumn('updated_at');
		});
	}
};
