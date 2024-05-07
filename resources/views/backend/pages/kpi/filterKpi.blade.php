@extends('layouts.app')

@section('content')

<section class="mt-md-4 pt-md-3">
    <div class="container-fluid">
        <div class="row" style="color: #444;">
            <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">

                <div class="row py-2 ">
                    <div class="col">
                        <div class="row shadow-sm text-muted">





                            <!-- Button Add Category modal -->
                            <div class="ml-auto mr-3">

                                <a href="{{ route('kpi.EmployeeKPI') }}" class="btn btn-sm btn-primary px-3 rounded-0">
                                   KPI</a>


                                <a href="{{ route('reading.myRawNews') }}" class="btn btn-sm btn-info px-3 rounded-0">
                                    All Raw And Complete News</a>


                                <a href="{{ route('sub_editor') }}" class="btn btn-sm btn-secondary px-3 rounded-0">
                                    Back</a>
                            </div>
                        </div>
                    </div>
                </div>



                <!--Input Group Start-->

                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col md-12">
                                        <div class="logo text-center">
                                            <img src="https://www.kalbela.com/templates/web-view/images/logo.png" alt="kalbela Responsive logo" width="20%">
                                        </div>
                                        
                            
                            
                            
                                        <div class="kpiBody py-3">
                                            <table class="table table-sm table-striped table-bordered" style="width:100%">
                                                <td class="text-center">KPI By: {{ auth()->user()->name }}</td>
                                              
                                            </table>
                                            <table class="table table-sm table-striped table-bordered" style="width:100%">
                                                <td> Date: {{ date('j F Y', strtotime($formDate)) }} To {{ date('j F Y', strtotime($toDate)) }}</td>
                                               
                                            </table>
                                           
                                        </div>
                            
                                        <div class="kpiDetails">
                                            <table class="table table-sm table-striped table-bordered" style="width:100%">
                                                <thead style="font-size:12px">
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Type</th>
                            
                                                        <th>Name</th>
                                                        <th>Word</th>
                                                        <th>Add</th>
                                                        
                                                        <th>Start</th>
                                                        <th>Finish</th>
                                                    </tr>
                                                </thead>
                            
                                                <tbody class="" style="font-size:12px">
                                                   @foreach ($employeeKPI as $kpi )
                                                       
                                                   
                                                   <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $kpi->nType }}</td>
                                                    <td>{{ Str::limit($kpi->title, 20) }}</td>
                                                    <td>
                                                        @if ($kpi->nType == 'Other')
                                                            {{ $kpi->body }}
                                                        @else
                                                            {{ '' }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($kpi->nType == 'Advertisement')
                                                            {{ $kpi->body }}
                                                        @else
                                                            {{ '' }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $kpi->start_time }}</td>
                                                    <td>{{ $kpi->end_time }}</td>
                                                </tr> 
                                                        @endforeach
                            
                                                      
                                                </tbody>
                                           
                            
                                            </table>
                            
                                            <table class="table table-sm table-striped table-bordered" style="width:100%">
                                                <thead style="font-size:12px">
                                                    <tr>
                                                        <th>Total News</th>
                                                        <th>Total Advertisement</th>
                                                        <th>Total Other</th>
                                                    </tr>
                                                </thead>
                            
                                                <tbody class="" style="font-size:12px">
                                                  <td>  {{ $employeeKPI->count() }}</td>
                                                  <td>{{ $sumOfAdd }}</td> 
                                                   <td>{{ $sumOfOther }}</td>
                            
                                                      
                                                </tbody>
                                              
                            
                                            </table>
                                        </div>
                                  
                                          
                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    @import url('https://fonts.maateen.me/solaiman-lipi/font.css');

    h1,h2,h3,h4,h5,li,a,p,span{
        font-family: 'SolaimanLipi', Arial, sans-serif !important;

    }
</style>



<style>
    .kpiHead{
        text-align: center;
        font-weight: 600;
    }
</style>


 {{-- <script>
    // Prompt the user to print when the page loads
    window.onload = function() {
      
            window.print();
       
    };

</script>  --}}
<script>
    $('.datepicker').datepicker();
</script>


@endsection