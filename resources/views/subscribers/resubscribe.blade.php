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
                    <form method="POST" action="{{ route('subscribe') }}" class="form-style-1">
                    @csrf        
                        <h3>Welcome Back!</h3>
                        <p>Enter your email address to re-subscribe to our mailing-list! </p>
                        <input type="email" required name="email"/> <button> go </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
