<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets') }}/img/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets') }}/img/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets') }}/img/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('assets') }}/img/favicon_io/site.webmanifest">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <!-- animate.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/animate.css">
    <!-- Coustom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/styleothers.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/proggress.css">
    <!-- DataTable CSS -->
    <link href="css/dataTable/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link href="css/dataTable/css/jquery.dataTables.mi.css" rel="stylesheet">

    <!-- Fontawsome -->
    <script src="https://kit.fontawesome.com/ef949075f5.js" crossorigin="anonymous"></script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('assets') }}/js/jquery.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="{{ asset('assets') }}/js/bootstrap.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

    {{-- summer note --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> --}}
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

    <script src="https://cdn.tiny.cloud/1/vsnnrc7wucpxmp4qlyzttrzn2q4ug731s4qbjyohjr0likio/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        
        <title>@yield('title')</title> <!-- Display dynamic title --> <!-- Display dynamic title -->

    <style>
        @import url('https://fonts.maateen.me/solaiman-lipi/font.css');

        body {
            font-family: 'SolaimanLipi', Arial, sans-serif !important;
        }
    </style>
</head>

<body>

    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- End Navbar -->

    @yield('content')

    <!-- Footer Section 2 Start -->

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Common Scripts -->
    <script type="text/javascript" src="{{ asset('assets') }}/js/adminscript.js"></script>
    <script type="text/javascript" src="{{ asset('assets') }}/js/confiq.js"></script>

    <!-- jQuery UI -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <!-- DataTable Initialization -->
    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable');
        });
    </script>

    <!-- jQuery initialization -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $('#summernote').summernote({
            tabsize: 3,
            height: 700
        });
    </script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown fullscreen',
        toolbar: 'undo redo | fullscreen | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat ',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        content_css: 'https://fonts.maateen.me/solaiman-lipi/font.css', 
        content_style: "body{ font-family: 'SolaimanLipi', sans-serif;  font-size: 20px;   }",
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            "See docs to implement AI Assistant")),
        setup: function(editor) {
            editor.on("change keyup", function() {
                var content = editor.getContent();
                var totalWords = content.trim().split(/\s+/).filter(Boolean).length;
                document.getElementById('totalWords').textContent = totalWords;
            });

            editor.on('SelectionChange', function() {
                var selectedText = editor.selection.getContent({format: 'text'});
                var selectedWords = selectedText.trim().split(/\s+/).filter(Boolean).length;
                document.getElementById('selectedWords').textContent = selectedWords;
            });
        }
    });
</script>


  <style>
    .tox-statusbar__branding {
  display: none;
}
  </style>
</body>

</html>
