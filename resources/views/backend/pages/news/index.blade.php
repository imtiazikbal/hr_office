@extends('layouts.app')

@section('content')
    <section class="mt-md-4 pt-md-3">
        <div class="container-fluid">
            <div class="row" style="color: #444;">
                <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">

                    <div class="row py-2 ">
                        <div class="col">
                            <div class="row shadow-sm text-muted">
                               
                                <!-- Button Add Category modal -->
                                <div class="ml-auto mr-3">
                                    <a href="{{ route('news.create') }}" class="btn btn-sm btn-info px-3 rounded-0">Add
                                        News</a>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!--Input Group Start-->

                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-8">
                                   
                                        <div class="col">
                                            <div class="row shadow-sm text-muted">
                                                <div class="col text-uppercase ">
                                                    <h5 style="font-size: 20px"> <strong>Todays News </strong> </h5>
                                                </div>
                                               
                
                                               
                                            </div>
                                        </div>
                                 
                                    <table id="example" class="table table-sm table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">SL</th>
                                                <th>Image</th>
        
                                                <th>Title</th>
                                                <th>Reporter</th>
                                                <th>Step</th>
                                                <th>Last Activity</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
        
                                        <tbody class="" style="font-size:0.9em;">
                                            @foreach ($newses as $news)
                                                <tr>
        
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset($news->image) }}" width="50px" alt="">
                                                    </td>
                                                    <td>{{ $news->title }}</td>
                                                    <td>{{ $news->reporter }}</td>
                                                    <td
                                                        class="badge  text-center {{ $news->status == 1 ? ' badge-warning' : ($news->status == 2 ? 'badge-primary' : ($news->status == 2 ? 'badge-primary' : 'badge-primary')) }}">
                                                        {{ $news->status == 1 ? 'Centre' : ($news->status == 2 ? 'Reading' : ($news->status == 0 ? 'Centre' : ($news->status == 3 ? 'Reading' : 'Approved By Reading'))) }}
                                                    </td>
        
                                                    <td>
                                                        {{ 'Posted by ' . $news->user->name . ' on ' . $news->created_at->format('Y-m-d H:i:s') }}
        
                                                        @if ($news->log)
                                                            {{ '. Updated by ' . $news->log->name . ' on ' . $news->updated_at->format('Y-m-d H:i:s') }}
                                                        @endif
                                                    </td>
        
                                                   
        
                                                    <td>
        
                                                        <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                                            <a href="{{ route('news.show', $news->id) }}" type="button"
                                                                class="btn btn-sm  btn-primary">View</a>
                                                            {{-- <a href="{{ route('news.edit', $news->id) }}" type="button"
                                                                class="btn btn-sm btn-info">Edit</a> --}}
                                                            <button onclick="deleteData({{ $news->id }})" type="button"
                                                                class="btn btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </td>
        
                                                </tr>
                                            @endforeach
                                        </tbody>
        
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <div class="row py-2 ">
                                        <div class="col">
                                            <div class="row shadow-sm text-muted">
                                                <div class="col text-uppercase ">
                                                    <h5 style="font-size: 20px"> <strong>All News </strong> </h5>
                                                </div>
                                               
                
                                                <div class="col text-uppercase ">
                                                    <h5 style="font-size: 20px"> <strong>Draft News </strong> </h5>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <table  class="table table-sm table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">SL</th>
                                                <th>Image</th>
        
                                                <th>Title</th>
                                                
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
        
                                        <tbody class="" style="font-size:0.9em;">
                                            @foreach ($myNewses as $news)
                                                <tr>
        
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset($news->image) }}" width="50px" alt="">
                                                    </td>
                                                    <td>{{ Str::limit($news->title, 20) }}</td>
                                                  
                                                  
        
                                                   
                                                   
        
                                                    <td>
        
                                                        <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                                            <a href="{{ route('news.show', $news->id) }}" type="button"
                                                                class="btn btn-sm  btn-primary">View</a>
                                                            {{-- <a href="{{ route('news.edit', $news->id) }}" type="button"
                                                                class="btn btn-sm btn-info">Edit</a> --}}
                                                            <button onclick="deleteData({{ $news->id }})" type="button"
                                                                class="btn btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </td>
        
                                                </tr>
                                            @endforeach
                                        </tbody>
        
                                    </table>
                                    {{ $myNewses->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        async function deleteData(id) {

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/news/delete/' + id)
                        .then(function(response) {
                            window.location.reload();
                        })
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            });


        }
    </script>
    @if (session()->has('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            })

            ;
            (async () => {
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('success') }}',
                })
            })()
        </script>
    @endif

    @if (session()->has('warning'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            })

            ;
            (async () => {
                Toast.fire({
                    icon: 'warning',
                    title: '{{ session('warning') }}',
                })
            })()
        </script>
    @endif>
@endsection
