@extends('layouts.app')

@section('content')
    <section class="mt-md-4 pt-md-3">
        <div class="container-fluid">
            <div class="row" style="color: #444;">
                <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">

                    <div class="row py-2 ">
                        <div class="col">
                            <div class="row shadow-sm text-muted">
                                <div class="col text-uppercase ">
                                    <h5> <strong> Todays All News(From Reporter) </strong> </h5>
                                </div>


                                <div class="col text-uppercase ">
                                    <a href="{{ route('centre.view') }}" class="btn btn-sm btn-info px-3 rounded-0">
                                        <strong> Sub Editor List</strong> </a>
                                </div>


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
                            <table id="example" class="table table-sm table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th>Image</th>

                                        <th>Title</th>
                                        <th>Reporter</th>
                                        <th>Forward</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="" style="font-size:0.9em;">
                                    @foreach ($centreNewses as $news)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset($news->image) }}" width="50px" height="50px"
                                                    alt="">
                                            </td>
                                            <td>{{ $news->title }}</td>
                                            <td class="badge badge-info text-center">{{ $news->user->name }}</td>



                                            <td>
                                                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                                    <button onclick="sendReading({{ $news->id }})" type="button"
                                                        class="btn btn-sm btn-primary">Send to Reading</button>
                

                                                </div>
                                            </td>
                                            <td class="badge badge-danger">
                                                {{ $news->status === 0 ? 'Pending' : 'Unpublished' }}</td>
                                            <td>

                                                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                                    <a href="{{ route('centre.print', $news->id) }}" type="button"
                                                        class="btn btn-sm  btn-info">Print</a>
                                                        <a href="{{ url('centre/show/' . $news->id) }}" type="button"
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
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Please write carefully</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Page No</label>
                            <input type="number" class="form-control" id="page_no"
                                aria-describedby="emailHelp" placeholder="Page No">
                            <small id="emailHelp" class="form-text text-muted">Please write the
                                page number.</small>
                        </div>
                        <input type="hidden" id="id" value="">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Column No</label>
                            <input type="number" class="form-control" id="column_no"
                                placeholder="Column No">
                            <small id="emailHelp" class="form-text text-muted">Please write the
                                Column number.</small>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" onclick="submitToReading()"
                                class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>


    <script>
        function sendReading(id) {
                            //show modal 
                            $('#exampleModal').modal('show');

                            $('#id').val(id);

                        }

                        function submitToReading() {
                            let id = $('#id').val();
                            let page_no = $('#page_no').val();
                            let column_no = $('#column_no').val();
                            let forData = {
                                page_no: page_no,
                                column_no: column_no
                            }


                            axios.post('/sub_editor/store/check/' + id, forData)
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Successfully sent to reading",
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                $('#exampleModal').modal('hide');
                               
                                window.location.reload();
                            });



                        }
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
