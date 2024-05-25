<?php

namespace App\Filament\Widgets;

use App\Models\Ecommerce\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class ProductsTable extends TableWidget {

	protected static ?string $heading = 'Prodotti del mese';

	protected static ?string $pollingInterval = null;

	protected static bool $isLazy = false;

	protected int | string | array $columnSpan = [
		'lg' => 5,
	];

	public function table(Table $table): Table {
		return $table
			->query(
				Product::orderByDesc('recent_sales')
					->limit(7)
			)
			->columns([
				Tables\Columns\TextColumn::make('recent_sales')
					->numeric()
					->label('Vendite'),
				Tables\Columns\TextColumn::make('name')
					->label('Prodotto')
					->wrap(),
			])
			->paginated(false);
	}
}
