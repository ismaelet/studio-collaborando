<?php

namespace App\Filament\Widgets\Partials;

use App\Models\Ecommerce\Order;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class YearlyRevenueOverview {

	/**
	 * Invoke the widget.
	 *
	 * @return Stat The generated statistic.
	 */
	public static function make(): Stat {
		$value = self::getInvervalData(0);
		$lastValue = self::getInvervalData(1);
		$difference = $lastValue ? round($value / $lastValue * 100) - 100 : 0;
		$positiveTrend = $difference > 0;

		return Stat::make('Fatturato annuale', format_price($value))
			->description(($positiveTrend ? '+' : '') . $difference . '% rispetto all\'anno scorso')
			->descriptionIcon($positiveTrend ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
			->chart(self::getData())
			->color(!$positiveTrend ? 'danger' : 'success');
	}

	/**
	 * Get the data for the chart.
	 *
	 * @return array The chart data.
	 */
	private static function getData(): array {
		$data = Trend::query(
			Order::hasBeenPaid()
		)
			->between(
				start: now()->subYear(),
				end: now(),
			)
			->perMonth()
			->sum('price');

		return $data->map(fn (TrendValue $value) => $value->aggregate)->toArray();
	}

	/**
	 * Get the data of the selected interval.
	 * 
	 * @int $intervalJump How many times to jump back in the past.
	 * @return float The data of the selected interval.
	 */
	private static function getInvervalData(int $intervalJump): float {
		return Order::hasBeenPaid()->whereBetween('created_at', [now()->subYears($intervalJump + 1), now()->subYears($intervalJump)])->sum('price');
	}
}
