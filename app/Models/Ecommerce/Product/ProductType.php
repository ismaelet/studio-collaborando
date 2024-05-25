<?php

namespace App\Models\Ecommerce\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents a product type in the e-commerce system.
 */
class ProductType extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'plural_name',
		'slug',
	];
}
