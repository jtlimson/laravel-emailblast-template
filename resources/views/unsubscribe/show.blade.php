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
                       
                    <table class="table">
                    <thead>
                        <tr>
                            <th>email</th>
                            <th>unsubscription list</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $data as $item) 
                        <tr>
                            <td> {{ $item->email }} </td> 
                            <td> {{ $item->unsubscription }}  </td>                      
                        </tr>
                        @endforeach
                    </tbody>
                    </table>            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
