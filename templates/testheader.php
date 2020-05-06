<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design for Bootstrap</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap 4 core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- style.css -->
  <link rel="stylesheet" href="css/test.css">

</head>
<body>
<!-- main Container -->
<!-- <div class="wrapper"> -->

         <!-- navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #003D76;">
    <!-- UDE Logo hyperlink -->
    <a class="navbar-brand" href="#">
      <img src="screenshots/UDE-Logo1.png" width="150" height="70" class="d-inline-block align-top" alt="">
    </a>
    <!-- Exchange Logo hyperlink -->
    <a class="navbar-brand" href="#">
      <img src="screenshots/worldwide.png" width="30" height="30" class="d-inline-block align-center" alt="">
      Südostasien
    </a>
    <!-- Menu hamburger icon at mobile size -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collapsible navbar at mobile size -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <!-- Menu on the left -->
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
        </li>
        <!-- Dropdown menu Information-->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-alt"></i> Information
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <h6 class="dropdown-header">Application</h6>
            <a class="dropdown-item" href="#">Before apply</a>
            <a class="dropdown-item" href="#">During application</a>
            <a class="dropdown-item" href="#">Successful application</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Exchange</h6>
            <a class="dropdown-item" href="#">Before departure</a>
            <a class="dropdown-item" href="#">Upon Arrival</a>
            <a class="dropdown-item" href="#">During Exchange</a>
            <a class="dropdown-item" href="#">After Exchange</a>
          </div>
        </li>
          <!-- Application Information-->
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-alt"></i> Application Process
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <h6 class="dropdown-header">Application</h6>
            <a class="dropdown-item" href="#">Exchange application</a>
            <a class="dropdown-item" href="#">Select courses</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Exchange</h6>
            <a class="dropdown-item" href="#">Visa application</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-pen-square"></i> Apply now</a>
        </li>
      </ul>
        <ul class="navbar-nav ml-auto">
          <!-- Dropdown Login -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-alt"></i> Login
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <form class="px-4 py-3">
              <div class="form-group">
                <label for="exampleDropdownFormEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
              </div>
              <div class="form-group">
                <label for="exampleDropdownFormPassword1">Password</label>
                <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="dropdownCheck">
                <label class="form-check-label" for="dropdownCheck">
                  Remember me
                </label>
              </div>
              <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">New around here? Sign up</a>
            <a class="dropdown-item" href="#">Forgot password?</a>
          </div>
        </li>
        <!-- Dropdown menu Account-->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-alt"></i> Account
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#"><i class="fas fa-bell"></i> Application status</a>
            <a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Account Settings</a>
            <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </li>
        </ul>
    </div>
  </nav>


