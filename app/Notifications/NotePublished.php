<?php

namespace App\Notifications;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotePublished extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Note $note)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Нову нотатку опубліковано - '.$this->note->title)
            ->greeting('Вітаємо, '.$notifiable->name.'!')
            ->line('Ви щойно створили нотатку "'.$this->note->title.'".')
            ->line('Статус - '.$this->note->statusLabel())
            ->action('Відкрити нотатку', route('notes.show', $this->note))
            ->line('Дякуємо, що користуєтесь Notes App.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'note_id' => $this->note->id,
            'title' => $this->note->title,
            'status' => $this->note->status,
        ];
    }
}
