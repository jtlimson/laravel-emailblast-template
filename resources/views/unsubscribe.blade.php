@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
			    Manage subscription
		        </div>
                <div class="card-body"> 
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
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
                    <form method="POST" action="{{ route('update') }}" class="form-style-1">
                    @csrf 
                    <p>
                    You are about to <b>UNSUBCRIBE</b> to our mailing-list. Please check the box if you wish to unsubscribe the category you don't want to hear.
                    </p>
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="hidden" name="pin" value="{{$pin}}"><br />
                        @foreach($categories as $category)
                            <input type="checkbox" name="unsubscription[]" value="{{ $category->name }}"> {{ $category->name }}<br />
                        @endforeach                        
                        <br />            
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary pull-right">
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
