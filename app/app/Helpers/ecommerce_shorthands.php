<?php

use App\Helpers\EcommerceHelper;
use App\Models\Ecommerce\Order;

/**
 * Get the active cart.
 *
 * @return \App\Models\Ecommerce\Order|null The active cart object, or null if no active cart exists.
 */
function cart(): ?Order {
	return EcommerceHelper::cart();
}

/**
 * Formats the given price value as a string.
 *
 * @param float $value The price value to format.
 * @param bool $forceNumber (optional) Whether to force the value to be treated as a number or show "free" when the value is 0.
 * @return string The formatted price value as a string.
 */
function format_price(float $value, bool $forceNumber = true): string {
	return EcommerceHelper::formatPrice($value, $forceNumber);
}
