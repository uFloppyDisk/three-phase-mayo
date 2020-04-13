<?php

class Checkout

{



public static function checkout_html()
{?>
<!doctype html>

<!-- This page is inspired by bootstrap check page: https://getbootstrap.com/docs/4.3/examples/checkout/-->>
<!-- Order Details container: https://www.tutorialrepublic.com/snippets/preview.php?topic=bootstrap&file=crud-data-table-for-database-with-modal-form-->>

<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Checkout</title>
</head>
<body>
<body class="float-center" class="bg-light">
<div class="container ">


<table class="table">
<h2 >Order Details</h2>
<thead class="thead-dark">
<tr>
<th scope="col">ID</th>
<th scope="col">AccountID</th>
<th scope="col">Products Name</th>
<th scope="col">Status</th>
<th scope="col">Quatity </th>
<th scope="col">Edit </th>
</tr>
</thead>
<tbody>
<tr>
<th scope="row">1</th>
<td>Mark123</td>
<td>Nike Shoes</td>
<td class="text-success">Delivered</td>
<td>1</td>
<td><a href="">X</a></td> 
<!-- <?php  echo '<TD><A HREF="'.$_SERVER["PHP_SELF"].'?action=delete&id='.$customer->getCustomerID().'">Edit</A></TD>';
echo '</TR>';?> -->
</tr>

</tbody>
</table>




<div class="py-5 text-center">
<img class="d-block mx-auto mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
<hr class="style5">      <h2 >Checkout</h2>
</div>

<div class="row ">

<div class="col-md-8 order-md-1 d-flex justify-content-between">
<h4 class="mb-3 ">Billing address</h4>
<form class="needs-validation" novalidate="">
<div class="row">
<div class="col-md-6 mb-3">
<label for="firstName">First name*</label>
<input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
<div class="invalid-feedback">
first name is required.
</div>
</div>
<div class="col-md-6 mb-3">
<label for="lastName">Last name</label>
<input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
<div class="invalid-feedback">
last name is required.
</div>
</div>
</div>

<div class="mb-3">
<label for="username">Username*</label>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">@</span>
</div>
<input type="text" class="form-control" id="username" placeholder="Username" required="">
<div class="invalid-feedback" style="width: 100%;">
username is required.
</div>
</div>
</div>

<div class="mb-3">
<label for="email">Email* <span class="text-muted"></span></label>
<input type="email" class="form-control" id="email" placeholder="you@example.com">
<div class="invalid-feedback">
Please enter a valid email address for shipping updates.
</div>
</div>

<div class="mb-3">
<label for="address">Address*</label>
<input type="text" class="form-control" id="address" placeholder="123 Robson St." required="">
<div class="invalid-feedback">
Please enter your shipping address.
</div>
</div>

<div class="mb-3">
<label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
<input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
</div>

<div class="row">
<div class="col-md-5 mb-3">
<label for="country">Country*</label>
<select class="custom-select d-block w-100" id="country" required="">
<option value="">Choose...</option>
<option>Canada</option>
<option>United States</option>
</select>
<div class="invalid-feedback">
Please select a valid country.
</div>
</div>
<div class="col-md-4 mb-3">
<label for="state">State*</label>
<select class="custom-select d-block w-100" id="state" required="">
<option value="">Choose...</option>
<option>Vancouver</option>
<option>Surrey</option>
<option>Toronto</option>
<option>Burnaby</option>
</select>
<div class="invalid-feedback">
Please provide a valid state.
</div>
</div>
<div class="col-md-3 mb-3">
<label for="zip">Zip*</label>
<input type="text" class="form-control" id="zip" placeholder="" required="">
<div class="invalid-feedback">
Zip code required.
</div>
</div>
</div>
<hr class="mb-4">
<!-- Order detaisl here-->

<hr class="mb-4">

<h4 class="mb-3">Payment*</h4>

<div class="d-block my-3">
<div class="custom-control custom-radio">
<input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
<label class="custom-control-label" for="credit">Credit card</label>
</div>
<div class="custom-control custom-radio">
<input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
<label class="custom-control-label" for="debit">Debit card</label>
</div>
<div class="custom-control custom-radio">
<input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
<label class="custom-control-label" for="paypal">PayPal</label>
</div>
</div>
<div class="row">
<div class="col-md-6 mb-3">
<label for="cc-name">Name on card*</label>
<input type="text" class="form-control" id="cc-name" placeholder="" required="">
<small class="text-muted">Full name as displayed on card</small>
<div class="invalid-feedback">
Name on card is required*
</div>
</div>
<div class="col-md-6 mb-3">
<label for="cc-number">Credit card number*</label>
<input type="text" class="form-control" id="cc-number" placeholder="" required="">
<small class="text-muted">Visa/Master</small>
<div class="invalid-feedback">
Credit card number is required
</div>
</div>
</div>
<div class="row">
<div class="col-md-3 mb-3">
<label for="cc-expiration">Expiration*</label>
<input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
<small class="text-muted">Card expire date</small>
<div class="invalid-feedback">
Expiration date required
</div>
</div>
<div class="col-md-3 mb-3">
<label for="cc-cvv">CVV*</label>
<input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
<small class="text-muted">eg. 301</small>
<div class="invalid-feedback">
Security code required
</div>
</div>
</div>
<hr class="mb-4">
<button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
</form>
</div>
</div>


</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script src="form-validation.js"></script>

</body>

<footer class="my-5 pt-5 text-muted text-center text-small">
<p class="mb-1">© 2020-3000 Three Phase Mayo</p>
<ul class="list-inline">
<li class="list-inline-item"><a href="#">Privacy</a></li>
<li class="list-inline-item"><a href="#">Terms</a></li>
<li class="list-inline-item"><a href="#">Support</a></li>
</ul>
</footer>
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