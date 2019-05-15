<?php

namespace App\Http\Controllers;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Base64;
use Helpers;
use App\Subscribers;
use App\Batch;
class ImportCsvController extends Controller
{
    function import(){
        $batches = Batch::get();
        return view('importcsv.index')->with(['batches' => $batches]);;
    }
    function upload(Request $request){
        if( $request->hasfile('file')){
            $batch_id = $request->batch_id;
            $file =  $request->file('file'); 
            $path = Storage::putFile('upload',  $file );
            $path = $file->move( $path, $file->getClientOriginalName());
            $data = Helpers::csvToArray($path);            
            Subscribers::wherebatch_id($batch_id)->delete();
            $count = 0;
            foreach($data as $row) {                
                if(Helpers::isEmailValid($row['email']) ) {                     
                    $row = array_merge($row , [ 'batch_id'=>$batch_id ] );                
                    $Subscribers = Subscribers::firstOrNew( $row );
                    $Subscribers->save();
                    $count++;
                }
            }
            $batch = Batch::find($batch_id);
            $batch->status = 1;
            $batch->save();
            $request->session()->flash('message', 'attempting to insert '. count($data) .' data. actual inserted '. $count . ' data');
            $request->session()->flash('alert','success' );
        }else{
            $request->session()->flash('message','please select file' );
            $request->session()->flash('alert','danger' );
        }       
        return Redirect('import');
    }
  
}
