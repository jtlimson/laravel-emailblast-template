<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unsubscribe;
use App\Category;
use App\Mail\Announcements;
use Base64;
use Mail;
class UnsubscriberController extends Controller
{
    
    //get??
    function unsub($email, $pin) {        
      //  echo $email;
      //  echo $pin;
        //$decode = Base64::url_decode($email); // hidden in field type
        //$pin = Base64::url_decode($pin); // hidden in field type
        //$categories = Category::get();
        $categories = \DB::table('categories')->select('name')->distinct('name')->get();
        $data = array(
            'email' => $email,
            'pin' => $pin,
            'categories' => $categories
        );

        return view('unsubscribe')->with($data);
    }

    //POST
    function unsubscribe(Request $unsub) {      
        $email = Base64::url_decode( $unsub->email);
        $pin = Base64::url_decode($unsub->pin);
        $unsubscription =  Base64::url_decode($unsub->unsubscription);
        $data = Unsubscribe::updateOrCreate(['email' => $email, 'pin'=> $pin ] ,
                                            [ 'unsubscription'=> json_encode($request->unsubscription) ]);
                                                
        //Mail::to(trim($email))->send(new Announcements($data));
        if ( $unsub->isMethod('post') ) {
            exit;
        }
        if ( $unsub->isMethod('get') ) {            
            $unsub->session()->flash('status', 'Subscription Successfully Updated!');
            return redirect('update');
        }
    }
    //GET
    function update()
    {
        return view('update');
    }
    //POST
    function updatesub(Request $request )
    {
        $email = Base64::url_decode( $request->email );
        $pin = Base64::url_decode( $request->pin );
        $unsub = Unsubscribe::updateOrCreate(['email' => trim( $email ) , 'pin'=> trim( $pin ) ],
                                             ['unsubscription'=> json_encode( $request->unsubscription )]);
        $request->session()->flash('message', 'Un-subscription Successfully Updated!');
        return back();
    }  

    //GET
    function show(Request $request){
        $unsubscribed = Unsubscribe::get();
        return view('unsubscribe.show')->withdata($unsubscribed);
    }
}
