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
                                <h5> <strong > Profile Details </strong>  </h5>
                            </div>

                            <div class="float-right pr-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary px-4">Back</a>
                            </div>
                            
                        </div>
                    </div>
                </div>

             <div class="row p-sm-5" style="margin: 50px; background: #fff;"> 
                 <style type="text/css">
                     .bgselected {
                        background: linear-gradient(90deg, rgba(255,255,255,1) 40%, rgba(238,238,238,1) 100%);
                    }
                 </style>
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <div class="mb-3">
                        <div class="text-center px-5 px-sm-0 mb-3">
                            <img class="img-thumbnail" src="{{ asset($user['employee'][0]['image']) }}" width="100%">
                            <div class="text-secondery py-1">
                                <h5 class="">
                                    <strong>{{ $user->name }}</strong>
                                </h5>
                                <h6 class="">
                                    <em>{{ $user['employee'][0]['department']['name'] }}</em>
                                </h6>
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

                                <dt class="col-3 ">Designation:</dt>
                                <dd class="col-9 shadow-sm">{{  $user['employee'][0]['position']['name'] }}</dd>

                                <dt class="col-3 ">Mobile :</dt>
                                <dd class="col-9 shadow-sm">Phone</dd>

                                <dt class="col-sm-3">Email :</dt>
                                <dd class="col-sm-9 shadow-sm">{{ $user->email }}</dd>

                                <dt class="col-sm-3">Present Town :</dt>
                                <dd class="col-sm-9 shadow-sm">
                                    
                                        
                                      @if( $userDetails)
                                        {{ $userDetails->address }}
                                        @endif
                                    
                                    
                                
                                </dd>

                                {{-- <dt class="col-sm-3">Description:</dt>
                                <dd class="col-sm-9 shadow-sm text-justify">Description</dd> --}}

                                <dt class="col-3">Link Social:</dt>
                                <dd class="col-9">
                                    @if( $userDetails)
                                    <a href=" {{ $userDetails->social_fb }}" class="btn btn-sm btn-outline-primary" target="_blank">Facebook</a>
                                        @endif
                                        
                                        @if( $userDetails)
                                    <a href=" {{ $userDetails->social_linkedin }}" class="btn btn-sm btn-outline-primary" target="_blank">LinkedIn</a>
                                        @endif
                                        @if( $userDetails)
                                    <a href=" {{ $userDetails->social_twitter }}" class="btn btn-sm btn-outline-primary" target="_blank">Twitter</a>
                                        @endif
                                 
                                    {{-- <a href="" class="btn btn-sm btn-outline-primary" target="_blank">LinkedIn</a>
                                    <a href="" class="btn btn-sm btn-outline-primary" target="_blank">Twitter</a> --}}
                                </dd>
                            </dl>
                        </div>
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

