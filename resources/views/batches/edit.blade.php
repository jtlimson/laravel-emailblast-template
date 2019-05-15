
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{  route('b.show') }}">Batch</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                    </nav>
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
                    <form method="POST" action="{{ route('b.update') }}" class="form-style-1" method="post" enctype="multipart/form-data">
                    @csrf                        
                        <p> 
                            <input type="hidden" name="id" value="{{ $batch->id }}"/>                           
                            <label>Rename: &nbsp;</label><input type="text" name="name" value="{{ $batch->name }}"/> 
                        </p>                        
                        <p>
                            <button type="submit"> &nbsp;&nbsp; Save &nbsp;&nbsp; </button>
                        </p>
                        <table class="table" id="subscribers">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>PIN</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($batch->subscribers as $item)
                                <tr>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->pin }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" >    
    $(document).ready( function () {
        //TODO:: datatable;
    } );
</script>
@endsection