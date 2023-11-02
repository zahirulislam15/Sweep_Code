@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">

                    @if (Route::is("items.create"))
                    <h5 class="m-0">{{ __('Create an Items') }}</h5>
                        
                    @elseif(Route::is("items.edit"))
                    <h5 class="m-0">{{ __('Update Items') }}</h5>
                    @endif

                    <a href="{{route("items.index")}}" class="btn btn-sm btn-outline-primary"> <i class="fa fa-arrow-left"></i> Back </a>
                </div>

                <div class="card-body">
                    @if (session('exception'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('exception') }}
                        </div>
                    @endif

                    @isset($item)
                    <form action="{{route("items.update", $item->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

                        <div class="form-group mb-3">
                            <label>Title <strong class="text-danger">*</strong> </label>
                            <input 
                                type="text" 
                                class="form-control @error("title") is-invalid @enderror" 
                                name="title" 
                                placeholder="Please enter title"
                                value="{{old("title",$item->title)}}"
                            />
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group mb-3">
                                    <label>Price <strong class="text-danger">*</strong> </label>
                                    <input 
                                        type="number"
                                        class="form-control @error("price") is-invalid @enderror" 
                                        name="price" 
                                        placeholder="Please enter price"
                                        value="{{old("price", $item->price)}}"
                                    />
                                    @error('price')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group mb-3">
                                    <label>Image <small>(Optional)</small> </label>
                                    <input 
                                        type="file" 
                                        class="form-control @error("image") is-invalid @enderror" 
                                        name="image"
                                    />
                                    @error('image')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Description <strong class="text-danger">*</strong> </label>
                            <textarea 
                                type="text"
                                rows="5"
                                class="form-control @error("description") is-invalid @enderror" 
                                name="description"
                                placeholder="Please enter description"
                            >{{old("description", $item->description)}}</textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        @if ($item->image)
                            <div class="my-4">
                                <p class="m-0">Uploaded Image</p>
                                <img src="{{asset($item->image)}}" alt="image" class="img-fluid" width="300" />
                            </div>
                        @endif                        

                        <div class="row mt-5">
                            <div class="col-12 text-end">
                                <button class="btn btn-outline-primary px-5">Save</button>
                            </div>
                        </div>
                    </form>
                    @else
                    <form action="{{route("items.store")}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Title <strong class="text-danger">*</strong> </label>
                            <input 
                                type="text" 
                                class="form-control @error("title") is-invalid @enderror" 
                                name="title" 
                                placeholder="Please enter title"
                                value="{{old("title")}}"
                            />
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group mb-3">
                                    <label>Price <strong class="text-danger">*</strong> </label>
                                    <input 
                                        type="number"
                                        class="form-control @error("price") is-invalid @enderror" 
                                        name="price" 
                                        placeholder="Please enter price"
                                        value="{{old("price")}}"
                                    />
                                    @error('price')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group mb-3">
                                    <label>Image <small>(Optional)</small> </label>
                                    <input 
                                        type="file" 
                                        class="form-control @error("image") is-invalid @enderror" 
                                        name="image"
                                    />
                                    @error('image')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Description <strong class="text-danger">*</strong> </label>
                            <textarea 
                                type="text"
                                rows="5"
                                class="form-control @error("description") is-invalid @enderror" 
                                name="description"
                                placeholder="Please enter description"
                            >{{old("description")}}</textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="row mt-5">
                            <div class="col-12 text-end">
                                <button class="btn btn-outline-primary px-5">Save</button>
                            </div>
                        </div>
                    </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
