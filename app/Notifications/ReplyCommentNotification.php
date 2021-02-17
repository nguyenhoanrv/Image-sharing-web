<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user_name;
    protected $album_name;
    protected $par_name;
    protected $album_id;
    protected $author_name;
    public function __construct($user_name, $album_name, $album_id, $author_name, $par_name)
    {
        $this->user_name = $user_name;
        $this->user_name = $par_name;
        $this->album_name = $album_name;
        $this->album_id = $album_id;
        $this->author_name = $author_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }
    
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_name'=> $this->user_name,
            'par_name'=> $this->par_name,
            'author_name'=> $this->author_name,
            'album_name' => $this->album_name,
            'album_id' => $this->album_id
        ];
    }
}