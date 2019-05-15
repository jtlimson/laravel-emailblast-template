<?php

namespace App\Http\Controllers;

use App\Template;
use App\Category;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $categories = Category::get();        
        return view('template.template')->with(['categories'=> $categories]);       
    }

    public function create(Request $request)
    {      
        $request->validate([  
                        'category_id' => 'required' ,
                        'title' => 'required|unique:templates|max:255',
                        'body' => 'required']);
        $data = new Template;
        $data->fill($request->all());
        $data->save();
        
        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', "Saved successful!");          
         
        return redirect('tp');
    }

    public function show()
    {   
        $data = Template::get();
        return view('template.show')->withtemplate($data);
    }
  
    public function edit($id)
    {       
        $data = Template::find($id);
        $categories = Category::get();        
        return view('template.edit')->withtemplate($data)->withcategories($categories);
    }

    public function update(Request $request) {
        $request->validate([  
            'category_id' => 'required' ,
            'title' => 'required|max:255',
            'body' => 'required']);
        
      // $data = Template::updateOrCreate(['id', $request->id],$request );     
        $data = Template::find($request->id)->update($request->all());
    
        $request->session()->flash('alert', 'success');
        $request->session()->flash('message', "Saved successful!");          
        
        return redirect()->route('tp.edit', ['id' =>$request->id] );
    }

}
