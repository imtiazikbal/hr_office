@extends('layouts.app')

@section('content')
    <section class="mt-md-4 pt-md-3 ">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">

                    <div class="row py-2">
                        <div class="col">
                            <div class="row ">
                                <div class="col text-uppercase">
                                    <h4> <strong> Department List</strong> </h4>
                                </div>
                                <!-- Button Add Brand modal -->
                                <div class="ml-auto mr-3">
                                    <button data-toggle="modal" data-target="#exampleModal"
                                        class="btn btn-sm btn-info px-3 rounded-0">Add Department</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->


                    <!--Add Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

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
                    </div>
                            {{-- edit modal --}}

                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
    
                                        <form method="POST" class="was-validated" id="edit-form">
                                            <div class="row p-sm-4">
                                                <div class="col-sm-12" style="order-right: 1px solid black; margin-top: 50px;">
    
                                                    <div class="form-group row">
                                                        <label for="EmployeLabel"
                                                            class="col-sm-4 col-form-label "><strong>Department Name
                                                            </strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="empName" id="empName"
                                                                class="form-control form_check_color_right"
                                                                placeholder="Department Name here..." required>
                                                        </div>
                                                        <div>
                                                        <input class="d-none"  id="updateID">

                                                        </div>
                                                    </div>
    
                                                    <div class="form-group row">
                                                        <label for="EmployeLabel"
                                                            class="col-sm-4 col-form-label "><strong>Department Type
                                                            </strong></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="empType"
                                                               class="form-control form_check_color_right"
                                                                placeholder="Department type here..." required>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="UpdateData()">Save
                                                    changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--Catagary list Table Start -->
                    <div class="row ">
                        <div class="col">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Department Name</th>
                                        <th>Department Type</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($departments as $department) 
                                    <tr>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->type }}</td>
                                    </tr>
                                        
                                    @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        getData();
        async function getData() {
        axios.get('department/show')
            .then(function(response) {
                // Clear previous table data
                $('#myTable tbody').empty();

                // Iterate over the response data
                response.data.forEach(function(item) {
                    // Create a new row for each item
                    var newRow = $('<tr>');
                    // Populate the row with data
                    newRow.append('<td>' + item.name + '</td>');
                    newRow.append('<td>' + item.type + '</td>');
                    // Add columns for edit and delete buttons
                    // newRow.append('<td><button class="btn btn-primary edit-btn" data-id="' + item.id + '">Edit</button></td>');
                    newRow.append('<td><button class="btn btn-primary edit-btn" data-id="' + item.id + '" onclick="editItem(' + item.id + ')">Edit</button></td>');

                    newRow.append('<td><button class="btn btn-danger delete-btn" data-id="' + item.id + '">Delete</button></td>');
                    // Append the row to the table
                    $('#myTable tbody').append(newRow);
                });

                // Initialize DataTable
                $('#myTable').DataTable();
            })
            .catch(function(error) {
                console.error('Error fetching data:', error);
            });
    }

    // Call the getData function when the page loads
    $(document).ready(function() {
        getData();
    });

    // Add event listener for edit buttons
    // $(document).on('click', '.edit-btn', function() {
    //     let id = $(this).data('id');
        
    //     // Redirect to the edit page with the item ID
    //     window.location.href = '/department/edit/' + id; // Replace '/edit/:id' with your edit page URL
    // });

    function editItem(id) {
  
    $('#editModal').modal('show');
  

    axios.get('/department/edit/' + id)
        .then(function(response) {
            let itemData = response.data;
         
           document.getElementById('updateID').value=id;

            $('#editModal #empName').val(itemData.name);
            $('#editModal #empType').val(itemData.type);

        })
        .catch(function(error) {
            console.error('Error fetching item data:', error);
        });
}

// here update function 
async function UpdateData() {
    let department = document.getElementById('updateID').value; 

    let name = document.getElementById('empName').value;
    let type = document.getElementById('empType').value;
   
    let forData = {
        name: name,
        type: type
    };
    
    if (name.length === 0 ) {
        // Show error message if fields are empty
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please fill all the fields!',
        });
    } else {
        try {
            // Show loader while making the request
            showLoader();
            
            // Send POST request to update the department
            let response = await axios.post('department/update/' + department, forData);

            // Hide loader after request completes
            hideLoader();

            // Check if the update was successful
            if (response.status === 200) {
                // Reset form fields
                document.getElementById("edit-form").reset();

                // Hide the edit modal
                $('#editModal').modal('hide');

                // Show success message
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Department updated successfully',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Refresh table data
                getData();
            }
        } catch (error) {
            // Handle error
            console.log(error);

            // Hide loader if an error occurs
            hideLoader();
        }
    }
}

    // Add event listener for delete buttons
    $(document).on('click', '.delete-btn', function() {
    var id = $(this).data('id');

    // Display SweetAlert confirmation dialog
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
            // If user confirms deletion, perform the Axios request to delete the item
            axios.delete('/department/delete/' + id)
                .then(function(response) {
                    // Show success message using SweetAlert
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });

                    // Refresh the table after deletion
                    getData();
                })
                .catch(function(error) {
                    // If there's an error, display an error message using SweetAlert
                    Swal.fire({
                        title: "Error!",
                        text: "An error occurred while deleting the item.",
                        icon: "error"
                    });
                });
        }
    });
});


async function saveData() {
    let type = document.getElementById('type').value;
    let name = document.getElementById('name').value;
    let forData = {
        type: type,
        name: name
    };

    if (name.length === 0 || type.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please fill all the fields!',
        });
    } else {
        try {
            showLoader();
            let response = await axios.post('department/store', forData);
            hideLoader();

            if (response.status === 200) {
                document.getElementById("save-form").reset();
                await getData();
                $('#exampleModal').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Department Added Successfully',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        } catch (error) {
            // Handle error
            console.error('Error fetching data:', error);
        }
    }
}

    </script>
@endsection
