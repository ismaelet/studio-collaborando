<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::rename('ecommerce_carts', 'orders');

		Schema::table('orders', function (Blueprint $table) {
			$table->renameColumn('customerId', 'user_id');
			$table->renameColumn('addressId', 'address_id');
			$table->renameColumn('couponId', 'coupon_id');
			$table->renameColumn('stepId', 'step');
			$table->renameColumn('statusId', 'status');
			$table->renameColumn('shippingMethodId', 'shipping_method_id');
			$table->renameColumn('paymentMethodId', 'payment_method_id');
			$table->renameColumn('staticFullShippingPrice', 'shipping_fee');
			$table->renameColumn('staticShippingDiscount', 'shipping_discount');
			$table->renameColumn('trackingCode', 'tracking_number');
			$table->renameColumn('time', 'created_at');
			$table->renameColumn('gift', 'is_gift');
			$table->timestamp('updated_at')->default(now())->after('time');
			$table->decimal('price', 10, 2)->after('staticShippingDiscount')->default(0);
			$table->decimal('order_items_price', 10, 2)->after('staticShippingDiscount')->default(0);
		});

		Schema::table('orders', function (Blueprint $table) {
			$table->unsignedBigInteger('user_id')->nullable()->change()->default(null);
			$table->unsignedBigInteger('shipping_method_id')->nullable()->change()->default(null);
			$table->unsignedBigInteger('payment_method_id')->nullable()->change()->default(null);
			$table->unsignedBigInteger('address_id')->nullable()->change()->default(null);
			$table->unsignedBigInteger('coupon_id')->nullable()->change()->default(null);
			$table->string('tracking_number')->nullable()->change()->default(null);
			$table->decimal('shipping_fee', 10, 2)->change()->default(0)->nullable(false);
			$table->decimal('shipping_discount', 10, 2)->change()->default(0)->nullable(false);
			$table->boolean('is_gift')->default(false)->change();
			$table->unsignedInteger('step')->default(1)->nullable(false)->change();
			$table->unsignedInteger('status')->default(0)->nullable(false)->change();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::rename('orders', 'ecommerce_carts');

		Schema::table('ecommerce_carts', function (Blueprint $table) {
			$table->renameColumn('user_id', 'customerId');
			$table->renameColumn('address_id', 'addressId');
			$table->renameColumn('coupon_id', 'couponId');
			$table->renameColumn('step', 'stepId');
			$table->renameColumn('status', 'statusId');
			$table->renameColumn('shipping_method_id', 'shippingMethodId');
			$table->renameColumn('payment_method_id', 'paymentMethodId');
			$table->renameColumn('shipping_fee', 'staticFullShippingPrice');
			$table->renameColumn('shipping_discount', 'staticShippingDiscount');
			$table->renameColumn('tracking_number', 'trackingCode');
			$table->renameColumn('created_at', 'time');
			$table->renameColumn('is_gift', 'gift');
			$table->dropColumn('updated_at');
			$table->dropColumn('price');
			$table->dropColumn('product_price');
		});
	}
};
