@extends('layouts.layout')
@section('content')
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">{{ $album->name }} </h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the
                    creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it
                    entirely.</p>
                <p>
                    <a href="{{ route('photos.create', $album->id) }}" class="btn btn-primary">Add Photo</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    @forelse ($album->photos as $count => $item)
                        <div class="col-md-4 ">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top " style="height: 100px !important;width:100%:margin:auto "
                                    src="{{ asset('storage/' . $item->photo) }}" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text text-center ">{{ $item->name }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <form class="float-end" action="{{ route('photos.destroy', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger  btn-sm" type="submit">
                                                    Delete
                                                </button>

                                            </form>
                                        </div>
                                        <small class="text-muted">{{ $item->created_at }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{ asset('storage/img/images.png') }}" alt="No Photos">
                                <div class="card-body">
                                    <p class="card-text">No Photos Yet</p>

                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </main>
@endsection
