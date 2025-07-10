<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Invoice;
use App\Models\Payment;

class PaymentReceived extends Notification
{
    use Queueable;

    public $invoice;
    public $payment;

    public function __construct(Invoice $invoice, Payment $payment)
    {
        $this->invoice = $invoice;
        $this->payment = $payment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Payment Received - Invoice #' . $this->invoice->invoice_no)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We have received your payment of ₹' . number_format($this->payment->amount, 2) . ' for Invoice #' . $this->invoice->invoice_no . '.')
            ->line('Payment Method: ' . ucfirst($this->payment->method))
            ->line('Payment Date: ' . $this->payment->payment_date->format('d M Y'))
            ->action('View Invoice', route('customer.invoices.show', $this->invoice->id))
            ->line('Thank you for your business!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
