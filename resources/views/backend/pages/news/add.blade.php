@extends('layouts.app')

@section('content')
    <section class="mt-md-4 pt-md-3">
        <div class="container-fluid">
            <div class="row"  style="color: #444; background-color: #e7e2e2">
                <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">

                    <div class="row py-2 ">
                        <div class="col">
                            <div class="row shadow-sm text-muted">
                                <div class="col text-uppercase ">
                                    <h5> <strong> Add Employe </strong> </h5>
                                </div>
                                <!-- Button Add Category modal -->
                                <div class="ml-auto mr-3">
                                    <a href="{{ route('employee') }}" class="btn btn-sm btn-info px-3 rounded-0">Employe
                                        List</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Input Group Start-->
                    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="row pt-md-4">
                            <div class="col-md-9 px-sm-5">
                
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" name="title" value="{{ old('title') }}" id="colFormLabel" class="form-control form-control-lg form_check_color_right" placeholder="নিউজ হেডলাইন" required >
                                    </div>
                                    @if ($errors->has('title'))
                                    <div class="error mt-2 text-danger">{{ $errors->first('title') }}</div>
                                @endif
                                </div>
                
                                <div class="form-group row ">
                                    <div class="col-sm-12">
                                        <input type="text" name="comment" value="{{ old('comment') }}" class="form-control form-control-sm border-0" id="colFormLabel" placeholder="মন্তব্য (Not Required)">
                                    </div>
                                    
                                </div>
                
                                <div class="form-group row">
                                    <div class="col-sm-12" >
                                        <div class="form-group ">
                                            <label for="exampleFormControlTextarea3"> 
                                                <strong> News Body : </strong>
                                            </label>
                                            <textarea name="body"  class="tinymce form-control rounded-0" style="font-size:30px;" rows="10">
                                                {{ old('body') }}
                                            </textarea>
                                            <style type="text/css">
                                                #mce_0_toolbar2 {display: none;}
                                                #mce_0_toolbar3 {display: none;}
                                            </style>
                
                                        </div>
                                        @if ($errors->has('body'))
                                    <div class="error mt-2 text-danger">{{ $errors->first('body') }}</div>
                                @endif
                                    </div>
                                </div>
                
                            </div>
                                
                            <div class="col-md-3">
                
                                <div class="form-group row">
                                    <div class="input-group">
                                        <label class="col-sm-5 col-form-label col-form-label-sm">
                                            <strong> Forword To:</strong>
                                        </label>
                                        <div class="col-sm-7">
                                            <select id="select"  name="chief_reporter_id" class="custom-select custom-select-sm">
                                                <option value="0">Chef Reporter</option>
                                                <option value="1">News Editor</option>
                                                <option value="2">Featured-1</option>
                                                <option value="3">Featured-2</option>
                                                <option value="4">Featured-3</option>
                                                <option value="5">Featured-4</option>
                                                <option value="6">Featured-5</option>
                                                <option value="7">Featured-6</option>
                                                <option value="8">Featured-7</option>
                                                <option value="9">Featured-8</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                
                                <div class="form-group row">
                
                                    <div class="input-group">
                                        <div class="col text-center pt-5">
                                            <div><h4 class="border-bottom pb-2"><strong>Add News Photo</strong></h4></div>
                                            <img id="thumbnil" src="{{ asset('assets') }}/img/uploadimg.png" width="200" class="img-fluid my-2" >
                                            <div class="form-group text-center">
                                                <input type="file" name="image" accept="image/*" onchange="showMyImage(this)" class="form-control-file btn btn-light py-4 border-bottom" id="productimage">
                                                <label class="btn btn-block" for="productimage">Choose Image</label>
                                            </div>
                                            @if ($errors->has('image'))
                                    <div class="error mt-2 text-danger">{{ $errors->first('image') }}</div>
                                @endif
                                        </div>
                                        
                                    </div>
                                        <script> /*show image script */
                                            function showMyImage(fileInput) {
                                                var files = fileInput.files;
                                                for (var i = 0; i < files.length; i++) {
                                                    var file = files[i];
                                                    var imageType = /image.*/;
                                                    if (!file.type.match(imageType)) { 
                                                        continue;
                                                    }
                                                        var img=document.getElementById("thumbnil");
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
                
                                <div class="form-group row">
                                    <div class="input-group">
                                        <label class="col-sm-5 col-form-label col-form-label-sm">
                                            <strong> Reporter Name : </strong>
                                        </label>
                                        <div class="col-sm-7">
                                            @auth
                                            <input type="text" name="reporter" class="form-control form-control-sm" id="colFormLabel" readonly value="{{ Auth::user()->name }}">
                                        @else
                                            <input type="text" name="reporter" class="form-control form-control-sm" id="colFormLabel" readonly value="user">
                                        @endauth
                                                        
                                        </div>
                                    </div>
                                </div>
                
                                <div class="row mb-5">
                                    <div class="col text-right">
                                        <input type="submit" class="btn btn-block btn-success py-4 shadow">
                                    </div>
                                </div>
                            </div>
                            
                        </div>	
                    </form>
    

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
