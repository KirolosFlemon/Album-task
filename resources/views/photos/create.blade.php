@extends('layouts.layout')
@section('content')
    <h1>Create New Photo</h1>


    <div class="card-defualt card">
        <div class="card-header">
            Create New Photo
        </div>
        <div class="card-body">
            <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" value="{{ $album_id }}" name="album_id">
                <div class="col-lg-12 col-md-12 mt-3">
                    <label for="Photo">Photo Name</label>
                    <input type="text" name="name" placeholder="Add New Album"
                        class="@error('name') is-invalid @enderror form-control">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>



                <div class="col-lg-12 col-md-12 mt-3">
                    <label for="img">Image : </label>
                    <input type="file" multiple name="photo" class="@error('image') is-invalid @enderror form-control">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12 col-md-12 mt-3 justify-content-center d-flex ">
                    <button type="submit" class="btn btn-primary w-50"> Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
