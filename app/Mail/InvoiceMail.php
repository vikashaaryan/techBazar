<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The invoice instance.
     *
     * @var \App\Models\Invoice
     */
    public $invoice;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Invoice $invoice
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice #' . $this->invoice->invoice_no . ' - ' . config('app.name'),
            from: config('mail.from.address'),
            replyTo: config('mail.from.address'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'manager.invoice-genrate-pdf',
            with: [
                'invoice' => $this->invoice,
                'customer' => $this->invoice->customer,
                'date' => $this->invoice->created_at->format('F j, Y'),
                'dueDate' => $this->invoice->due_date->format('F j, Y'),
                'total' => number_format($this->invoice->total, 2),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */

    public function attachments(): array
    {
        return [
            // Attachment::fromStorage($this->pdfpath)
            //     ->as('Invoice_' . $this->invoice->invoice_no . '.pdf')
            //     ->withMime('application/pdf'),
        ];
    }
}
