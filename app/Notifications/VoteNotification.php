<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $voter, protected $post)
    {
        $this->voter = $voter;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "menyukai postinganmu.",
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'post_img' => $this->post->attachments[0]->namafile,
            'post_created_at' => $this->post->created_at,
            'voter' => [
                'username' => $this->voter->username,
                'display_name' => $this->voter->display_name,
                'avatar' => $this->voter->avatar,
            ],
        ];
    }
}
