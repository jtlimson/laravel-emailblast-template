<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers;
use App\Unsubscribe;

class GetEmailUnsubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getemail:unsubscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get unsubscibers email-addresses from unsubscribe@domain inbox';

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
        $this->info('Scanning unsubscribe email-address...');        
        //TODO USE POP3 or IMAP

        $hostname = config('mail.inbox_hostname');
        $username = config('mail.inbox_unsubscribe_username');
        $password = config('mail.inbox_unsubscribe_password');


        /* try to connect */
        $mbox = imap_open( $hostname, $username , $password) or die('Cannot connect to mail: ' . imap_last_error());
        // get information about the current mailbox (INBOX in this case)

        $mboxCheck = imap_check($mbox); // check hasEmail
        $this->info("Number of messages in inbox: ". $mboxCheck->Nmsgs);
     
        $errors= imap_errors();        
        if($mboxCheck->Nmsgs==0) {//if 0 then exit;            
            exit();
        }

        $mboxSearch = imap_search($mbox,'ALL', ST_UID);
        $count = 0;
        foreach($mboxSearch as $email_number){
            //$mboxMail = imap_fetch_overview ($mbox, $email_number);
            $body = imap_fetchbody($mbox,$email_number,1);	//3 is 3rd attachment
            $header = imap_headerinfo($mbox,$email_number);	            
            $fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
            $data = Unsubscribe::updateOrCreate(['email' => $fromaddr ] ,
            ['pin'=>'0000000', 'unsubscription'=>  $header->subject ]);

            $wasCreated = $data->wasRecentlyCreated;
            $wasChanged = $data->wasChanged();
            $count = (!$wasCreated && $wasChanged) ? $count++ : $count;      
                        
            //delete message                        
            $status = imap_setflag_full($mbox, '1:'.$email_number, '\\Deleted');
            
        }        

        imap_expunge($mbox);
        imap_close($mbox);
        $this->info("bounced email-address updated count:  $count ");
        
    }
}
