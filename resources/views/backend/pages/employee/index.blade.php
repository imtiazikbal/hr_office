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
                                <h4> <strong > Employee List</strong>  </h4>
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
                                <th>Role</th>
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
                                <td> @foreach ($employee->user->roles as $role )
                                   <span class="badge badge-primary"> {{ $role->name }}</span>
                                @endforeach 
                                
                                </td>
                                <td>{{ $employee->department->name }}</td>
                                <td>{{ $employee->position->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($employee->date_of_joining)->format('j F Y') }}</td>
                                
                                
                                <td>
                                    
                                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                        <a href="{{ route('employee.show', $employee->user->id) }}" type="button" class="btn btn-sm  btn-primary">View</a>
                                        <a href="{{ route('employee.edit', $employee->id) }}" type="button" class="btn btn-sm btn-info">Edit</a>
                                        <button onclick="deleteData({{ $employee->id }})" type="button"
                                            class="btn btn-sm btn-danger">Delete</button>                                    </div>
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
 async function deleteData(id) {

Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
}).then((result) => {
    if (result.isConfirmed) {
        axios.delete('/employee/delete/' + id)
            .then(function(response) {
                window.location.reload();
            })
        Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
        });
    }
});


}
    
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

