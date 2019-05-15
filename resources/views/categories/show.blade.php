@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Category-List
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
                    <form method="POST" action="" class="form-style-1" method="post" enctype="multipart/form-data">                        
                       <ul>                           
                        @foreach( $category as $item) 
                            <li> <a href="{{ route('c.edit' , [$item->id]) }}" >{{ $item->name }} </a> - {{ $item->sender_email }} </li>
                        @endforeach
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
