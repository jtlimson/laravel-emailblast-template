<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Subscribers;
use App\Template;
use Base64;
use URL;

class MailTemplate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subscriber;
    public $email;
    public $pin;    
    public $template;
    public $unsub_url;
    public $timeout = 180;
    public $tries = 1;

    public function __construct(Subscribers $subscriber, Template $template)
    {
        $this->subscriber =  $subscriber;
        $this->email = Base64::url_encode($subscriber->email) ;
        $this->pin = Base64::url_encode($subscriber->pin) ;
        $this->template = $template;
        $this->unsubscription = Base64::url_encode($template->category->name);
        $this->unsub_url = config('app.unsubscribe_url'). 'unsub/' . $this->email. '/'.  $this->pin . '/'. $this->unsubscription ;
    }

    /**
     * Build the message.
     * https://laravel.com/docs/5.8/queues#dealing-with-failed-jobs
     * @return $this
     */

    public function build()
    {
        $email = Base64::url_decode( $this->email );
        return $this->markdown('emails.template')->with([
            'email' => $email ,
            'UnsubscribeURL' => config('app.unsubscribe_url') .  'unsub/' . $this->email. '/'.  $this->pin   ,
            'body' => $this->template->body ,
            'template' => $this->template,
            'subscriber' => $this->subscriber
        ])
        ->withSwiftMessage(function ($message) {
            $message                          
                // POST-Unsubcribe
                // ->addTextHeader('List-Unsubscribe','<mailto:'.config('mail.unsubscribe') .'?subject='. $this->template->category->name .'>' )   ;                
                //read https://stackoverflow.com/questions/28497332/gmail-unsubscribe-link-does-not-appear    
                ->getHeaders()                                
                ->addTextHeader('List-Unsubscribe','<'. $this->unsub_url.'>,<mailto:'.config('mail.unsubscribe') .'?subject='. $this->template->category->name .'>' );                
            /**
             * To-be able to work this. we need to apply the holy trinity of email in our smtp server          
             * $message
             *  ->getHeaders()                 
             *  ->addTextHeader('List-Unsubscribe-Post=One-Click');
             */             
            $message
                ->setReturnPath( config('mail.return_path')  );
            $message
                ->setReadReceiptTo( config('mail.read_receipt') ) ;                
        })
        ->from( $this->template->category->sender_email )
        ->subject( $this->template->title );  
    }       
}
