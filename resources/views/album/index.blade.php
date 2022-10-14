@extends('layouts.layout')
@section('content')
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Album </h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the
                    creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it
                    entirely.</p>
                <p>
                    <a href="{{ route('album.create') }}" class="btn btn-primary">Add Album</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    @forelse ($albums as $count => $item)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{ asset('storage/img/download.jpg') }}"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text text-center">{{ $item->name }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <a href="{{ route('album.show', $item->id) }}"
                                                class="btn btn-sm btn-primary me-2">View</a>
                                            <a href="{{ route('album.edit', $item->id) }}"
                                                class="btn btn-sm btn-success">Edit </a>
                                            @if ($item->photos->count() > 0)
                                                <button type="button" class="btn btn-sm btn-danger folder_id"
                                                    data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                    Delete
                                                </button>
                                            @else
                                                <form class="float-end" action="{{ route('album.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger  btn-sm" type="submit">
                                                        delete </button>

                                                </form>
                                            @endif
                                        </div>
                                        <small class="text-muted">{{ $item->photos->count() }} Photo</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top"
                                    data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">No albums Yet</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </div>
                                        <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="float-end" action="{{ route('album.action') }}" method="POST">
                            <input type="hidden" name="folder_id" id="folder">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <select class="form-select" aria-label="Default select example" name="album_id">
                                        <option selected>Open this select menu</option>
                                        @forelse ($albums as  $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @empty
                                            <option selected>No Folder</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-md-4">

                                    <button class="btn btn-success  btn-sm" type="submit" value="update" name="submit"
                                        id="move">
                                        Move </button>
                                </div>
                                <div class="col-md-12">

                                    <button class="btn btn-danger w-100 m-auto  btn-sm" type="submit" value="delete" name="submit">
                                        Delete </button>

                                </div>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        </div>

    </main>

    <script>
        $folder_id = document.getElementsByClassName('folder_id');
        $folder_model = document.getElementById('folder');
        for (let $i = 0; $i < $folder_id.length; $i++) {
            $folder_id[$i].addEventListener("click", function() {
                $folder_model.value = $folder_id[$i].getAttribute('data-id');
            });
        }
    </script>
@endsection
