<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectCommissionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Data pengajuan proyek
     *
     * @var array
     */
    public array $formData;

    /**
     * Create a new message instance.
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $clientName = $this->formData['name'] ?? 'Klien';
        $categoryLabel = $this->formData['category_label'] ?? 'Umum';

        return new Envelope(
            subject: "[MMA Production] Pengajuan Proyek Baru: {$clientName} ({$categoryLabel})",
            replyTo: [
                new Address(
                    $this->formData['email'],
                    $this->formData['name'] ?? null
                ),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.project-commission',
            text: 'emails.project-commission-text',
            with: [
                'data' => $this->formData,
            ],
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
}

