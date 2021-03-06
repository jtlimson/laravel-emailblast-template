
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
                        <li class="breadcrumb-item active" aria-current="page">Import</li>
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
                    <form method="POST" action="{{ route('import') }}" class="form-style-1" method="post" enctype="multipart/form-data">
                    @csrf 
                        <select name="batch_id" required>
                            <option value=""> ------- Select Batch ------- </option>
                            @foreach($batches as $list)
                                <option value="{{ $list->id }}"> {{ $list->name }} </option>
                            @endforeach        
                        </select>  <a href="{{ route('b.index') }}">Create new batch</a>
                        <br />
                        <br />
                        <p>                           
                            <input type="file" name="file" accept=".csv"/> 
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
