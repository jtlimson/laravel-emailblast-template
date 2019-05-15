<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Subscribers;
use App\Unsubscribe;
use App\Template;
use App\Category;
use App\Batch;
use App\Mail\MailTemplate;
use App\Jobs\SendEmail;
use Helpers;
use Base64;
use Mail;

class SubscriberController extends Controller
{
    function show()
    {
        $Subscribers = Subscribers::get();
        $Template = Template::get();
        $Batch = Batch::get();
        return view('subscribers.list')->with( [ 'Subscribers'=> $Subscribers, 'Template' => $Template, 'Batch' => $Batch  ] ); 
    }
    
    function blast(Request $request){     
        $Template = Template::find($request->template_id);     
        $templatename = $Template->category->name;
        $Unsubscribers = Unsubscribe::select('email')
                                    ->where('unsubscription', 'ALL') // ALL if for bounced e-mails
                                    ->orWhere('unsubscription', 'like', '%'. $templatename .'%')->get();                                           
        $unsubarr = $Unsubscribers->map(function($Unsubscribers){
            return $Unsubscribers->email;
        });         
        $Subscribers = Subscribers::wherebatch_id($request->batch_id)
                                    ->whereNotIn( 'email', $unsubarr )->get();      
     
        if(Input::get('preview')) {            
            return new MailTemplate( $Subscribers->first() ,  $Template );
        }else if(Input::get('blastoff')){
            //https://laravel.com/docs/5.8/mail
            //https://laravel.com/docs/5.8/queues
            //https://laravel.com/docs/5.8/queues#synchronous-dispatching
            $count = 0;
            $batch = Batch::find($request->batch_id);
            $batch->status = 2;
            $batch->save();
            
            foreach($Subscribers as $subs) 
            {
                Mail::to(trim( $subs->email ) )->queue( new MailTemplate( $subs ,  $Template ) );        
                $count++;
            }
            $request->session()->flash('alert', 'success');
            $request->session()->flash('message', "$count E-mail queued");
            return back();

        }else if(Input::get('test')) {
            //https://laravel.com/docs/5.8/mail           
            Mail::to( config('mail.admin') )->send(new MailTemplate($Subscribers->first(),  $Template ));
            if( count(Mail::failures()) > 0 ) {
                $message = "There was one or more failures. They were: <br />";            
                foreach(Mail::failures() as $email_address) {
                    $message += " - $email_address <br />";
                 }
                 $alert="danger";
            } else {
                $alert="success";
                $message = "No errors, all sent successfully!";
            }

            $request->session()->flash('alert', $alert);
            $request->session()->flash('message', $message);
            return back();  
        }
        $request->session()->flash('alert', 'danger');
        $request->session()->flash('message', $message);
        return back();    
    }
    function resubscribe(Request $request){
        $email = $request->email;
        //TODO:: find email and delete it from unsubscribers
        echo $email;
        $Unsubscribers = Unsubscribe::where( 'email' ,  $email );       
        $Unsubscribers->delete();        
        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', 'Subscription is successfully updated!');
        return back();
    }
}

