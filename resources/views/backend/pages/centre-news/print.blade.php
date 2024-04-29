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
                <img src="https://www.kalbela.com/templates/web-view/images/logo.png" alt="kalbela Responsive logo" width="50%">
            </div>
            <hr>
            <hr>
      
              
            <div class="newDeatils">
                <h2 class="font-weight-bold">{{ $centreNews->title }}</h2>
                <h6 class="pb-1" style="color: #999999;">
                    <style>
                        .font-weight-bold{
                            font-weight: 600;
                        }
                    </style>
                    @php
                        use App\Helper\Bengali;

                        $date = $centreNews->created_at;
                        $formattedDate = date('h:i A - d F Y', strtotime($date));
                        $time = Bengali::bn_date_time($formattedDate);

                    @endphp

                    <span class="publishdate" style="color: black;"> প্রকাশ:

                        @php
                            echo $time;
                        @endphp

                    </span>
                    <hr>

                </h6>
                <p>রিপোর্টার:<span>{{ $centreNews->user->name }}</span></p>
                <p class="text-justify">{!! $centreNews->body !!}</p>
            </div>
        </div>
    </div>
</div>



<script>
    // Prompt the user to print when the page loads
    window.onload = function() {
      
            window.print();
       
    };

</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
