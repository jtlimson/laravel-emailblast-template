
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Create Category
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
                    <form method="POST" action="{{ route('c.create') }}" class="form-style-1" method="post" enctype="multipart/form-data">
                    @csrf                        
                        <p>                           
                            <label>Category name: &nbsp;</label><input type="text" name="name" /> 
                        </p>  
                        <p>                           
                            <label>Category-Email(sender-email): &nbsp;</label><input type="text" name="sender_email" /> 
                        </p>                      
                        <p>                           
                            <label>Category-Email(reply_to_email): &nbsp;</label><input type="text" name="reply_to_email" /> 
                        </p>  
                        <p>
                            <button type="submit"> &nbsp;&nbsp; Save &nbsp;&nbsp; </button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
