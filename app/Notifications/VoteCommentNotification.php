<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoteCommentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $voter, protected $comment)
    {
        $this->voter = $voter;
        $this->comment = $comment;
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
            'message' => "menyukai komentar",
            'comment_id' => $this->comment->id,
            'comment_content' => $this->comment->content,
            'post_id' => $this->comment->post_id,
            'post_title' => $this->comment->post->title,
            'post_img' => $this->comment->post->attachments[0]->namafile,
            'voter' => [
                'username' => $this->voter->username,
                'display_name' => $this->voter->display_name,
                'avatar' => $this->voter->avatar,
            ],
        ];
    }
}
