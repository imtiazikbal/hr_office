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
                    <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data"
                        class="was-validated" id="save-form">
                        <div class="form-row">
                            <div class="col-sm-5" style="order-right: 1px solid black;">

                                <div class="form-group row">
                                    <label for="EmployeLabel"
                                        class="col-sm-4 col-form-label col-form-label-sm"><strong>Employe Name :
                                        </strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" value="{{ old('name') }}" id="name"
                                            class="form-control form-control-sm form_check_color_right" id="EmployeLabel"
                                            placeholder="Employe Name here..." required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="EmailAddress"
                                        class="col-sm-4 col-form-label col-form-label-sm"><strong>Email
                                            Address : </strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" id="email" value="{{ old('email') }}"
                                            class="form-control form-control-sm form_check_color_right" id="EmailAddress"
                                            placeholder="Email Address here..." required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="Username" class="col-sm-4 col-form-label col-form-label-sm"><strong>Username
                                            :
                                        </strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                                            class="form-control form-control-sm form_check_color_right"
                                            placeholder="Username Name here..." required>
                                    </div>
                                    @if ($errors->has('username'))
                                        <div class="error">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="Password" class="col-sm-4 col-form-label col-form-label-sm"><strong>Password
                                            :
                                        </strong></label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" id="password" value="{{ old('password') }}"
                                            class="form-control form-control-sm form_check_color_right"
                                            placeholder="Password here..." required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="ConfirmPassword"
                                        class="col-sm-4 col-form-label col-form-label-sm "><strong>Confirm Password :
                                        </strong></label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            value="{{ old('password_confirmation') }}"
                                            class="form-control form-control-sm form_check_color_right" id="ConfirmPassword"
                                            placeholder="Confirm Password here..." required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <label for="ConfirmPassword"
                                        class="col-sm-4 col-form-label col-form-label-sm "><strong>Role:
                                        </strong></label>

                                    <div class="col-sm-8">
                                        @if (Auth()->user()->role == 0 || Auth()->user()->role == 1)
                                            <select class="custom-select form_check_color_right" id="role"
                                                name="role" value="{{ old('role') }}" required>
                                                <option value="">Select Role</option>
                                                <option value="0">SuperAdmin</option>
                                                <option value="2">Hr.Admin</option>
                                                <option value="5">Reading</option>
                                                <option value="6">Reporting</option>
                                                <option value="3">Cheif Editor</option>
                                                <option value="4">Sub Editor</option>
                                                <option value="7">graphics</option>
                                            </select>
                                        @else
                                            <select class="custom-select form_check_color_right" id="role"
                                                name="role" value="{{ old('role') }}">



                                                {{-- <option value="2">Hr.Admin</option> --}}
                                                <option value="5">Reading</option>
                                                <option value="6">Reporting</option>
                                                <option value="3">Cheif Editor</option>
                                                <option value="4">Sub Editor</option>
                                                <option value="7">graphics</option>
                                            </select>
                                        @endif
                                    </div>
                                    {{-- default('user')->comment('0 = SuperAdmin, 1 = Admin, 2 = hr, 3 = chief editor, 4 = sub editor, 5 = reading, 6 = reporting, 7 = graphics, user'); --}}
                                    @if ($errors->has('role'))
                                        <div class="error">{{ $errors->first('role') }}</div>
                                    @endif
                                </div>


                            </div>

                            <div class="col-sm-4">

                                <div class="form-group row">
                                    <label for="EmployeID"
                                        class="col-sm-4 col-form-label col-form-label-sm text-md-right"><strong>Employe ID
                                            :
                                        </strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="emp_id" id="emp_id" value="{{ old('emp_id') }}"
                                            class="form-control form-control-sm form_check_color_right"
                                            placeholder="Office ID here..." required>
                                    </div>
                                    @if ($errors->has('emp_id'))
                                        <div class="error">{{ $errors->first('emp_id') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <div class="input-group">
                                        <label class="col-sm-4 col-form-label col-form-label-sm text-md-right">
                                            <strong> Department : </strong>
                                        </label>
                                        <div class="col-sm-8">
                                            <select id="department_id" name="department_id"
                                                value="{{ old('department_id') }}"
                                                class="custom-select form_check_color_right" required>
                                                <option value="">Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('department_id'))
                                            <div class="error">{{ $errors->first('department_id') }}</div>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="Designation"
                                        class="col-sm-4 col-form-label col-form-label-sm text-md-right"><strong>Designation
                                            :
                                        </strong></label>
                                    <div class="col-sm-8">
                                        <select id="position_id" name="position_id" value="{{ old('position_id') }}"
                                            class="custom-select form_check_color_right" required>
                                            <option value="">Select Designation</option>
                                            @foreach ($positions as $position)
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('position_id'))
                                        <div class="error">{{ $errors->first('position_id') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label for="colFormLabel"
                                        class="col-sm-4 col-form-label col-form-label-sm text-md-right"><strong>
                                            Joining Date
                                            : </strong></label>
                                    <div class="col-sm-8">
                                        <input type="date" name="date_of_joining"
                                            value="{{ old('date_of_joining') }}" max="3000-12-31" min="1000-01-01"
                                            class="form-control form-control-sm border-0" id="date_of_joining"
                                            placeholder="Agent Expair Date" required>
                                    </div>
                                    @if ($errors->has('date_of_joining'))
                                        <div class="error">{{ $errors->first('date_of_joining') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <div class="input-group">
                                        <label class="col-sm-4 col-form-label col-form-label-sm text-md-right">
                                            <strong> Employe Status : </strong>
                                        </label>
                                        <div class="col-sm-8">
                                            <select id="status" name="status" value="{{ old('status') }}"
                                                class="custom-select border-0">
                                                <option class="text-success" value="1">Active
                                                </option>
                                                <option class="text-danger" value="0">Deactive
                                                </option>
                                            </select>
                                        </div>
                                        @if ($errors->has('status'))
                                            <div class="error">{{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group row">
                                    <div class="input-group">
                                        <div class="col text-center">
                                            <div>
                                                <h4 class="border-bottom pb-2"><strong>Profile
                                                        Photo</strong></h4>
                                            </div>
                                            <img id="thumbnil" src="{{ asset('assets') }}/img/uploadimg.png"
                                                width="170" class="img-fluid m-2">
                                            <div class="form-group text-center">
                                                <input type="file" name="image" id="image"
                                                    value="{{ old('image') }}" accept="image/*"
                                                    onchange="showMyImage(this)"
                                                    class="form-control form-control-sm-file btn btn-light py-4 border-bottom"
                                                    id="productimage">
                                                <label class="btn btn-block" for="productimage">Choose
                                                    Image</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('image'))
                                            <div class="error">{{ $errors->first('image') }}</div>
                                        @endif
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
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Save
                                Employee</button>
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
