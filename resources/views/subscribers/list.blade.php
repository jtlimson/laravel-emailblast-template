

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Begin Blasting		
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
                    <form method="POST" action="{{ route('preview') }}" class="form-style-1">
                    @csrf                         
                        <div class="row">
                            <div class="col-md-12">
                            <select name="template_id" id="template_id" required>
                                <option value=""> ------- Select Template ------- </option>
                                @foreach($Template as $list)
                                    <option value="{{ $list->id }}"> {{ $list->title }} -> {{ $list->category->name }} </option>
                                @endforeach        
                            </select>      
                            <a href="{{ route('tp.index') }}"> Create new template </a>                      
                            </div>                          
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12">
                            <select name="batch_id" id="batch_id" required>
                                <option value=""> ------- Select Batch ------- </option>
                                @foreach($Batch as $list)
                                    <option value="{{ $list->id }}"> {{ $list->name }} </option>
                                @endforeach        
                            </select>      
                            <a href="{{ route('import') }}"> Import new batch </a>                      
                            </div>                          
                        </div>
                        <br />
                        <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="preview" value="1" class="btn btn-primary">
                                {{ __('Preview') }}
                            </button>                            
                            <button type="submit" name="test" value="1" class="btn btn-primary">
                                {{ __('Test-Email') }}
                            </button>                            
                            <button type="submit" name="blastoff" value="1" class="btn btn-success pull-right" style="float:right;">
                                {{ __('Create Job') }}
                            </button>                            
                        </div>
                        </div>
                        <br />
                        <div class="row">
                        <div class="col-md-12"><h3>Senders Info</h3></div>
                        <div class="col-md-12"><pre><code id="info"></code></pre></div>
                        <div class="col-md-12"><div id="edit_sender_info"></div></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script language="javascript">

    var category = {!! json_encode($Template) !!};
    console.log(category);
    $(document).ready(function(){
        $("#template_id").on('change', function(){                               
            var id = $(this).val();
            var APP_URL = {!! json_encode(url('/')) !!}
            var result = $.grep(category, function(element, index) {
                return (element.id == id);
            });      
            var string = JSON.stringify(result[0].category,null,4);
            $('#info').text( string );
            var href = "<a href='"+APP_URL+"/c/edit/"+ result[0].category.id +"'>Edit</a>";            
            $('#edit_sender_info').html(href);
        });
    });
    
</script>
@endsection