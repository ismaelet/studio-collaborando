<?php

namespace App\Filament\Widgets;

use App\Models\Ecommerce\OrderItem;
use Filament\Widgets\ChartWidget;

class ProductTypesChart extends ChartWidget {

	protected static ?string $heading = 'Categorie più vendute';

	protected static ?string $description = 'Le categorie di prodotto più vendute del mese';

	protected static ?string $pollingInterval = null;

	protected static bool $isLazy = false;

	protected int | string | array $columnSpan = [
		'lg' => 7,
	];

	protected function getType(): string {
		return 'bar';
	}

	protected function getData(): array {
		$productTypes = [];

		$data = OrderItem::hasBeenPaid()
			->join('products', 'order_items.product_id', '=', 'products.id')
			->selectRaw('product_type_id, SUM(quantity) as sale_quantity')
			->whereBetween('order_items.created_at', [now()->subMonth(), now()])
			->groupBy('product_type_id')
			->orderByDesc('sale_quantity')
			->with('type')
			->limit(10)
			->get();

		$data = $data->sortBy('sale_quantity');

		$data->each(function ($item) use (&$productTypes) {
			$productTypes[$item->type->name] = $item->sale_quantity;
		});

		return [
			'datasets' => [
				[
					'label' => now()->year,
					'data' => array_values($productTypes),
				],
			],
			'labels' => array_keys($productTypes),
		];
	}
}
