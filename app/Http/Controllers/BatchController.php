<?php

namespace App\Http\Controllers;

use App\Batch;
use Illuminate\Http\Request;
use App\Subscribers;
class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('batches.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)    
    {
        $request->validate([             
            'name' => 'required|unique:batches|max:50']
        );
        $batch = new Batch;
        $batch->fill($request->all());
        $batch->save();

        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', "Create successful!");          
        return redirect('b');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //        
        $data = Batch::get();
        return view('batches.show')->with(['batch'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Batch::find($id);        
        return view('batches.edit')->with(['batch'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([             
            'name' => 'required|unique:batches|max:50']
        );
        $data = Batch::find($request->id);
        $data->name = $request->name;
        $data->save();
        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', "Update successful!");          
        return redirect()->route('b.edit', ['id' =>$request->id] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $batch = Batch::find($id);
        $ids_to_delete = array_map(function( $item ) {  return $item['id']; } , $batch->subscribers->toArray() );
        $subscribers = Subscribers::whereIn('id', $ids_to_delete )->delete();        
        $batch->delete();
        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', "Update successful!");                  
        echo 'success';//not needed for debugging purpose.
    }
}
