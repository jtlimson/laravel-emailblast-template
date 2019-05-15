<?php

namespace App\Jobs;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\MailTemplate;
use App\Subscribers;
use App\Template;
use Base64;
use URL;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    
   private $timeout = 180;
   private $tries = 1;
   
   private $subscriber;
   private $email;
   private $pin;    
   private $template;

   public function __construct(Subscribers $subscriber, Template $template)
 // public function __construct()
   {
        $this->subscriber =  $subscriber;
        $this->template = $template;
   }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        $message = (new MailTemplate($this->subscriber , $this->template) );
        Mail::to(trim($this->subscriber->email))->queue( $message );
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
    */
    public function retryUntil()
    {
        return now()->addSeconds(5);
    }  
    
     public function failed(Exception $exception)
     {
       // Send user notification of failure, etc...
       // Save something here
     }
}
