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
                                    <h5> <strong> Todays All News(From Center) </strong> </h5>
                                </div>
                                <div class="col text-uppercase ">
                                    <a href="{{ route('reading.myNews') }}" class="btn btn-sm btn-info text-white"> <strong>
                                            My Complete News</strong> </a>
                                </div>
                                <div class="col text-uppercase ">
                                    <button onclick="window.location.reload();" class="btn btn-sm btn-info text-white">
                                        <strong>Reload Page</strong> </button>
                                </div>
                                <!-- Button Add Category modal -->
                                {{-- <div class="ml-auto mr-3">
                                    <a href="{{ route('news.create') }}" class="btn btn-sm btn-info px-3 rounded-0">Add
                                        News</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>



                    <!--Input Group Start-->
                    <form action="">

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>Show
                                    <select name="datatable_length" class="form-control input-sm">
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    entries</label>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="filter-search-box text-right">
                                    <label>Search:<input type="search" class="form-control input-sm"
                                            placeholder=""></label>
                                </div>
                            </div>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <table class="table table-sm table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">SL</th>
                                        <th>Image</th>

                                        <th>Title</th>
                                        <th>Reporter</th>
                                        <th>Column No</th>
                                        <th>Page No</th>
                                        <th>status</th>
                                        <th>Updating</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="" style="font-size:0.9em;">

                                </tbody>


                            </table>
                            {{ $newses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        body {
            background-color: transparent
        }

        .text-green {
            color: green;
            font-weight: bold;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20px
        }

        .pulse {
            width: 20px;
            height: 20px;
            background-color: rgb(255, 174, 0);
            border-radius: 100%;
            position: relative;
            animation: animate 3s linear infinite
        }

        .pulse i {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 10px;
            color: #fff;
            height: 100%;
            cursor: pointer
        }

        @keyframes animate {
            0% {
                box-shadow: 0 0 0 0 rgb(255, 52, 1), 0 0 0 0 rgb(209, 42, 1)
            }

            40% {
                box-shadow: 0 0 0 50px rgb(255, 109, 74, 0), 0 0 0 0 rgb(255, 238, 0)
            }

            80% {
                box-shadow: 0 0 0 50px rgb(255, 109, 74, 0), 0 0 0 30px rgb(255, 109, 74, 0)
            }

            100% {
                box-shadow: 0 0 0 0 rgb(255, 109, 74, 0), 0 0 0 30px rgb(255, 109, 74, 0)
            }
        }
    </style>

    <script>

getData();
        setInterval(getData, 500);
        async function getData() {
            //show loader
            showLoader
            axios.get('/getData')
                .then(function(response) {
                    // Assuming the response.data contains the array of news objects
                    var newses = response.data;


                    // Assuming you have a variable to reference the table body
                    var tableBody = document.querySelector('tbody');

                    // Clear existing content in the table body
                    tableBody.innerHTML = '';

                    // Loop through the newses array and generate HTML for each news item
                    newses.forEach(function(news, index) {
                        var html = `
        <tr>
          <td>${index + 1}</td>
          <td><img src="${news.image}" width="50px" alt=""></td>
          <td>${news.title}</td>
          <td>${news.user.name}</td>
          <td>${news.column_no}</td>
          <td>${news.page_no}</td>
          <td class="text-center text-danger">${getStatusText(news.status)}</td>
          <td>
            <div class="d-flex justify-content-between align-items-center">
              ${news.track !== null ? `
                        <div>
                          <div class="wrapper">
                            <div class="pulse"><i class="fa fa-plus"></i></div>
                          </div>
                        </div>
                        <span class="text-green">${news.track.name}</span>` : ''}
            </div>
          </td>
          <td>
            <div class="btn-group btn-block" role="group" aria-label="Basic example">
              <a href="/reading/show/${news.id}" type="button" class="btn btn-sm btn-primary">View</a>
              <button ${news.track !== null ? 'disabled' : ''} onclick="editNews(${news.id})" type="button"
                class="btn btn-sm btn-edit ${news.track !== null ? 'btn-secondary' : 'btn-info'}">Edit</button>
              <button onclick="deleteData(${news.id})" type="button" class="btn btn-sm btn-danger">Delete</button>
            </div>
          </td>
        </tr>
      `;

                        // Append the generated HTML to the table body
                        tableBody.innerHTML += html;
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching data:', error);
                });

            // Function to get status text based on status code
            function getStatusText(status) {
                switch (status) {
                    case 1:
                        return 'Approved by Centre';
                    case 2:
                        return 'Approved by Reading';
                    case 3:
                        return 'Approved by Graphics';
                    default:
                        return 'Pending';
                }
            }
            // Call getData() initially
         

            // Call getData() every second using setInterval
           
        }
   



















        function editNews(newsId) {
            // Disable all edit buttons
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.disabled = true;
            });

            // Show updating message
            // You can customize this message as needed
            //alert('Another user is updating this news item. Please wait.');

            // Make GET request using Axios
            axios.get('tracker/' + newsId)
                .then(function(response) {
                    // Handle success response
                    console.log('Data fetched successfully:', response.data);
                    // Redirect to the edit page
                    window.location.href = "{{ url('reading') }}/edit/" + newsId;
                })
                .catch(function(error) {
                    // Handle error
                    console.error('Error fetching data:', error);
                });
        }
    </script>

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
                    axios.delete('/news/delete/' + id)
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
