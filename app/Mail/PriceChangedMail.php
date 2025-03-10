<?php

namespace App\Mail;

use App\Dto\ProductUrlDto;
use App\Dto\UserDto;
use App\Models\ProductUrl;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PriceChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly UserDto       $userDto,
        private readonly ProductUrlDto $productUrlDto,
        private readonly float         $newPrice
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Price Changed Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.price_changed',
        )->with([
            'user' => $this->userDto,
            'productUrl' => $this->productUrlDto,
            'newPrice' => $this->newPrice
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
