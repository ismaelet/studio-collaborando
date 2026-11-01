<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Partials\MonthlyUsersOverview;
use App\Filament\Widgets\Partials\RegisteredCustomersOverview;
use Filament\Widgets\StatsOverviewWidget;

class UsersOverviewGroup extends StatsOverviewWidget {

	protected static ?string $pollingInterval = null;

	protected static bool $isLazy = false;

	protected int | string | array $columnSpan = [
		'lg' => 'full',
	];

	protected function getStats(): array {
		return [
			MonthlyUsersOverview::make(),
			RegisteredCustomersOverview::make(),
		];
	}
}
