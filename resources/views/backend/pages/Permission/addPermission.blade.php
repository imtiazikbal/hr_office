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
                                    <h5> <strong>Role Name:{{ $role->name }} </strong> </h5>
                                </div>
                                <!-- Button Add Category modal -->
                                <div class="ml-auto mr-3">
                                    <a href="{{ route('permission') }}" class="btn btn-sm btn-info px-3 rounded-0">Permission
                                        List</a>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!--Input Group Start-->
                    <form class="py-4" method="POST" action="{{ route('rolePermission.store',$role->id) }}" enctype="multipart/form-data"
                        class="was-validated" id="save-form">
                        <div class="form-row">
                            <div class="col-sm-5" style="order-right: 1px solid black;">

                                <div class="row d-flex justify-content-between">
                                    <div>
                                        <label for="EmployeLabel"
                                        class="col-sm-4 col-form-label col-form-label-sm"><strong>Permissions Name:
                                        </strong>
                                    
                                    </label>
                                    </div>
                                    <div class="col-sm-8 py-3">

                                        @foreach ($permissions as $permission) 
                                   
                                                <input type="checkbox" class="text-white"
                                                name="permission[]"
                                 {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}  

                                                value="{{ $permission->id }}">

                                                    
                                                    {{ $permission->name }}
                                                
                                        @endforeach

                                    </div>


                                    @if ($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                            </div>

                           

                            
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Save
                                Permission</button>
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
