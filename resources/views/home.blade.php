@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="m-0">{{ __('Items') }}</h5>
                    <a href="{{route("items.create")}}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-plus"></i> CREATE </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th>Title</th>
                                <th width="15%">Price</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>Item#{{$item->id}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-target="#modal-{{$item->id}}" data-bs-toggle="modal"> <i class="fa fa-eye"></i> </button>
                                        
                                        <a href="{{route("items.edit", $item->id)}}" class="btn btn-sm btn-outline-info"> <i class="fa fa-pen"></i></a>
                                        
                                        <button 
                                            onclick="if(confirm('Are you sure? Once delete, you can\'t recover it.')){document.getElementById('delete-item-{{$item->id}}').submit()}" 
                                            class="btn btn-sm btn-outline-danger"
                                        > 
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <form action="{{route("items.destroy", $item->id)}}" method="POST" id="delete-item-{{$item->id}}">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" align="center" class="text-muted py-5">
                                        <i class="fa fa-folder-open" style="font-size: 56px"></i>
                                        <p class="m-0">No item found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($items as $value)
<div class="modal fade" id="modal-{{$value->id}}">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Item Details</h5>
                <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3><strong>Item:</strong> {{$value->title}}</h3>
                        <h4><strong>Price:</strong> {{$value->price}} TK</h4>
                        <h4><strong>Description:</strong></h4> <p>{{$value->description}}</p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset($value->image)}}" alt="image-{{$value->id}}" class="img-fluid mb-5 mx-auto d-block" width="350" height="350"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
