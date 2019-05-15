<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)    
    {
        $request->validate([             
            'name' => 'required|max:50']
        );
        $Category = new Category;
        $Category->fill($request->all());
        $Category->save();

        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', "Create successful!");          
        return redirect('c');
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
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //        
        $data = Category::get();
        return view('categories.show')->with(['category'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::find($id);
        return view('categories.edit')->with(['category'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([             
            'name' => 'required|max:50']
        );
        $data = Category::find($request->id);
        $data->name = $request->name;
        $data->reply_to_email = $request->reply_to_email;
        $data->save();

        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', "Edit successful!");          

        return redirect()->route('c.edit', ['id' =>$request->id] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Category = Category::find(1);
        $Category->delete();
        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', "Delete successful!");
        return redirect('show');
    }
}
