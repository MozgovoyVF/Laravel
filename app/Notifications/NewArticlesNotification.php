<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewArticlesNotification extends Notification
{
    use Queueable;

    public $articles;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = '';

        foreach ($this->articles as $article) {
            $message .= $article->title . ' опубликована ' . $article->created_at . PHP_EOL;
        }

        return (new MailMessage)
                    ->subject('Новые статьи')
                    ->line($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
