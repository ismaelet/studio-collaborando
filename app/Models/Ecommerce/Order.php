<?php

namespace App\Models\Ecommerce;

use App\Helpers\EcommerceHelper;
use App\Mail\OrderStatusMail;
use App\Models\Ecommerce\Coupon\ExhaustedCoupon;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/**
 * Represents a shopping order in the e-commerce system.
 */
class Order extends Model {

	private const DIGITAL_DELIVERY = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'address_id',
		'shipping_method_id',
		'payment_method_id',
		'coupon_id',
		'quantity',
		'order_items_price',
		'shipping_fee',
		'shipping_discount',
		'price',
		'payment_token',
		'tracking_number',
		'is_gift',
		'step',
		'status',
		'created_at',
	];

	/**
	 * * Events
	 */

	/**
	 * Update the order's order_items status when the order is updated.
	 * 
	 * @param array $attributes
	 * @param array $options
	 * @return bool
	 */
	public function update(array $attributes = [], array $options = []): bool {
		$this->order_items->each->update(['status' => $this->status]);

		return parent::update($attributes, $options);
	}

	/**
	 * * Accessors
	 */

	/**
	 * Get the id code.
	 * 
	 * @return string The id code
	 */
	public function id_code(): Attribute {
		return Attribute::make(
			get: fn (int $value): string => '#' . str_pad($value, 6, '0', STR_PAD_LEFT),
		);
	}

	/**
	 * * Relationships
	 */

	/**
	 * Get the order's user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}

	/**
	 * Get the order's shipping method.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function shipping_method(): BelongsTo {
		return $this->belongsTo(ShippingMethod::class);
	}

	/**
	 * Get the order's payment method.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function payment_method(): BelongsTo {
		return $this->belongsTo(PaymentMethod::class);
	}

	/**
	 * Get the order's address.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function address(): BelongsTo {
		return $this->belongsTo(Address::class);
	}

	/**
	 * Get the order's coupon.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function coupon(): BelongsTo {
		return $this->belongsTo(Coupon::class);
	}

	/**
	 * Get the order's order_items.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function order_items(): HasMany {
		return $this->hasMany(OrderItem::class);
	}


	/**
	 * * Attributes
	 */

	/**
	 * Get the order's recap URL.
	 *
	 * @return string
	 */
	public function recapUrl(): string {
		return route('orders.show', $this);
	}

	/**
	 * Get the order's recap URL with the security token.
	 *
	 * @return string
	 */
	public function recapUrlWithToken(): string {
		return route('orders.show', [$this, 'token' => $this->token]);
	}

	/**
	 * Get the order's order_items as a string.
	 *
	 * @return string
	 */
	public function orderItemsString(): string {
		$orderItemsString = '';

		if (!$this->order_items->count()) {
			return 'Nessun prodotto';
		}

		foreach ($this->order_items as $orderItem) {
			$orderItemsString .= $orderItem->quantity . 'x ' . $orderItem->fullName() . '<br>';
		}

		return $orderItemsString;
	}

	/**
	 * Get the order's step data.
	 *
	 * @return array
	 */
	public function stepData(): array {
		return config('ecommerce.cart.steps')[$this->step];
	}

	/**
	 * Get the order's step tag.
	 *
	 * @return string
	 */
	public function stepTag(): string {
		return $this->stepData()['tag'];
	}

	/**
	 * Get the order's status data.
	 *
	 * @return string
	 */
	public function statusData(): array {
		return config('ecommerce.cart.statuses')[$this->status];
	}

	/**
	 * Get the order's status tag.
	 *
	 * @return string
	 */
	public function statusTag(): string {
		return $this->statusData()['tag'];
	}

	/**
	 * Get the order's status name.
	 *
	 * @return string
	 */
	public function statusName(): string {
		return $this->statusData()['label'];
	}

	/**
	 * Get the order's status color.
	 *
	 * @return string
	 */
	public function statusColor(): string {
		return $this->statusData()['color'];
	}

	/**
	 * Get the status icon.
	 *
	 * @return string
	 */
	public function statusIcon(): string {
		return $this->statusData()['icon'];
	}

	/**
	 * Get the order's total price.
	 *
	 * @return float
	 */
	public function price(): float {
		return $this->updatePrice()->price;
	}

	/**
	 * Get the order's order_items net price.
	 *
	 * @return float
	 */
	public function orderItemsPrice(): float {
		$orderItemsPrice = 0;

		foreach ($this->order_items as $orderItem) {
			$orderItemsPrice += $orderItem->price();
		}

		return $orderItemsPrice;
	}

	/**
	 * Get the order's order_items gross price.
	 *
	 * @return float
	 */
	public function grossOrderItemsPrice(): float {
		$grossOrderItemsPrice = 0;

		foreach ($this->order_items as $orderItem) {
			$grossOrderItemsPrice += $orderItem->grossPrice();
		}

		return $grossOrderItemsPrice;
	}

	/**
	 * Get the order's net shipping fee.
	 *
	 * @return float
	 */
	public function shippingFee(): float {
		return $this->credit_ship ? 0 : $this->grossShippingFee();
	}

	/**
	 * Get the order's gross shipping fee.
	 *
	 * @return float
	 */
	public function grossShippingFee(): float {
		return $this->shipping_method ? $this->shipping_method->price($this->order_items->sum('quantity')) : 0;
	}

	/**
	 * Get the order's total discount.
	 *
	 * @return float
	 */
	public function discount(): float {
		return $this->orderItemsDiscount() + $this->shippingDiscount();
	}

	/**
	 * Get the order's total order_items discount.
	 *
	 * @return float
	 */
	public function orderItemsDiscount(): float {
		$orderItemsDiscount = 0;

		foreach ($this->order_items as $orderItem) {
			$orderItemsDiscount += $orderItem->discount();
		}

		return $orderItemsDiscount;
	}

	/**
	 * Get the order's shipping discount.
	 *
	 * @return float
	 */
	public function shippingDiscount(): float {
		return 0;
	}

	/**
	 * Check if the order is a digital delivery.
	 * 
	 * @return bool
	 */
	public function isDigitalDelivery(): bool {
		return self::DIGITAL_DELIVERY;
	}

	/**
	 * * Actions
	 */

	/**
	 * Advance the order to the next step or to a specific step.
	 *
	 * @param string|null $advanceToStepTag The tag of the step to advance to (optional)
	 * @return self The updated order instance
	 */
	public function advance(?string $advanceToStepTag = null): self {
		// If no specific step is given, advance to the next step
		if (!$advanceToStepTag) {
			// The current order step
			$currentStep = $this->step;

			// The page step
			$pageStepTag = explode('.', Route::currentRouteName())[1] ?? null;
			$pageStep = EcommerceHelper::stepFromTag($pageStepTag);

			// Advance to the next step, if the current order step is equal to the page step
			if ($currentStep == $pageStep) {
				$this->update([
					'step' => $this->step + 1,
				]);
			}
		} else {
			// Advance to the given step
			$advanceToStep = EcommerceHelper::stepFromTag($advanceToStepTag);

			if ($advanceToStep) {
				$this->update([
					'step' => $advanceToStep,
				]);
			}
		}

		return $this;
	}

	/**
	 * Update the order's quantity and price.
	 *
	 * @return self
	 */
	public function updateOrderItems(): self {
		$this->updateQuantity();
		$this->updatePrice();

		return $this;
	}

	/**
	 * Update the order's quantity.
	 *
	 * @return self
	 */
	public function updateQuantity(): self {
		$this->update([
			'quantity' => $this->order_items->sum('quantity'),
		]);

		return $this;
	}

	/**
	 * Update the order's price.
	 *
	 * @return self
	 */
	public function updatePrice(): self {
		$orderItemsPrice = $this->orderItemsPrice();
		$shippingFee = $this->shippingFee();
		$price = $orderItemsPrice + $shippingFee;

		$this->update([
			'product_price' => $orderItemsPrice,
			'shipping_fee' => $shippingFee,
			'price' => $price,
		]);

		return $this;
	}

	/**
	 * Confirm the order.
	 *
	 * @param bool $sendNotification Whether to send the status email
	 * @return void
	 */
	public function confirm(bool $sendNotification = true): void {
		// Update the order
		$this->update([
			'created_at' => now(),
			'status' => EcommerceHelper::statusFromTag('confirmed'),
		]);

		// Remove the shipping price from the user's credit, if it was paid with the credit
		if ($this->credit_ship && $this->user && $this->user->isSeller()) {
			$this->user->seller->update(['credit' => $this->user->seller->credit - $this->grossShippingFee()]);
		}

		// Destroy used coupons
		if ($this->coupon) {
			if ($this->coupon->one_per_user) {
				ExhaustedCoupon::create([
					'coupon_id' => $this->coupon->id,
					'user_id' => $this->user_id
				]);
			}

			if (!$this->coupon->reusable) {
				$this->coupon->delete();
			}
		}

		// Send the confirmation email
		if ($sendNotification) {
			$this->sendStatusEmail();
		}
	}

	/**
	 * Cancel an order
	 * 
	 * @param bool $sendNotification Whether to send the status email
	 * @return void
	 */
	public function cancel(bool $sendNotification = false): void {

		// Update the order
		$this->update([
			'status' => EcommerceHelper::statusFromTag('cancelled'),
		]);

		// Send the status email
		if ($sendNotification) {
			$this->sendStatusEmail();
		}
	}

	/**
	 * Delete the order.
	 *
	 * @return bool
	 */
	public function delete(): bool {
		return parent::delete();
	}

	/**
	 * Send the order's status email.
	 */
	public function sendStatusEmail(): void {
		Mail::to($this->address->email)->queue(new OrderStatusMail($this));
	}

	/**
	 * * Query builders
	 */

	/**
	 * Get the orders that have been paid.
	 * 
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public static function hasBeenPaid(): Builder {
		return self::where('status', '>=', EcommerceHelper::statusFromTag('confirmed'));
	}

	/**
	 * Get the orders that have not been paid.
	 * 
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public static function hasNoParcel(): Builder {
		return self::join('addresses', 'orders.address_id', '=', 'addresses.id')
			->where('status', EcommerceHelper::statusFromTag('confirmed'))
			->whereIn('shipping_method_id', ShippingMethod::shippingMethodsWithLabels());
	}
}
