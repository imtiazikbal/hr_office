<section class="mt-md-4 pt-md-3 ">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-xl-10 col-lg-9 col-md-9 ml-auto">
                        
                <div class="row py-2">
                    <div class="col">
                        <div class="row ">
                            <div class="col text-uppercase">
                                <h4> <strong > Brand List</strong>  </h4>
                            </div>
                            <!-- Button Add Brand modal -->
                            <div class="ml-auto mr-3">
                                <a href="brandadd.php" class="btn btn-sm btn-info px-3 rounded-0">Add Brand</a>
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
                                    <th>Column 1</th>
                                    <th>Column 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Row 1 Data 1</td>
                                    <td>Row 1 Data 2</td>
                                </tr>
                                <tr>
                                    <td>Row 2 Data 1</td>
                                    <td>Row 2 Data 2</td>
                                </tr>
                            </tbody>
                        </table>
                      
                        
                        
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