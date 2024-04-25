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
                                <h5> <strong > Add Employe </strong>  </h5>
                            </div>
                            <!-- Button Add Category modal -->
                            <div class="ml-auto mr-3">
                                <a href="productlist.php" class="btn btn-sm btn-info px-3 rounded-0">Employe List</a>
                            </div>
                        </div>
                    </div>
                </div>
               
                

<!--Input Group Start-->
<form action="" method="POST" enctype="multipart/form-data" class="was-validated">
    <div class="row p-sm-4">
        <div class="col-sm-5" style="order-right: 1px solid black; margin-top: 50px;">

            <div class="form-group row">
                <label for="EmployeLabel" class="col-sm-4 col-form-label "><strong>Employe Name : </strong></label>
                <div class="col-sm-8">
                    <input type="text" name="empName" class="form-control form_check_color_right" id="EmployeLabel" placeholder="Employe Name here..." required>
                </div>
            </div>

            <div class="form-group row">
                <label for="EmailAddress" class="col-sm-4 col-form-label"><strong>Email Address : </strong></label>
                <div class="col-sm-8">
                    <input type="text" name="empEmail" class="form-control form_check_color_right" id="EmailAddress" placeholder="Email Address here..." required>
                </div>
            </div>

            <div class="form-group row">
                <label for="Username" class="col-sm-4 col-form-label"><strong>Username : </strong></label>
                <div class="col-sm-8">
                    <input type="text" name="empusrName" class="form-control form_check_color_right" id="Username" placeholder="Username Name here..." required>
                </div>
            </div>

            <div class="form-group row">
                <label for="Password" class="col-sm-4 col-form-label"><strong>Password : </strong></label>
                <div class="col-sm-8">
                    <input type="password" name="empPass" class="form-control form_check_color_right" id="Password" placeholder="Password here..." required>
                </div>
            </div>

            <div class="form-group row">
                <label for="ConfirmPassword" class="col-sm-4 col-form-label "><strong>Confirm Password : </strong></label>
                <div class="col-sm-8">
                    <input type="password" name="empCPass" class="form-control form_check_color_right" id="ConfirmPassword" placeholder="Confirm Password here..." required>
                </div>
            </div> 
            <div class="form-group row">
                <label for="ConfirmPassword" class="col-sm-4 col-form-label "><strong>Role: </strong></label>

                <div class="col-sm-8">
                    <select id="select" name="catId" class="custom-select form_check_color_right" required>
                        <option value="">Select Department</option>
                        <option value="1">Hr. Admin</option>
                        <option value="6">It</option>
                        <option value="3">Desk</option>
                        <option value="4">Reporting</option>
                        <option value="5">Reading</option>
                        <option value="2">Online</option>
                    </select>
                </div>
            </div>
           

        </div>

        <div class="col-sm-4" style="margin-top: 50px;">

            <div class="form-group row">
                <label for="EmployeID" class="col-sm-4 col-form-label text-md-right"><strong>Employe ID : </strong></label>
                <div class="col-sm-8">
                    <input type="text" name="empOfficeID" class="form-control form_check_color_right" id="EmployeID" placeholder="Office ID here..." required>
                </div>
            </div>

            <div class="form-group row">
                <div class="input-group">
                    <label class="col-sm-4 col-form-label text-md-right">
                        <strong> Department : </strong>
                    </label>
                    <div class="col-sm-8">
                        <select id="select" name="catId" class="custom-select form_check_color_right" required>
                            <option value="">Select Department</option>
                            <option value="1">Hr. Admin</option>
                            <option value="2">Desk</option>
                            <option value="3">Reporting</option>
                            <option value="4">Reading</option>
                            <option value="5">Online</option>
                        </select>
                    </div>
                </div>
            </div>



            <div class="form-group row">
                <label for="Designation" class="col-sm-4 col-form-label text-md-right"><strong>Designation : </strong></label>
                <div class="col-sm-8">
                    <input type="text" name="empDesignation" class="form-control form_check_color_right" id="Designation" placeholder="Your office Designation here..." required>
                </div>
            </div>

            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-4 col-form-label text-md-right"><strong> Joining Date : </strong></label>
                <div class="col-sm-8">
                    <input type="date" name="createDate" max="3000-12-31"  min="1000-01-01" class="form-control border-0" id="colFormLabel" placeholder="Agent Expair Date" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="input-group">
                    <label class="col-sm-4 col-form-label text-md-right">
                        <strong> Employe Status : </strong>
                    </label>
                    <div class="col-sm-8">
                        <select id="select" name="AgntStatus" class="custom-select border-0">
                            <option class="text-success" value="1">Active</option>
                            <option class="text-danger" value="0">Deactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group row">
                <div class="input-group">
                    <div class="col text-center">
                        <div><h4 class="border-bottom pb-2"><strong>Profile Photo</strong></h4></div>
                        <img id="thumbnil" src="{{ asset('assets') }}/img/uploadimg.png" width="170" class="img-fluid m-2" >
                        <div class="form-group text-center">
                            <input type="file" name="image" accept="image/*" onchange="showMyImage(this)" class="form-control-file btn btn-light py-4 border-bottom" id="productimage">
                            <label class="btn btn-block" for="productimage">Choose Image</label>
                        </div>
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
        </div>
    </div>
    
    <div class="row mb-4">
        <div class="col text-right">
            <input type="submit" name="submit" class="btn btn-lg btn-block btn-success py-3" value="Save">
        </div>
    </div>	
</form>


            </div>
        </div>
    </div>
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

