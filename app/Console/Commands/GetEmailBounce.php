<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers;
use App\Unsubscribe;
class GetEmailBounce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getemail:bounce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get bounce email-address from bounce@domain.com inbox';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->info('Scanning bounced email-address...');
        //TODO USE POP3 or IMAP

        $hostname = config('mail.inbox_hostname');
        $username = config('mail.inbox_bounce_username');
        $password = config('mail.inbox_bounce_password');


        /* try to connect */
        $mbox = imap_open( $hostname, $username , $password) or die('Cannot connect to mail: ' . imap_last_error());
        // get information about the current mailbox (INBOX in this case)
        $mboxCheck = imap_check($mbox);

        $this->info("Number of messages in inbox: ". $mboxCheck->Nmsgs);//if 0 then exit;
        
        $errors= imap_errors();        
        if($mboxCheck->Nmsgs==0) {            
            exit();
        }

        $mboxSearch = imap_search($mbox,'ALL', ST_UID);
        $count = 0;
        foreach($mboxSearch as $email_number){
            $mboxMail = imap_fetch_overview ($mbox, $email_number);
            $body = imap_fetchbody($mbox,$email_number,3);	//3 is 3rd attachment
            $header = imap_fetchheader($mbox,$email_number);	
            
            //$email = \Helpers::extractEmail($body); //params ( string , term-to-search )
           // $this->info($email);
           $exploded_page = explode("\n", $body);
           $term = "To:" ;
           $email = array();
           
           foreach($exploded_page as $item){			
               if( false !== strpos( $item , $term )  ) {
                    preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $item, $matches);
                    $email = $matches[0];                                 
                    $data = Unsubscribe::updateOrCreate([ 'email' =>$email[0] ] ,
                    [ 'pin'=>'0000000' , 'unsubscription'=> 'ALL' ]);      
                    // If true then the actual row in the database has been modified
                    $wasCreated = $data->wasRecentlyCreated;                     
                    $wasChanged = $data->wasChanged();
                    $count = (!$wasCreated && $wasChanged) ? $count++ : $count;   

               }
           }

           //delete message
           $status = imap_setflag_full($mbox, '1:'.$email_number, '\\Deleted');
       
        }
        imap_expunge($mbox);
        imap_close($mbox);
        $this->info("bounced email-address updated count:  $count ");
        
    }

    

}
