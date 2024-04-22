<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-klassy-cafe.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
</head>
<body>


	<div class="title text-center mb-1">
        <h4 class="pb-2"><b>Login</b></h4>
        <h5>KasirKu</h5>
    </div>
	<div class="container" style="justify-content-around display: d-flex;">
		<div class="row justify-content-center">
			<div class="col-lg-5">
				<div class="app-card app-card-settings card py-4 px-4 shadow rounded shadow-lg p-4 mt-3">
					<form action="{{ route('auth') }}" method="post">
						@csrf
						<div class="text-center mt-3">
							
						<span class="info-text">Input Email dan Password!</span>
						
						</div>
						<div class="position-relative mt-3 form-input">
							<label for="email">Email</label>
							<input class="form-control" type="text" name="email" placeholder="name@example.com" id="email" autofocus required>
						</div>
						<div class="position-relative mt-3 form-input">
							<label for="password">Password</label>
							<input class="form-control" type="password" name="password" placeholder="password" id="password" required>
						</div>
						
						<div class="mt-5 d-flex justify-content-between align-items-center">
							<button type="submit" class="btn btn-warning">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

<script src="assets/js/jquery-2.1.0.min.js"></script>

<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/accordions.js"></script>
<script src="assets/js/datepicker.js"></script>
<script src="assets/js/scrollreveal.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/imgfix.min.js"></script> 
<script src="assets/js/slick.js"></script> 
<script src="assets/js/lightbox.js"></script> 
<script src="assets/js/isotope.js"></script> 

<!-- Global Init -->
<script src="assets/js/custom.js"></script>
</body>
</html>