<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Represents an address in the e-commerce system.
 */
class Address extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'full_name',
		'first_name',
		'last_name',
		'address_line_1',
		'address_line_2',
		'number',
		'city',
		'zip',
		'state',
		'country',
		'email',
		'phone',
	];

	/**
	 * * Accessors
	 */

	/**
	 * Get the full name
	 * 
	 * @return string The full name
	 */
	public function full_name(): Attribute {
		return Attribute::make(
			get: fn (?string $value): string => $value ?: $this->first_name . ' ' . $this->last_name,
		);
	}

	/**
	 * * Attributes
	 */

	/**
	 * Get the full address
	 * 
	 * @return string The full address
	 */
	public function fullAddress(): string {
		$recipientLine = $this->full_name;
		$addressLine1 = $this->address_line_1;
		$addressLine2 = $this->address_line_2;
		$cityLine = $this->zip . ' ' . $this->city . ' (' . $this->state . ')';

		return implode('<br>', array_filter([$recipientLine, $addressLine1, $addressLine2, $cityLine]));
	}

	/**
	 * Get the customer's contact data
	 * 
	 * @return array The contacts
	 */
	public function contactData(): array {
		return array_filter([$this->phone, $this->email]);
	}
}
