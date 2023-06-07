<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValidationCodeNotification extends Notification
{
    use Queueable;
    protected $__subject;
    protected $__salutation;
    protected $__line;
    protected $__action;

    /**
     * Create a new notification instance.
     */
    public function __construct($subject, $salutation, $contenu, $action)
    {
        $this->__subject = $subject;
        $this->__salutation = $salutation;
        $this->__line = $contenu;
        $this->__action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->__subject)
            ->greeting($this->__salutation)
            ->line($this->__line)
            ->action($this->__action, url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
