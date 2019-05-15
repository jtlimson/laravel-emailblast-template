
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
		            Batch-List
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
                
                    <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                    @foreach( $batch as $item) 
                        <tr>
                            <td scope="row"> {{ $item->id }}</td>
                            <td> <a href="{{ route('b.edit' , [$item->id]) }}" >{{ $item->name }} </a>  </td>
                            @switch($item->status)
                                @case(0)
                                    <td> <span class="alert alert-light status_{{ $item->status }}"> </span> </td>
                                    @break
                                @case(1)
                                    <td> <span class="alert alert-info status_{{ $item->status }}"> </span> </td>
                                    @break
                                @case(2)
                                    <td> <span class="alert alert-warning status_{{ $item->status }}"> </span> </td>
                                    @break
                                @case(3)
                                <td> <span class="alert alert-success status_{{ $item->status }}"> </span> </td>
                                    @break
                                @default
                                    <td> <span class=" status_{{ $item->status }}"> </span> </td>        
                                    @break                            
                            @endswitch                            
                            <td><button value="{{ $item->id }}" class="remove btn btn-danger" alt="remove">  <i class="fa fa-trash"></i> </button>  </td>
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

@section('script')
<script>
    $(document).ready(function(){
        $('.remove').on('click', function(){            
            
            id = $(this).val() ;
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.post(base_url + '/b/delete/' +id  , function(reponse){              
                location.reload();
            });
        });
    });
</script>
@endsection