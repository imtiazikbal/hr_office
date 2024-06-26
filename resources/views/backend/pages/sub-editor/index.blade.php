@extends('layouts.app')

@section('content')
    <section class="mt-md-4 pt-md-3">
        <div class="container-fluid">
            <div class="row" style="color: #444;">
                <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">

                    <div class="row py-2">
                        <div class="col">
                            <div class="row shadow-sm text-muted" style="background: #ffffff2f;">



                                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                                    <button onclick="window.location.reload()"
                                        class="btn btn-sm btn-warning">Reload</button>
                                    <a href="{{ route('reading.todayCompleteNews') }}"
                                        class="btn btn-sm btn-primary text-white"> <strong>
                                            Today Complete News</strong>
                                    </a>
                                    <a href="{{ route('kpi.EmployeeKPI') }}" class="btn btn-sm btn-info text-white">
                                        <strong>
                                            KPI</strong>
                                    </a>
                                    <a href="{{ route('reading.myNews') }}" class="btn btn-sm btn-success text-white">
                                        <strong>
                                            My Complete News</strong>
                                    </a>
                                    <a href="{{ route('assignNews') }}" class="btn btn-sm btn-warning text-black">
                                        My Task <span class="badge bg-primary text-white">{{ $count }}</span>
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>

                    <style>
                        .kpi {
                            background: #cedac7;
                        }
                    </style>



                    @role('reading-head')
                 
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center align-items-center kpi">
                            <h5 class="text-black mr-3 text-uppercase"> Search KPI</h5>

                            <form action="{{ route('kpi.EmployeeKPIByFromToDate') }}">
                                <div class="row d-flex justify-content-between align-items-center py-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="text-muted">Employee</label>
                                            <select name="user_id" class="form-control" id="">
                                                <option value="" selected disabled>Select Employee</option>
                                                @foreach ($employeeReading as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="text-muted">From Date</label>
                                            <input type="date" class="form-control" name="from">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="text-muted">To Date</label>
                                            <input type="date" class="form-control" name="to">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-secondary text-white">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endrole()
                    <div class="row">
                        <div class="col px-4">
                            <marquee direction="left" speed="normal" scrollamount="7" behavior="scroll"
                                onmouseover="this.stop();" onmouseout="this.start();">
                                <a href="https://digitalsolutions.ltd" class="px-5 text-decoration-none">
                                    <style>
                                        .scrlstyle {
                                            color: #222;
                                            font-size: 16px;
                                        }
                                    </style>
                                    <span class="scrlstyle">
                                        দয়া করে পেজটি রিলোড দিন ।
                                </a>
                            </marquee>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table table-sm table-striped table-bordered" style="width:100%">
                                <thead style="font-size:0.8em;">
                                    <tr>
                                        <th width="2%" class="text-center">SL</th>
                                      <th width="2%" class="text-center">Image</th> 
                                        <th width="7%"class="text-center">Date</th>
                                        <th width="20%" class="text-center">Title</th>

                                        <th width="8%" class="text-center"> Reporter</th>
                                        <th width="8%">News Type</th>

                                        <th width="5%" class="text-center">Status</th>
                                        <th width="10%" class="text-center">Updating</th>
                                        <th width="10%" class="text-center">Last Activity</th>

                                        @role('reading-head')
                                        <th width="15%" class="text-center">Assign</th>
                                        @endrole

                                        <th width="15%" class="text-center">Proofing</th>
                                        <th width="5%" class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="" style="font-size:0.8em;">
                                    @foreach ($newses as $news)
                                        <tr>
                                            <td height="10px">{{ $loop->index + 1 }}</td>
                                            <td><img src="{{ $news['image'] }}" width="50px" alt=""></td> 
                                            <td>{{ $news['created_at']->format('j F Y') }}</td>
                                            <td>{{ $news['title'] }}</td>
                                            <td>{{ $news['reporter']['name'] }}</td>
                                            <td>{{ $news['nType'] }}</td>

                                            <td
                                            class="text-center {{ $news['status'] === 5 ? 'btn-success' : ($news['status'] === 6 ? 'btn-info' : ($news['status'] === 7 ? 'btn-warning' : ($news['status'] === 8 ? 'btn-secondary' : 'btn-danger'))) }}">

                                                {{ $news['status'] === 5 ? 'Complete' : ($news['status'] === 6 ? 'Assigned' : ($news['status'] === 7 ? 'First Proof' : ($news['status'] === 8 ? 'Recheck' : 'Unknown'))) }}

                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if ($news['track'] !== null)
                                                        <div>
                                                            <div class="wrapper">
                                                                <div class="pulse"><i class="fa fa-plus"></i></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-green">{{ $news['track']['name'] }}</span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="text-center">
                                                <div class="overflow-auto p-3 bg-body-tertiary"
                                                    style="max-width: 260px; max-height: 40px;">

                                                    @foreach ($news->logss as $log)
                                                        Update By {{ $log->name }}
                                                        @if (!$loop->last)
                                                            , <!-- Add a comma if it's not the last log -->
                                                        @endif
                                                    @endforeach


                                                </div>

                                            </td>
                                            
                                            @role('reading-head')
                                            <td class="text-center">

                                                <div class="btn-group btn-block d-flex justify-content-center align-items-center"
                                                    role="group">
                                                    <form action="{{ route('assignNews.assign', $news['id']) }}"
                                                        class="d-flex justify-content-center align-items-center"
                                                        method="POST">


                                                        <select class="js-example-basic-multiple w-100 " name="names[]"
                                                            multiple="multiple">

                                                            @foreach ($employeeReading1 as $employee)
                                                                <option value="{{ $employee->id }}">{{ $employee->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary text-white ml-2">Assign
                                                        </button>

                                                    </form>
                                                </div>
                                            </td>
                                            @endrole()


                                            <td class="text-center">

                                                <div class="btn-group btn-block d-flex justify-content-center align-items-center"
                                                    role="group">
                                                    <form action="{{ route('reading.updateProofNews', $news['id']) }}"
                                                        class="d-flex justify-content-center align-items-center"
                                                        method="POST">


                                                        <select name="proof" class="form-control" id="">
                                                            <option value="" selected disabled></option>
                                                            <option value="7">First Proof</option>
                                                            <option value="8">ReCheck</option>
                                                        </select>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary text-white ml-2">Submit
                                                        </button>

                                                    </form>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="btn-group btn-block d-flex justify-content-center align-items-center"
                                                    role="group" aria-label="Basic example">

                                                    <a href="/reading/show/{{ $news['id'] }}" type="button"
                                                        class="btn btn-sm btn-primary">View</a>

                                                    <button {{ $news['track'] !== null ? 'disabled' : '' }}
                                                        onclick="editNews({{ $news['id'] }})" type="button"
                                                        class="btn btn-sm btn-edit {{ $news['track'] !== null ? 'btn-secondary' : 'btn-info' }}">Edit</button>

                                                        @role('reading-head')
                                                    <button onclick="deleteData({{ $news['id'] }})" type="button"
                                                        class="btn btn-sm btn-danger">Delete</button>
                                                    @endrole

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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
        .fntSize {
            font-size: 10px;
        }

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
    <style>
        /* Define custom CSS for table rows */
        tr {
            height: 5px;
            /* Adjust the height to your desired value */
        }

        /* Optionally, you can also define different styles for odd and even rows */
        tr:nth-child(even) {
            background-color: #fcab3294;
            /* Light gray background for even rows */
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
            /* White background for odd rows */
        }
    </style>


    {{-- <script>
    setTimeout(function() {
        window.location.reload();
    }, 5000); // 5000 milliseconds = 5 seconds
</script> --}}


    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>


    <script>
        function editNews(newsId) {
            // Disable all edit buttons


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
        $('.input-daterange input').each(function() {
            $(this).datepicker('clearDates');
        });
    </script>


    {{-- <script>
        getData();
        setInterval(getData, 5000);
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
          <td height="10px">${index + 1}</td>
          <td><img src="${news.image}" width="50px" alt=""></td>
          <td>${news.title}</td>
          <td>${news.reporter.name}</td>
          <td>${news.nType}</td>
     
          <td class="text-center ${news.status === 5 ? 'btn-primary' : 'btn-danger'}">${getStatusText(news.status)}</td>
          <td class="text-center">
            <div class="d-flex justify-content-center align-items-center">
              ${news.track !== null ? `
                                <div>
                                  <div class="wrapper">
                                    <div class="pulse"><i class="fa fa-plus"></i></div>
                                  </div>
                                </div>
                                <span class="text-green">${news.track.name}</span>` : ''}
            </div>
          </td>


        
                      
            
             </td>

             <td class="text-center"> ${news.logs !== null ? `
                                
                                <span class="text-green "> Edited By ${news.logs.name} and  Last Modified by  ${news.user !==null ? news.user.name : ''}</span>` : ''}</td>



                               


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
                    case 4:
                        return 'Pending';
                    case 5:
                        return 'Complete';

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
    </script> --}}

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
                    axios.delete('sub_editor/delete/' + id)
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
