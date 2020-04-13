    <?php

    class OrderHisotry
    {




    public static function orderhistory_html($orderhistory)
    {?> 

    <!doctype html>

    <html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">

    <title>Order History</title>
    <style>

    h2
    {
    margin-top: 50px;
    margin-left: 500px;

    }

    </style>  

    </head>
    <body>

    <!-- Order History table-->
    <!-- center the body here-->

    <div class="container">
    <div class="table-wrapper">
    <div class="table-title">
    <div class="row">
    <div class="col-sm-4">
    <h2 > <b>Order Details</b></h2>
    </div>
    </div>
    </div>
    <div class="table-filter">
    <div class="row">
    <div class="col-sm-3">

    </div>
    <div class="col-sm-9">


    <span class="filter-icon"><i class="fa fa-filter"></i></span>
    </div>
    </div>
    </div>
    <table class="table table-striped table-hover">
    <thead>
    <tr>
    <th>#</th>
    <th>id</th>
    <th>accountid</th>
    <th>Product Name</th>						
    <th>Address</th>						
    <th>Status</th>
    <th>Date Delivered</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td>1</td>
    <td>Pedro Rendon</td>
    <td>London</td>
    <td>Jun 15, 2017</td>                        
    <td><span class="status text-success">•</span> Delivered</td>
    <td>$254</td>
    <td>12-02-2020</td>
    <td><span class="material-icons">
    delete_outline
    </span></td>
    </tr>


    </tbody>
    </table>
    <input type="submit" class="btn btn-success" value="Go back">
    <input type="submit" class="btn btn-danger" value="Clear All History">
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
    </html>

    <?php }

    }

    ?>