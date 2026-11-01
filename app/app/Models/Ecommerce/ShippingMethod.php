<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Represents a shipping method in the e-commerce system.
 */
class ShippingMethod extends Model {

	private const REQUIRED_WORKING_DAYS = [1, 2];
	private const WEEKEND_DAYS = [6, 7];
	private const WORK_DAY_END = 18;
	private const HOLIDAYS = ['15-08', '25-12', '26-12'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'base_price',
		'local_delivery',
		'minimum_delivery_days',
		'maximum_delivery_days',
	];

	/**
	 * * Attributes
	 */

	/**
	 * Get the shipping price
	 * 
	 * todo: add the shipping price calculation
	 * 
	 * @return float The price
	 */
	public function price(): float {
		return $this->base_price;
	}

	/**
	 * Get the minimum working days
	 * 
	 * @return int The minimum number of working days
	 */
	public function minimumWorkingDays(): int {
		return now()->hour < self::WORK_DAY_END ? self::REQUIRED_WORKING_DAYS[0] : self::REQUIRED_WORKING_DAYS[0] + 1;
	}

	/**
	 * Get the maximum working days
	 * 
	 * @return int The maximum number of working days
	 */
	public function maximumWorkingDays(): int {
		return now()->hour < self::WORK_DAY_END ? self::REQUIRED_WORKING_DAYS[1] : self::REQUIRED_WORKING_DAYS[1] + 1;
	}

	/**
	 * Get the minimum required days for the delivery
	 * 
	 * @return int The minimum required days
	 */
	public function minimumRequiredDays(): int {
		return $this->minimumWorkingDays() + $this->minimum_delivery_days;
	}

	/**
	 * Get the maximum required days for the delivery
	 * 
	 * @return int The maximum required days
	 */
	public function maximumRequiredDays(): int {
		return $this->maximumWorkingDays() + $this->maximum_delivery_days;
	}

	/**
	 * Calculate the possible delivery date
	 * 
	 * @param string $countFrom The starting time
	 * @param bool $minimumDeliveryDate Whether to calculate the minimum or maximum delivery date
	 * @return Carbon The calculated delivery date
	 */
	public function deliveryDate(string $countFrom = null, bool $minimumDeliveryDate = true): Carbon {
		// Get the starting time
		$startingTime = $countFrom ? Carbon::parse($countFrom) : now();

		// Initialize the variables
		$daysPassed = 0;
		$workDaysPassed = 0;
		$weekDayNumber = $startingTime->dayOfWeek;

		// Calculate the total required working days
		$totalRequiredDays = $minimumDeliveryDate ? $this->minimumRequiredDays() : $this->maximumRequiredDays();

		// Calculate how many days have to pass
		while ($workDaysPassed < $totalRequiredDays) {
			$daysPassed++;
			$weekDayNumber++;

			if ($weekDayNumber > 7) {
				$weekDayNumber = 1;
			}

			$currentDate = $startingTime->copy()->addDays($daysPassed)->format('d-m');

			if (!in_array($weekDayNumber, self::WEEKEND_DAYS) && !in_array($currentDate, self::HOLIDAYS)) {
				$workDaysPassed++;
			}
		}

		// Return the calculated delivery date
		return $startingTime->copy()->addDays($daysPassed);
	}
}
