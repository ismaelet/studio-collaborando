<?php

namespace App\Filament\Widgets\Partials;

use App\Models\Ecommerce\Order;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RegisteredCustomersOverview {

	/**
	 * Invoke the widget.
	 *
	 * @return Stat The generated statistic.
	 */
	public static function make(): Stat {
		$value = self::getIntervalPercentage(0);
		$latsValue = self::getIntervalPercentage(1);
		$difference = $latsValue ? round($value / $latsValue * 100) - 100 : 0;
		$positiveTrend = $difference > 0;
		$negativeTrend = $difference < 0;

		return Stat::make('Clienti registrati', $value . '%')
			->description(($positiveTrend ? '+' : '') . $difference . '% rispetto all\'anno scorso')
			->descriptionIcon($positiveTrend ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
			->color($negativeTrend ? 'danger' : 'success');
	}

	/**
	 * Get the percentage of registered customers of the selected interval.
	 * 
	 * @int $intervalJump How many times to jump back in the past.
	 * @return int The percentage of registered customers of the selected interval.
	 */
	private static function getIntervalPercentage(int $intervalJump): int {
		$registeredCustomers = Order::hasBeenPaid()
			->whereNotNull('user_id')
			->whereBetween('created_at', [now()->subYears($intervalJump + 1), now()->subYears($intervalJump)])
			->count();
		$notRegisteredCustomers = Order::hasBeenPaid()
			->whereNull('user_id')
			->whereBetween('created_at', [now()->subYears($intervalJump + 1), now()->subYears($intervalJump)])
			->count();

		return $notRegisteredCustomers ? round($registeredCustomers / ($registeredCustomers + $notRegisteredCustomers) * 100) : 0;
	}
}
