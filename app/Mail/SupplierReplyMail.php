<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupplierReplyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $supplier;
    public $message;

    public function __construct($message, $supplier)
    {
        $this->message = $message;
        $this->supplier = $supplier;
    }

    public function build()
    {
        return $this->subject('Reply to Your Inquiry')
            ->view('emails.supplier_reply')
            ->with([
                'supplierInfo' => $this->supplier,
                'messageContent' => $this->message,
            ]);
    }
}
