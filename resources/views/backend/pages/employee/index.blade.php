@extends('layouts.app')

@section('content')
<section class="mt-md-4 pt-md-3">
    <div class="container-fluid">
        <div class="row" style="color: #444;">
            <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">
                
                <div class="row py-2">
                    <div class="col">
                        <div class="row ">
                            <div class="col text-uppercase">
                                <h4> <strong > Brand List</strong>  </h4>
                            </div>
                            <!-- Button Add Brand modal -->
                            <div class="ml-auto mr-3">
                                <a href="{{ route('employee.create') }}" class="btn btn-sm btn-info px-3 rounded-0">Add Eployee</a>
                            </div>
                        </div>
                    </div>
                </div>
               
                

<!--Input Group Start-->

                

                 <!--Catagary list Table Start -->
                {{-- <div class="row ">

                    <div class="col">
                 
                        
                       
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Possition</th>
                                    <th>Join Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee) 
                                    
                                @endforeach
                                <tr>
                                    <td>{{ $employee->id ++ }}</td>
                                    <td>
                                        <img src="{{ asset($employee->image) }}" width="50px" alt="">
                                    </td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->department->name }}</td>
                                <td>{{ $employee->position->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($employee->date_of_joining)->format('j F Y') }}</td>
                                <td>
                                    <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('employee.delete', $employee->id) }}" class="btn btn-primary btn-sm">delete</a>
                                </td>

                                </tr>
                               
                                
                            </tbody>
                        </table>
                      
                        
                        
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col"> 
                        <table id="example" class="table table-sm table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Possition</th>
                                <th>Join Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody class="" style="font-size:0.9em;">
                            @foreach ($employees as $employee) 
                             
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($employee->image) }}" width="50px" alt="">
                                    </td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->department->name }}</td>
                                <td>{{ $employee->position->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($employee->date_of_joining)->format('j F Y') }}</td>
                                
                                
                                <td>
                                    
                                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                        <a href="{{ route('employee.show', $employee->id) }}" type="button" class="btn btn-sm  btn-primary">View</a>
                                        <a href="{{ route('employee.edit', $employee->id) }}" type="button" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{ route('employee.delete', $employee->id) }}" onclick="return confirm('Are you suer to Delete!')"  type="button" class="btn btn-sm btn-danger">Delete</a>
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
</section>

<script>
    fetchData();
    function fetchData() {
        axios.get('/welcome')
            .then(function (response) {
                // Handle success
               console.log(response.data);5
            })
            .catch(function (error) {
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

