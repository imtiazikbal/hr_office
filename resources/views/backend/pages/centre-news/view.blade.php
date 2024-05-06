@extends('layouts.app')

@section('content')
    <section class="mt-md-4 pt-md-3">
        <div class="container-fluid">
            <div class="row" style="color: #444; background-color: #e7e2e2">
                <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">

                    <div class="row py-2 ">
                        <div class="col">
                            <div class="row shadow-sm text-muted">

                                <div class="btn-group btn-block" role="group" aria-label="Basic example">

                                    <a href="{{ route('centre.edit', $centreNews->id) }}" type="button"
                                        class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ route('centre.print', $centreNews->id) }}" type="button" class="btn btn-primary">Print</a>


                                    <button onclick="sendReading({{ $centreNews->id }})" type="button"
                                        class="btn btn-sm btn-info">Send to Reading</button>

                                </div>
                                <!-- Button Add Category modal -->
                                <!-- Button trigger modal -->
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}

                                <!-- Modal -->
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
                                                    {{-- <div class="form-group">
                            <label for="exampleInputEmail1">News Type</label>
                            <input type="number" class="form-control" id="nType"
                                aria-describedby="emailHelp" placeholder="News Type">
                            
                        </div> --}}
                        
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">News Type</label>
                            

                                <select name="nType" id="nType" class="form-control">
                                    <option value="" disabled selected>Select News Type</option>
                                    <option value="Advertisement">Advertisement</option>
                                    <option value="Other">Other</option>
                                </select>
                            
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
                            </div>
                        </div>
                    </div>

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
                            let nType = $('#nType').val();
                            let forData = {
                                page_no: page_no,
                                column_no: column_no,
                                nType: nType
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
                                window.history.back();
                                // window.location.reload();
                            });



                        }
                    </script>


                    <div class="col">
                        <span class="hidden" class="sharethis-inline-share-buttons"></span>
                        <h2 class="title-details font-weight-bold">{{ $centreNews->title }}</h2>
                        <div class="row">
                            <div class="col">
                                <h6 class="pb-1" style="color: #999999;">

                                    @php
                                        use App\Helper\Bengali;

                                        $date = $centreNews->created_at;
                                        $formattedDate = date('h:i A - d F Y', strtotime($date));
                                        $time = Bengali::bn_date_time($formattedDate);

                                    @endphp

                                    <span class="publishdate" style="color: black;"> প্রকাশ:

                                        @php
                                            echo $time;
                                        @endphp

                                    </span>

                                </h6>
                                <div class="details">
                                    <img src="{{ asset($centreNews->image) }}" class="card-img-top rounded-0"
                                        title="news title" alt="">
                                </div>
                                <style>
                                    .publishdate {
                                        font-family: 'solaimanLipi', sans-serif;
                                        font-optical-sizing: auto;
                                        font-weight: bold;
                                        font-style: normal;
                                    }

                                    .title-details {
                                        font-family: 'solaimanLipi', sans-serif;
                                        font-optical-sizing: auto;
                                        font-weight: bold;
                                        font-style: normal;
                                    }

                                    .details img {
                                        text-align: center;
                                        width: 500px;
                                        height: 500px;

                                    }
                                </style>
                            </div>
                        </div>
                        <div class="row">
                            <style type="text/css">
                                p {
                                    padding: 0px 20px 0px 0px;
                                }
                            </style>
                            <div class="col-12 og:description detailsStyle">
                                <!-- News Body -->
                                <h5 class="py-3 text-muted">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                            viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34">
                                            </path>
                                            <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                        </svg>
                                        {{ $centreNews->user->name }}

                                </h5>

                                {!! $centreNews->body !!}

                            </div>
                        </div>
                    </div>



    </section>


    </div>
    </div>
    </div>


    <!-- Load TinyMCE -->
    <script src="{{ asset('assets') }}/js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setupTinyMCE();
        });
    </script>
    <!-- /TinyMCE -->
    </section>






    {{-- <script>
        async function saveDraft() {
                // Get the values of the elements
                let title = document.getElementById('title').value;
                let comment = document.getElementById('comment').value;
                let body = document.getElementById('body').value;
                let chiefReporterId = document.getElementById('chief_reporter_id').value;
                let imageInput = document.getElementById('image');
                let reporter = document.getElementById('reporter').value;

                // Create a FormData object to store the values
                let formData = new FormData();

                // Append the values to the FormData object
                formData.append('title', title);
                formData.append('comment', comment);
                formData.append('body', body);
                formData.append('chief_reporter_id', chiefReporterId);
                // Check if an image file is selected
                formData.append('image', imageInput);
                formData.append('reporter', reporter);

                // Now formData contains all the values, including the image file if selected
                // You can now use this FormData object to send the data via AJAX or submit it with a form

                // Send the data using axios
 

                // Hide loader after request completes

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                showLoader();
                let res = await axios.post("/news/store", formData, config)
                hideLoader();
                if(res.status===200){
                    document.getElementById("save-form").reset();

                }
            }
    </script> --}}
















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
