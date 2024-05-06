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

                                    <a href="{{ route('kpi.EmployeeKPI') }}" class="btn btn-sm btn-primary px-3 rounded-0">
                                       KPI</a>


                                    <a href="{{ route('reading.myRawNews') }}" class="btn btn-sm btn-info px-3 rounded-0">
                                        All Raw And Complete News</a>


                                    <a href="{{ route('reading.myNews') }}" class="btn btn-sm btn-secondary px-3 rounded-0">
                                        Back</a>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!--Input Group Start-->

                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="col">
                                        <div class="row shadow-sm text-muted">
                                            <div class="col text-uppercase ">
                                                <h5 style="font-size: 15px"> <strong>Todays Complete News</strong> </h5>
                                            </div>




                                            <!-- Button Add Category modal -->

                                        </div>
                                    </div>
                                    <div class="text-center py-2">
                                        @php
                                            $currentDate = date('Y-m-d');

                                            // Convert the date to the desired format
                                            $formattedDate = date('j F Y', strtotime($currentDate));

                                            // Output the formatted date
                                            echo $formattedDate;
                                        @endphp
                                    </div>
                                    <table class="table table-sm table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">SL</th>


                                                <th>Title</th>

                                                <th>Type</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Word</th>
                                             



                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody class="" style="font-size:0.9em;">
                                            @foreach ($tComNews as $news)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ Str::limit($news->title, 10) }}</td>
                                                    <td>{{ $news->nType }}</td>
                                                    <td>{{ $news->start_time }}</td>
                                                    <td>{{ $news->end_time }}</td>
                                                    <td>{{ $news->body }}</td> <!-- Count Bengali words -->
                                                    {{-- <td>{{ $news->column_no }}</td>
                                                    <td>{{ $news->page_no }}</td> --}}
                                                    <td>
                                                        <div class="btn-group btn-block" role="group"
                                                            aria-label="Basic example">
                                                            <a href="{{ route('sub_editor.show', $news->id) }}"
                                                                type="button" class="btn btn-sm btn-primary">View</a>
                                                            <a href="{{ route('sub_editor.edit', $news->id) }}"
                                                                type="button" class="btn btn-sm btn-info">Edit</a>
                                                            {{-- <button onclick="deleteData({{ $news->id }})" type="button"
                                                                class="btn btn-sm btn-danger">Delete</button> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>


                                    </table>
                                    {{ $tComNews->links() }}
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
