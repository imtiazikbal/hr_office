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
<form method="POST" class="was-validated" id="save-form">
    <div class="row p-sm-4">
        <div class="col-sm-12" style="order-right: 1px solid black; margin-top: 50px;">

            <div class="form-group row">
                <label for="EmployeLabel"
                    class="col-sm-4 col-form-label "><strong>Department Name
                    </strong></label>
                <div class="col-sm-8">
                    <input type="text" name="empName" id="name"
                        id="EmployeLabel" class="form-control form_check_color_right"
                        placeholder="Department Name here..." required>
                </div>
            </div>

            <div class="form-group row">
                <label for="EmployeLabel"
                    class="col-sm-4 col-form-label "><strong>Department Type
                    </strong></label>
                <div class="col-sm-8">
                    <input type="text" name="empName" id="type"
                        id="EmployeLabel" class="form-control form_check_color_right"
                        placeholder="Department type here..." required>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
            data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveData()">Save
            changes</button>
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

