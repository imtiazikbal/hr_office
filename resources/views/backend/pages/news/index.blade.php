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
                                <h5> <strong > Todays All News  </strong>  </h5>
                            </div>
                            <!-- Button Add Category modal -->
                            <div class="ml-auto mr-3">
                                <a href="{{ route('news.create') }}" class="btn btn-sm btn-info px-3 rounded-0">Add News</a>
                            </div>
                        </div>
                    </div>
                </div>
               
                

<!--Input Group Start-->
<div class="row ">

    <div class="col">
 
        
       
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Reporter</th>    
                    <th>Forword</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($newses as $news )
                   
              
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset($news->image) }}" alt="" width="50px" height="50px"></td>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->reporter }}</td>
                    <td>
                        @foreach ($chiefReporterNames as $name)
    {{ $name }}<br>
@endforeach

                    </td>
                 
                    <td>
                        <a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ route('news.delete', $news->id) }}" class="btn btn-danger btn-sm">Delete</a>

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

