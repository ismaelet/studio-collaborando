<?php

namespace App\Helpers;

use App\Models\Ecommerce\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class EcommerceHelper {

	/**
	 * Get the active cart
	 *
	 * @return Cart|null The active cart if it exists, otherwise null
	 */
	public static function cart(): ?Order {
		if (auth()->check()) {
			return Auth::user()->cart ?? null;
		}

		if (session('cart_id')) {
			return Order::where('id', session('cart_id'))
				->where('status', EcommerceHelper::statusFromTag('open'))
				->first();
		}

		return null;
	}

	/**
	 * Format a price
	 * 
	 * @param float $price The price to format
	 * @param bool $forceNumber Whether to force the price to be displayed as a number
	 * @return string The formatted price
	 */
	public static function formatPrice(float $price, bool $forceNumber = false): string {
		if ($price || $forceNumber) {
			return Number::currency($price, 'EUR', config('app.locale'));
		} else {
			return __('Gratis');
		}
	}

	/**
	 * Get the step index based on the given step tag.
	 *
	 * @param string $stepTag The step tag to search for.
	 * @return int The step index if found, false otherwise.
	 */
	public static function stepFromTag(string $stepTag): int {
		$stepKeyPosition = array_search($stepTag, array_column(config('ecommerce.cart.steps'), 'tag'));

		if ($stepKeyPosition === false) {
			return false;
		}

		return array_keys(config('ecommerce.cart.steps'))[$stepKeyPosition];
	}

	/**
	 * Get the status index based on the given status tag.
	 *
	 * @param string $statusTag The status tag to search for.
	 * @return int The status index if found, false otherwise.
	 */
	public static function statusFromTag(string $statusTag): int {
		$statusKeyPosition = array_search($statusTag, array_column(config('ecommerce.cart.statuses'), 'tag'));

		if ($statusKeyPosition === false) {
			return false;
		}

		return array_keys(config('ecommerce.cart.statuses'))[$statusKeyPosition];
	}
}
