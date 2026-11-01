<?php

namespace App\Filament\Widgets\Partials;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Number;

class MonthlyUsersOverview {

	/**
	 * Invoke the widget.
	 *
	 * @return Stat The generated statistic.
	 */
	public static function make(): Stat {
		$value = self::getInvervalData(0);
		$latsValue = self::getInvervalData(1);
		$difference = $latsValue ? round($value / $latsValue * 100) - 100 : 0;
		$positiveTrend = $difference > 0;
		$negativeTrend = $difference < 0;

		return Stat::make('Nuovi utenti', Number::abbreviate($value))
			->description(($positiveTrend ? '+' : '') . $difference . '% rispetto al mese scorso')
			->descriptionIcon($positiveTrend ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
			->chart(self::getData())
			->color($negativeTrend ? 'danger' : 'success');
	}

	/**
	 * Get the data for the chart.
	 *
	 * @return array The chart data.
	 */
	private static function getData(): array {
		$data = Trend::model(User::class)
			->between(
				start: now()->subMonth(),
				end: now(),
			)
			->perDay()
			->count();

		return $data->map(fn (TrendValue $value) => $value->aggregate)->toArray();
	}

	/**
	 * Get the data of the selected interval.
	 * 
	 * @int $intervalJump How many times to jump back in the past.
	 * @return int The data of the selected interval.
	 */
	private static function getInvervalData(int $intervalJump): int {
		return User::whereBetween('created_at', [now()->subMonths($intervalJump - 1), now()->subMonths($intervalJump)])->count();
	}
}
