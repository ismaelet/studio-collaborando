<?php

namespace App\Models\Ecommerce;

use App\Helpers\EcommerceHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represents an order in the e-commerce system.
 */
class OrderItem extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'order_id',
		'product_id',
		'product_price',
		'product_discount',
		'price',
		'quantity',
	];

	/**
	 * * Accessors
	 */

	/**
	 * Get the id code.
	 * 
	 * @return string The id code
	 */
	public function id_code(): Attribute {
		return Attribute::make(
			get: fn (int $value): string => '#' . str_pad($value, 6, '0', STR_PAD_LEFT),
		);
	}

	/**
	 * * Relationships 
	 */

	/**
	 * Get the order that the order item belongs to.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function order(): BelongsTo {
		return $this->belongsTo(Order::class);
	}

	/**
	 * Get the order's product.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product(): BelongsTo {
		return $this->belongsTo(Product::class);
	}

	/**
	 * Get the order's product including trashed products.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function product_with_trashed(): BelongsTo {
		return $this->belongsTo(Product::class)->withTrashed();
	}

	/**
	 * * Attributes
	 */

	/**
	 * Get the name of the order.
	 *
	 * @return string
	 */
	public function name(): string {
		return $this->product ? $this->product->name : 'Articolo rimosso';
	}

	/**
	 * Get the name of the order.
	 *
	 * @return string
	 */
	public function nameWithQuantity(): string {
		return $this->quantity . 'x ' . $this->name();
	}

	/**
	 * Returns the image of the order.
	 *
	 * @return string
	 */
	public function image(): string {
		return $this->product->image();
	}

	/**
	 * Get the total discount.
	 *
	 * @return float
	 */
	public function discount(): float {
		return $this->product_discount * $this->quantity;
	}

	/**
	 * Calculate the total price of the order.
	 *
	 * @return float
	 */
	public function calcPrice(): float {
		return ($this->product_price - $this->product_discount) * $this->quantity;
	}

	/**
	 * * Actions 
	 */

	/**
	 * Delete the order.
	 *
	 * @return bool|null
	 */
	public function delete(): bool|null {
		$order = $this->order;
		$result = parent::delete();
		$order->updateOrderItems();

		if (!$order->quantity) {
			$order->delete();
		}

		return $result;
	}

	/**
	 * * Query builders
	 */

	/**
	 * Get the orders that have been paid.
	 * 
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public static function hasBeenPaid(): Builder {
		return self::where('order_items.status', '>=', EcommerceHelper::statusFromTag('confirmed'));
	}
}
