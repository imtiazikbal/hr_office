@extends('layouts.app')

@section('content')
    <section class="mt-md-4 pt-md-3">
        <div class="container-fluid">
            <div class="row" style="color: #444;">
                <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">
                    <form action="{{ route('sub_editor.update', $news->id) }}" method="POST" id="save-form"
                        enctype="multipart/form-data">
                        <div class="row py-2 ">
                            <div class="col">
                                <div class="row shadow-sm text-muted">

                                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                        <a href="{{ route('assignNews') }}" type="button" onclick="submitToDraft()"
                                            class="btn btn-primary shadow">Back</a>


                                        <button type="button" onclick="submitToCentral()"class="btn btn-warning shadow">
                                            Update
                                          
                                          </button>
                                          <button type="button" onclick="CompleteTask()"class="btn btn-primary shadow">
                                              Complete 
                                          
                                          </button>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!--Input Group Start-->


                        <div class="row pt-md-4">
                            <div class="col-md-12">
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

                                            {{-- <style type="text/css">
                                                #mce_0_toolbar2 {
                                                    display: none;
                                                }

                                                #mce_0_toolbar3 {
                                                    display: none;
                                                }
                                            </style> --}}

                                        </div>
                                        @if ($errors->has('body'))
                                            <div class="error mt-2 text-danger">{{ $errors->first('body') }}</div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="row py-5">
                                  <hr>
                                    <div class="col-md-6">
                                        <div class="form-group row">

                                            <div class="input-group">
                                                <div class="col text-center pt-5">
                                                    <div>
                                                        <h4 class="border-bottom pb-2"><strong>Add News Photo</strong></h4>
                                                    </div>
                                                    <img id="thumbnil" src="{{ asset($news->image) }}" width="200"
                                                        class="img-fluid my-2">
                                                    <div class="form-group text-center">
                                                        <input type="file" name="image" id="image" accept="image/*"
                                                            onchange="showMyImage(this)"
                                                            class="form-control-file btn  py-4 border-bottom"
                                                            id="productimage">
                                                        <label class="btn " for="productimage">Choose Image</label>
                                                    </div>
                                                
                                                </div>

                                            </div>


                                            <script>
                                                /*show image script */
                                                function showMyImage(fileInput) {
                                                    var files = fileInput.files;
                                                    for (var i = 0; i < files.length; i++) {
                                                        var file = files[i];
                                                        var imageType = /image.*/;
                                                        if (!file.type.match(imageType)) {
                                                            continue;
                                                        }
                                                        var img = document.getElementById("thumbnil");
                                                        img.file = file;
                                                        var reader = new FileReader();
                                                        reader.onload = (function(aImg) {
                                                            return function(e) {
                                                                aImg.src = e.target.result;
                                                            };
                                                        })(img);
                                                        reader.readAsDataURL(file);
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                {{-- <label for="exampleFormControlTextarea3">
                                                                       <strong>Page No:</strong>
                                                                   </label> --}}
                                                <div class="col-sm-12">
                                                    <input type="text" readonly name="page_no" id="title"
                                                        value="{{ $news->page_no }}" id="colFormLabel"
                                                        class="form-control bg-gray form-control-sm form_check_color_right"
                                                        placeholder="Page No" required>
                                                </div>
                                                @if ($errors->has('title'))
                                                    <div class="error mt-2 text-danger">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                {{-- <label for="formControlSelect1">
                                                                       <strong>Colmun No: </strong>
                                                                   </label> --}}
                                                <div class="col-sm-12">
                                                    <input type="text" readonly name="column_no" id="title"
                                                        value="{{ $news->column_no }}" id="colFormLabel"
                                                        class="form-control form-control-sm form_check_color_right"
                                                        placeholder="Column No" required>
                                                </div>
                                                @if ($errors->has('title'))
                                                    <div class="error mt-2 text-danger">{{ $errors->first('title') }}</div>
                                                @endif
                                            </div>
                                        </div>
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
                                       
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="input-group">
                                                    <label class="col-sm-5 col-form-label col-form-label-sm">
                                                        <strong> Reporter Name : </strong>
                                                    </label>
                                                    <div class="col-sm-7">
        
                                                        <input type="text" name="reporter" id="reporter"
                                                            class="form-control form-control-sm" id="colFormLabel" readonly
                                                            value="{{ $news->user->name }}">
        
        
                                                    </div>
                                                </div>
                                            </div>
        
        
                                            <input type="hidden" name="news_id" value="{{ $news->news_id }}">
                                        </div>
                                      
                                        
                                    </div>


                                </div>





                               


                                <div class="row py-2 ">
                                    <div class="col">
                                        <div class="row shadow-sm text-muted">

                                            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                                <a href="{{ route('assignNews') }}" type="button" onclick="submitToDraft()"
                                                class="btn btn-primary shadow">Back</a>

                                                <button type="button" onclick="submitToCentral()"class="btn btn-warning shadow">
                                                    Update
                                                  
                                                  </button>
                                                  <button type="button" onclick="CompleteTask()"class="btn btn-primary shadow">
                                                      Complete 
                                                  
                                                  </button>
                                            </div>


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
                document.getElementById('save-form').action = "{{ route('assignNews.update', $news->id) }}";
                // Submit the form
                document.getElementById('save-form').submit();
            }
        </script>

        <script>
        
            function CompleteTask() {
                // Set the form action to the central route
                document.getElementById('save-form').action = "{{ route('assignNews.complete', $news->id) }}";
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
