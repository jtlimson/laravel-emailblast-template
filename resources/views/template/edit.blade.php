@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
			    Edit Template		
                </div>
            <div>
		</div>
            <div class="card-body"> 
                @if (session('message'))
                    <div class="alert alert-{{ session('alert')}}" role="alert">
                        {{ session('message') }}                                
                    </div>
                @endif    
                    
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                    @endif
                    <form method="POST" action="{{ route('tp.update') }}" enctype="multipart/form-data" class="form-style-1" >
                    @csrf 
                    <div class="row">
                        <div class="col-md-8">
                        <select name="category_id" required>
                            <option value=""> --- category --- </option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"  {{ ($template->category_id == $category->id)? "selected='selected'" : "" }}  > {{ $category->name }} </option>
                            @endforeach        
                        </select>
                        <a href="{{ route('c.index') }}">Create new category</a>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="title" placeholder="Subject" required value="{{ $template->title }}" />                          
                        </div>
                    </div>
                    <br />
                    <input type="hidden" name="body" placeholder="text" />                             
                    <input type="hidden" name="id" placeholder="text" value="{{ $template->id }}" />     
                    <div class="row">
                        <div class="col-md-12"><div id="editor" ><div id="toolbar-container"><div class="ql-editor">{!! html_entity_decode( trim($template->body) ) !!}</div></div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br /><br />
                    <br />
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary pull-right">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>  <br>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="{{ asset('public/js/highlight.min.js') }}"></script>
<script src="{{ asset('public/js/quill.min.js') }}"></script>
<script src="{{ asset('public/js/katex.min.js') }}"></script>
<link href="{{ asset('public/css/highlight.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/katex.min.css')  }}" rel="stylesheet">
<link href="{{ asset('public/css/quill.snow.css') }}" rel="stylesheet">
<script>
$(document).ready(function(){
    //https://quilljs.com/playground/#form-submit
   // event.preventDefault(); 

    var form = document.querySelector('form');

    form.onsubmit = function() 
    {
        var body  = document.querySelector('input[name=body]');            
        body.value = $('.ql-editor').html() ;     //quill.getContents()      
    };

    var toolbarOptions = [
                        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                        [{ 'direction': 'rtl' }],                         // text direction
                        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                        [{ 'font': [] }],
                        [{ 'align': [] }],
                        ['clean']                                         // remove formatting button
                        ];

    var quill = new Quill('#editor', {      
        modules: {
           formula: true,
           syntax: true,
           toolbar: toolbarOptions
        },
        placeholder: 'Compose something epic...',
        theme: 'snow'
    });
});
    
   
    
</script>
@endsection