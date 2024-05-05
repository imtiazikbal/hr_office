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
                                    <h5> Employee ID: <span id="emp_id"> </>
                                    </h5>
                                </div>

                                <div class="float-right pr-4">
                                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary px-4">Back</a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row p-sm-5" style=background: #fff;>
                        <style type="text/css">
                            .bgselected {
                                background: linear-gradient(90deg, rgba(255, 255, 255, 1) 40%, rgba(238, 238, 238, 1) 100%);
                            }
                        </style>
                        {{-- <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="mb-3">
                        <div class="text-center px-5 px-sm-0 mb-3">
                            <img class="img-thumbnail" src="{{ asset($profile->image) }}" width="100%">
                            <div class="text-secondery py-1">
                                <h5 class="">
                                    <strong>{{ $profile->name }}</strong>
                                </h5>
                               
                            </div>
                            <a class="btn btn-info btn-block my-2" href="#">Message
                            </a>	
                        </div>
                    </div>
                </div> <!--End of col 3-->

                <div class="col-xl-9 col-lg-9 col-md-9">

                    <div class="row">
                        <div class="col-12">
                            <style>
                                #styleprofile dt, dd { padding: 5px; padding-left: 5px;}
                                #styleprofile dt { padding-left: 15px;}
                            </style>

                            <dl id="styleprofile" class="row p-sm-2 p-1">

                                <dt class="col-3 ">Profession:</dt>
                                <dd class="col-9 shadow-sm"> 
                               {{   $profile->position->name  }}
                               </dd>

                                <dt class="col-3 ">Mobile :</dt>
                                <dd class="col-9 shadow-sm">Phone</dd>

                                <dt class="col-sm-3">Email :</dt>
                                <dd class="col-sm-9 shadow-sm">{{ $profile->email }}</dd>

                                <dt class="col-sm-3">Present Town :</dt>
                                <dd class="col-sm-9 shadow-sm">PresentTown</dd>

                                <dt class="col-sm-3">Description:</dt>
                                <dd class="col-sm-9 shadow-sm text-justify">Description</dd>

                                <dt class="col-3">Link Social:</dt>
                                <dd class="col-9">
                                    <a href="" class="btn btn-sm btn-outline-primary" target="_blank">Google</a>
                                    <a href="" class="btn btn-sm btn-outline-primary" target="_blank">LinkedIn</a>
                                    <a href="https://www.facebook.com/itmunnabd" class="btn btn-sm btn-outline-primary" target="_blank">Facebook</a>
                                    <a href="" class="btn btn-sm btn-outline-primary" target="_blank">Twitter</a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div> --}}

                        <div class="row">
                            <div class="col-md-4 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                  <form>
                                    <img id="thumbnil" src="{{ asset('assets') }}/img/uploadimg.png" width="170"
                                    class="img-fluid m-2">
                                <div class="form-group text-center">
                                    <input type="file" name="image" id="image" value="{{ old('image') }}"
                                        accept="image/*" onchange="showMyImage(this)"
                                        class="form-control form-control-sm-file btn btn-light py-4 border-bottom"
                                        id="productimage">

                                </div>
                                <button type="button" id="updateProfileButton" onclick="profilePhotoUpdate()" class="btn btn-primary btn-block">Update Profile Photo</button>
                                  </form>
                                    <span id="Profilename" class="font-weight-bold">Edogaru</span><span id="Profileemail"
                                        class="text-black-50">edogaru@mail.com.my</span><span>
                                    </span>
                                </div>

                            </div>

                            <script>
                                async function profilePhotoUpdate() {
                                    let forData = new FormData();
                                    forData.append('image', document.getElementById('image').files[0]);
                                    console.log(document.getElementById('image').files[0]);
                                    showLoader();
                                    let response = await axios.post('/profilePhotoUpdate', forData);
                                    hideLoader();
                                    if (response.status === 200) {
                                        profilePhoto();
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Profile Photo Updated',
                                            showConfirmButton: false,
                                            timer: 1500
                                         
                                        })
                                        
                                    }
                                    
                                }
                            </script>
                            <script>
                                profilePhoto();
                                async function profilePhoto() {
                                    axios.get('/profilePhoto').then(function(response) {
                                        let img = document.getElementById('thumbnil');
                                        console.log(response.data);
                                        img.src = response.data;

                                    })
                                }
                            </script>
                            <div class="col-md-8">
                                <div class="p-3 ">
                                   
                                        <div class="row mt-2">
                                            <div class="col-md-12"><label class="labels">Name</label>

                                                <input type="text" class="form-control" name="name" id="Username">
                                            </div>

                                            <input type="hidden" name="id" id="id">
                                        </div>
                                        <div class="row">

                                            <div class="col-md-12 mt-3"><label class="labels">Mobile Number</label>
                                                <input type="text" name="phone" id="Userphone" class="form-control"
                                                    placeholder="Enter phone number">
                                            </div>

                                            <div class="col-md-12 mt-3"><label class="labels">Address Line</label>
                                                <input type="text" id="Useraddress" name="address" class="form-control"
                                                    placeholder="Enter your address">
                                            </div>


                                            <div class="col-md-12 mt-3"><label class="labels">Email ID</label>
                                                <input type="text" id="Useremail" name="email" readonly
                                                    class="form-control" placeholder="" value="">
                                            </div>

                                            <div class="col-md-12 mt-3"><label class="labels">Facebook</label>
                                                <input type="text" name="social_fb" id="social_fb" class="form-control"
                                                    placeholder="Facebook Link Here">
                                            </div>

                                            <div class="col-md-12 mt-3"><label class="labels">Twitter</label>
                                                <input type="text" name="social_twitter" id="social_twitter"
                                                    class="form-control" placeholder="Twitter Link Here">
                                            </div>

                                            <div class="col-md-12 mt-3"><label class="labels">LInkedin</label>
                                                <input type="text" name="social_linkedin" id="social_linkedin"
                                                    class="form-control" placeholder="Linkedin Link Here">
                                            </div>
                                        </div>


                                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button"
                                                onclick="updateProfile()" type="button">Save Profile</button></div>
                                  
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
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
        <script>
            getProfileData();
            async function getProfileData() {

                let response = await axios.get('/get/profile/details');
                let profile = response.data;








                document.getElementById('Username').value = profile.name;
                document.getElementById('Profilename').textContent = profile.name;
                document.getElementById('Useremail').value = profile.email;
                document.getElementById('Profileemail').textContent = profile.email;
                document.getElementById('id').value = profile.id;


                document.getElementById('Userphone').value = profile.employee_details[0].phone;
                document.getElementById('Useraddress').value = profile.employee_details[0].address;
                document.getElementById('social_fb').value = profile.employee_details[0].social_fb;
                document.getElementById('social_twitter').value = profile.employee_details[0].social_twitter;
                document.getElementById('social_linkedin').value = profile.employee_details[0].social_linkedin;

                //image 


                document.getElementById('img-thumbnail').src = profile.employee.image;





                document.getElementById('emp_id').textContent = profile.emp_id;



            }

            async function updateProfile() {


                let id = document.getElementById('id').value;

                let name = document.getElementById('Username').value;
                let phone = document.getElementById('Userphone').value;
                let address = document.getElementById('Useraddress').value;
                let social_fb = document.getElementById('social_fb').value;
                let social_twitter = document.getElementById('social_twitter').value;
                let social_linkedin = document.getElementById('social_linkedin').value;


                // let formData = new FormData();
                // let imageFile = document.getElementById('thumbnil').files[
                // 0]; // Assuming you have an input element with id 'imageInput' for uploading the image


                let formData = {
                    name: name,

                    address: address,
                    phone: phone,
                    social_fb: social_fb,
                    social_twitter: social_twitter,
                    social_linkedin: social_linkedin
                }
                // Append form fields to FormData object
                // formData.append('id', id);
                // formData.append('name', name);
                // formData.append('phone', phone);
                // formData.append('address', address);
                // formData.append('social_fb', social_fb);
                // formData.append('social_twitter', social_twitter);
                // formData.append('social_linkedin', social_linkedin);

                // // Append image file to FormData object
                // if (imageFile) {
                //     formData.append('image', imageFile);
                // }
                showLoader();
                let response = await axios.post('/employee/details/' + id, formData)

                if (response.status === 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Profile updated successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

                hideLoader();

            }
        </script>


        <style>
            .img {
                width: 100%;
                border-radius: 100%
            }

            .form-control:focus {
                box-shadow: none;
                border-color: #BA68C8
            }

            .profile-button {
                background: rgb(99, 39, 120);
                box-shadow: none;
                border: none
            }

            .profile-button:hover {
                background: #682773
            }

            .profile-button:focus {
                background: #682773;
                box-shadow: none
            }

            .profile-button:active {
                background: #682773;
                box-shadow: none
            }

            .back:hover {
                color: #682773;
                cursor: pointer
            }

            .labels {
                font-size: 15px
            }

            .add-experience:hover {
                background: #BA68C8;
                color: #fff;
                cursor: pointer;
                border: solid 1px #BA68C8
            }
        </style>
    </section>
    <script>
        fetchData();

        function fetchData() {
            axios.get('/welcome')
                .then(function(response) {
                    // Handle success
                    console.log(response.data);
                    5
                })
                .catch(function(error) {
                    // Handle error
                    console.error('Error fetching data:', error);
                });
        }
    </script>


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
