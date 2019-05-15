<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Subscribers;
use App\Unsubscribe;
use App\User;
//https://mattstauffer.com/blog/introducing-mailables-in-laravel-5-3/ -- queue
use Base64;
use URL;
class Announcements extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $unsubscriber;
    public $email;
    public $pin;
    public $unsub_url;
    public $unsubscription;
    public function __construct(Unsubscribe $unsub)
    {           
        $this->unsubscriber =  $unsub;
        $this->email = Base64::url_encode($unsub->email) ;
        $this->pin = Base64::url_encode($unsub->pin) ;
        $this->unsubscription = Base64::url_encode($unsub->unsubscription);
        $this->unsub_url = URL::to( 'unsub/' .$this->email. '/'.  $this->pin . '/'. $this->unsubscription );
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // TODO:: query central db for client information.                
        return $this->markdown('emails.category.announcements')->with([
            'email' =>  Base64::url_decode($this->unsubscriber->email )       ,
            'UnsubscribeURL' =>  URL::to('unsub/'. $this->email. '/'.  $this->pin  ),
            'message' => 'dynamic message'
        ])->withSwiftMessage(function ($message) {
            $message->getHeaders()                      
                ->addTextHeader('List-Unsubscribe','<'.$this->unsub_url.'><mailto:me@juliuslimson.com?subject=unsubscribe>','List-Unsubscribe-Post','List-Unsubscribe=One-Click' )  ;                
        })->from('me@juliuslimson.com');
    }
}
