<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-success">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="#">
      <img src="LOGO-2-400x87.png" alt="Logo" width="240" height="50" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white me-5 active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white me-5" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-white me-5 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<style>
/* Main navbar items hover effect */
.navbar-nav .nav-item .nav-link {
  position: relative;
  color: black;
  text-decoration: none;
  transition: color 0.3s ease;
}

.navbar-nav .nav-item .nav-link:hover {
  color: #28a745; /* Green color */
}

.navbar-nav .nav-item .nav-link::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -3px; /* Adjust for spacing below text */
  width: 0;
  height: 5px; /* Thickness of the line */
  background-color: white; /* Green color */
  transition: width 0.3s ease;
}

.navbar-nav .nav-item .nav-link:hover::after {
  width: 100%;
}
/* Adjust dropdown menu position */
.navbar .dropdown-menu {
  position: absolute;
  top: 100%; /* Aligns directly below the navbar */
  left: 0;   /* Aligns the dropdown to the left edge */
  width: 100%; /* Makes the dropdown menu span the width of the navbar */
  border: none; /* Removes all borders */
  border-radius: 0; /* Removes rounding at edges */
  margin-top: 0; /* Removes spacing between navbar and dropdown */
  background-color: #28a745; /* Keeps the green background consistent */
}

/* Remove default dropdown item styles */
.navbar .dropdown-menu .dropdown-item {
  color: white; /* White text for items */
  padding: 10px 20px; /* Adjust padding for better spacing */
  transition: background-color 0.3s ease; /* Smooth hover effect */
}

/* Add hover effect for dropdown items */
.navbar .dropdown-menu .dropdown-item:hover {
  background-color: #218838; /* Slightly darker green on hover */
  color: white; /* Keeps text color consistent */
}

/* Optional: Center dropdown text */
.navbar .dropdown-menu .dropdown-item {
  text-align: center;
}
.navbar .dropdown-menu {
  position: absolute;
  top: 100%; /* Directly below the parent menu item */
  left: 0;
  background-color: white; /* Background color matching the image */
  border: 1px solid #ccc; /* Light border for separation */
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
  padding: 0;
  border-radius: 4px; /* Slightly rounded corners */
  width: auto; /* Adjust width if necessary */
}

/* Dropdown item styles */
.navbar .dropdown-menu .dropdown-item {
  color: #333; /* Default text color */
  font-size: 14px; /* Adjust font size */
  padding: 8px 16px; /* Adjust padding */
  text-align: left; /* Align text to the left */
  transition: all 0.3s ease; /* Smooth hover animation */
}

/* Hover effect for dropdown items */
.navbar .dropdown-menu .dropdown-item:hover {
  background-color: #28a745; /* Green highlight on hover */
  color: white; /* White text when hovered */
}

/* Add active line below the main menu item on hover */
.navbar-nav .nav-item:hover > .nav-link {
  color: #28a745; /* Active menu color */
  border-bottom: 2px solid #28a745; /* Green underline */
}

/* Center dropdown text and spacing */
.navbar .dropdown-menu .dropdown-item {
  display: block;
  white-space: nowrap; /* Prevent wrapping */
  text-align: center;
}



</style>

<nav class="navbar navbar-expand-lg navbar-light bg-success mt-4 rounded" style="width: 65%; margin-left: auto; margin-right: auto;" >
  <div class="container-fluid">
    <ul class="navbar-nav d-flex justify-content-between" style="width: 100%; border-radius: 10px;">
      <li class="nav-item d-flex justify-content-center align-items-center hover-effect" style="width: 33%; height=100%">
        <a class="nav-link text-white d-flex justify-content-center hover-effect" href="#">Item 1</a>
      </li>
      <li class="nav-item d-flex justify-content-center align-items-center hover-effect" style="width: 33%;">
        <a class="nav-link text-white d-flex justify-content-center hover-effect" href="#">Item 2</a>
      </li>
      <li class="nav-item d-flex justify-content-center align-items-center hover-effect" style="width: 33%;">
        <a class="nav-link text-white d-flex justify-content-center hover-effect" href="#">Item 3</a>
      </li>
    </ul>
  </div>
</nav>


<div class="container-fluid p-0 mt-5">
  <!-- Footer -->
  <footer class="text-center text-lg-start text-white bg-success">
    <!-- Grid container -->
    <div class="p-4">
      <!-- Section: Links -->
      <section>
        <!-- Grid row -->
        <div class="row">
          <!-- Grid column: Company Info -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
          <a class="navbar-brand" href="#">
      <img src="LOGO-2-400x87.png" alt="Logo" width="240" height="60" class="d-inline-block align-text-top">
    </a>
          </div>

          
          <!-- Grid column: Contact -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase fw-bold">EMSI CENTRE</h6>
            <p><i class="fas fa-home me-2"></i> 05 lot bouizgaren, Rte de Safi, Marrakech 40000</p>
            <p><i class="fas fa-envelope me-2"></i> info@gmail.com</p>
            <p><i class="fas fa-phone me-2"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print me-2"></i> + 01 234 567 89</p>
          </div>
          <!-- Grid column: Contact -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase fw-bold">EMSI GUELIZ</h6>
            <p><i class="fas fa-home me-2"></i> JXJP+FRX, Marrakech 40000</p>
            <p><i class="fas fa-envelope me-2"></i> info@gmail.com</p>
            <p><i class="fas fa-phone me-2"></i> + 01 234 567 88</p>
            <p><i class="fas fa-print me-2"></i> + 01 234 567 89</p>
          </div>

          <!-- Grid column: Follow Us -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase fw-bold">ABONNEZ-VOUS</h6>
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-twitter"></i></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-google"></i></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-instagram"></i></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-linkedin-in"></i></a>
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button"><i class="fab fa-github"></i></a>
          </div>
        </div>
        <!-- Grid row -->
      </section>
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3 bg-dark">
      © 2024 Copyright:
      <a class="text-white text-decoration-none" href="#">emsi.ma</a>
    </div>
    <!-- Copyright -->
  </footer>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
