<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">





</head>

<body>


<style>
    @import url('https://fonts.maateen.me/solaiman-lipi/font.css');

    h1,h2,h3,h4,h5,li,a,p,span{
        font-family: 'SolaimanLipi', Arial, sans-serif !important;

    }
</style>


<div class="container-fluid">
    <div class="row">
        <div class="col md-12">
            <div class="logo text-center">
                <img src="https://www.kalbela.com/templates/web-view/images/logo.png" alt="kalbela Responsive logo" width="20%">
            </div>
            



            <div class="kpiBody py-3">
                <table class="table table-sm table-striped table-bordered" style="width:100%">
                    <td class="text-center">KPI By: {{ auth()->user()->name }}</td>
                    <td class="text-center">Date: {{ $date }}</td>
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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
