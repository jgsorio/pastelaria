<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOrderToMail extends Mailable
{
    use Queueable, SerializesModels;

    protected array $info;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->parseInfo($data);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Resumo da Compra',
            from: 'naoresponda@larastel.com.br'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.send-order',
            with: [
                'info' => $this->info
            ]
        );
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

    private function parseInfo(array $data)
    {
        $total = 0;
        $this->info['client'] = Client::where('id', $data['client_id'])->first();
        $this->info['products'] = $data['products'];
        foreach ($data['products'] as $product) {
            $total += (int) $product->price;
        }  
        $this->info['total'] = $total;
    }
}
