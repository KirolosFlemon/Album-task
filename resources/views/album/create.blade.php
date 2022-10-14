@extends('layouts.layout')
@section('content')
<h1>{{ isset($albums) ?" Edit Album" :"Create New Album"}}</h1>


<div class="card-defualt card">
    <div class="card-header">
        {{ isset($albums) ?" Edit Album" :"Create New Album"}}
    </div>
    <div class="card-body">
        <form action=" {{isset($albums) ?  route('album.update',$albums ->id) : route('album.store') }}" method="POST">
            @csrf
            @if (isset($albums))
            @method('PUT')
            @endif
                <div class="col-lg-12 col-md-12 mt-3">
                    <label for="album">Album Name</label>
                    <input type="text" name="name" value="{{isset($albums) ? $albums->name : ""}}"
                         placeholder="Add New Album"
                         class="@error('name') is-invalid @enderror form-control">
                         @error('name')
                         <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                </div>
                <div class="col-lg-12 col-md-12 mt-3 justify-content-center d-flex ">
                    <button type="submit" class="btn btn-primary w-50">{{ isset($albums) ?" Update" :"Submit"}}</button>
                </div>
        </form>
    </div>
</div>
@endsection
