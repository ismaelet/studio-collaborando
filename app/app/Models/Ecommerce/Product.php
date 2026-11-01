<?php

namespace App\Models\Ecommerce;

use App\Helpers\EcommerceHelper;
use App\Models\Ecommerce\Product\ProductType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model {

	use HasFactory;

	protected $fillable = [
		'name',
		'product_type_id',
		'price',
		'status'
	];

	/**
	 * * Accessors
	 */

	/**
	 * Get the product's slug.
	 * 
	 * @return string The product's slug
	 */
	public function slug(): Attribute {
		return Attribute::make(
			get: fn (): string => $this->id . '-' . Str::slug($this->name),
		);
	}

	/**
	 * * Relationships 
	 */

	/**
	 * Get the product's type.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function type(): BelongsTo {
		return $this->belongsTo(ProductType::class);
	}

	/**
	 * * Attributes 
	 */

	/**
	 * Get the product's url
	 * 
	 * @return string The product's url
	 */
	public function url(): string {
		return route('products.show', $this);
	}

	/**
	 * Get the product's discount
	 * 
	 * todo: Implement the discount logic
	 * 
	 * @return float The product's discount
	 */
	public function customerDiscount(): float {
		return 0;
	}

	/**
	 * Get the product's price for the customer
	 * 
	 * @return float The product's price for the customer
	 */
	public function customerPrice(): float {
		return $this->price - $this->customerDiscount();
	}

	/**
	 * Get the product's image
	 * 
	 * @return string The product's image
	 */
	public function image(): string {
		return asset('storage/products/' . $this->type->slug . '/' . $this->id . '.webp');
	}
}
