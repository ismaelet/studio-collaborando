<?php

namespace App\Mail;

use App\Helpers\EcommerceHelper;
use App\Models\Ecommerce\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderStatusMail extends Mailable {

	use Queueable, SerializesModels;

	public Order $order;
	public $subject;

	/**
	 * Create a new message instance
	 */
	public function __construct(Order $order) {
		$this->order = $order;
		$this->subject = 'Aggiornamento dell\'ordine ' . $order->idCode() . ': ' . $order->statusName();
	}

	/**
	 * Generate the mail envelope
	 * 
	 * @return Envelope
	 */
	public function envelope(): Envelope {
		return new Envelope(
			from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
			replyTo: [
				new Address(config('custom.contacts.email.label'), env('MAIL_FROM_NAME')),
			],
			subject: $this->subject,
		);
	}

	/**
	 * Get the mail content
	 * 
	 * @return Content
	 */
	public function content(): Content {
		$content = $this->generateContent();

		if (!$content) {
			Log::error('OrderStatusMail: Status content not found', ['order' => $this->order, 'status' => $this->order->statusName()]);
		}

		return new Content(
			view: 'emails.order-status',
			with: [
				'order' => $this->order,
				'title' => $this->subject,
				'info' => $content,
			],
		);
	}

	/**
	 * Generate the mail content
	 * 
	 * @return string|false The mail content or false if not found
	 */
	private function generateContent(): string|false {
		$order = $this->order;
		$supportEmail = config('custom.contacts.email.label');

		switch ($order->status) {
			case EcommerceHelper::statusFromTag('cancelled'):
				// Cancelled status
				return 'L\'ordine è stato annullato. Se non hai richiesto tu l\'annullamento, contatta il nostro servizio clienti a <a href="mailto:' . $supportEmail . '">' . $supportEmail . '</a>.';

			case EcommerceHelper::statusFromTag('awaiting-payment'):
				// Awaiting payment status
				return 'L\'ordine è in fase di elaborazione del pagamento. Se entro un\'ora non riceverai una e-mail di conferma, controlla che il pagamento sia andato a buon fine.<br><br>Puoi usare il bottone qui sotto per tornare al riepilogo dell\'ordine tentare nuovamente il pagamento.<br><br>Se hai già pagato da più di un\'ora, ma l\'ordine continua a non essere confermato, contatta il nostro servizio clienti a <a href="mailto:' . $supportEmail . '">' . $supportEmail . '</a>.';

			case EcommerceHelper::statusFromTag('confirmed'):
				// Confirmed status
				$minimumWorkingDays = $order->shipping_method->minimumWorkingDays();
				$maximumWorkingDays = $order->shipping_method->maximumWorkingDays();

				return $order->isDigitalDelivery() ? 'Abbiamo confermato il pagameto dell\'ordine. Può già usufruire del servizio effettuando l\'accesso al tuo account' : 'Abbiamo confermato il pagameto dell\'ordine. I prodotti verranno spediti entro <span
				class="font-bold text-neutral-700">' . $minimumWorkingDays . '-' . $maximumWorkingDays . 'giorni lavorativi</span>.<br><br>Ti ringraziamo per aver scelto di acquistare da noi.';

			case EcommerceHelper::statusFromTag('shipped'):
				// Shipped status
				$maximumDeliveryDays = $order->shipping_method->maximum_delivery_days;

				return 'L\'ordine è stato spedito e verrà consegnato entro <span class="font-bold text-neutral-700">' . $maximumDeliveryDays . ' ' . ($maximumDeliveryDays != 1 ? 'giorni' : 'giorno') . '</span>.';

			case EcommerceHelper::statusFromTag('delivered'):
				// Delivered status
				return 'L\'ordine è stato consegnato. Se per caso non lo avessi ricevuto, contatta il nostro servizio clienti a <a href="mailto:' . $supportEmail . '">' . $supportEmail . '</a>.';

			default:
				return false;
		}
	}
}
