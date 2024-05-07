@extends('layouts.app')

@section('content')
    <section class="mt-md-4 pt-md-3">
        <div class="container-fluid">
            <div class="row" style="color: #444; background-color: #e7e2e2">
                <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">

                    {{-- <div class="row py-2 ">
                        <div class="col">
                            <div class="row shadow-sm text-muted">


                                <div class="ml-auto mr-3">
                                    <a href="{{ route('reading.myNews') }}" class="btn btn-sm btn-info px-3 rounded-0">My News                                     News</a>
                                </div>

                            </div>
                        </div>
                    </div> --}}

                    <!--Input Group Start-->

                    <form action="{{ route('sub_editor.update', $news->id) }}" method="POST" id="save-form"
                        enctype="multipart/form-data">
                        <div class="row pt-md-4">
                            <div class="col-md-12 px-sm-5">

                                {{-- <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" name="title" id="title" value="{{ $news->title }}"
                                            id="colFormLabel" class="form-control form-control-lg form_check_color_right"
                                            placeholder="নিউজ হেডলাইন" required>
                                    </div>
                                    @if ($errors->has('title'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                </div> --}}

                                <div class="form-group row ">                                
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            {{-- <label for="exampleFormControlTextarea3">
                                            <strong>Page No:</strong>
                                        </label> --}}
                                            <div class="col-sm-12">
                                                <input type="text" readonly name="nType" id="title"
                                                    value="{{ $news->nType }}" id="colFormLabel"
                                                    class="form-control bg-gray form-control-sm form_check_color_right"
                                                    placeholder="Page No" required>
                                            </div>
                                            @if ($errors->has('title'))
                                                <div class="error mt-2 text-danger">{{ $errors->first('title') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="form-group ">
                                            <label for="exampleFormControlTextarea3">
                                                <strong> News Body : </strong>
                                            </label>
                                            <textarea name="body" id="summernote" class="tinymce form-control rounded-0" style="font-size:30px;" rows="10">
                                               {!! $news->body !!}
                                            </textarea>
                                            <div>Selected Words: <span id="selectedWords">0</span></div>
                                            {{-- <textarea name="body" id="body" cols="30" rows="10"></textarea> --}}
                                            <style type="text/css">
                                                #mce_0_toolbar2 {
                                                    display: none;
                                                }

                                                #mce_0_toolbar3 {
                                                    display: none;
                                                }

                                                
                                            </style>

                                        </div>
                                        @if ($errors->has('body'))
                                            <div class="error mt-2 text-danger">{{ $errors->first('body') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col text-right">
                                       
                                           


                                   

                                        <button type="button" onclick="submitToCentral()"
                                            class="btn btn-block btn-primary shadow">Complete and Save</button>
                                    </div>
                                </div>
                            </div>
                            

                           

                        </div>
                    </form>


                </div>
            </div>
        </div>

        <script>
        
            function submitToCentral() {
                // Set the form action to the central route
                document.getElementById('save-form').action = "{{ route('reading.update', $news->id) }}";
                // Submit the form
                document.getElementById('save-form').submit();
            }
        </script>






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



    <script>
        // Disable back button
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function() {
            history.pushState(null, null, document.URL);
        });
    </script>


    <script>
        // Check if the browser is Chrome
        var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

        if (isChrome) {
            // Disable back button for Chrome
            history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function() {
                history.pushState(null, null, document.URL);
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
