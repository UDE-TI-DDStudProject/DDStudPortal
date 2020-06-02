<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>UDE Exchange Programs in SEA</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap 4 core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- style.css -->
        <link rel="stylesheet" href="css/style.css">
        <!-- <link rel="stylesheet" href="css/testlayout.css"> -->

        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>

        <!-- form validate -->
        <script src="js/form-validate"></script>

    </head>

    <body class="d-flex flex-column">
        <!-- main Container -->
        <!-- <div class="wrapper"> -->

        <header>
            <!-- navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #003D76;">
                <!-- UDE Logo hyperlink -->
                <a class="navbar-brand" href="#">
                    <img src="screenshots/UDE-Logo1.png" width="150" height="70" class="d-inline-block align-top"
                        alt="">
                </a>
                <!-- Exchange Logo hyperlink -->
                <a class="navbar-brand" href="home.php">
                    <img src="screenshots/worldwide.png" width="30" height="30" class="d-inline-block align-center"
                        alt="">
                    Südostasien
                </a>
                <!-- Menu hamburger icon at mobile size -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collapsible navbar at mobile size -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <!-- Menu on the left -->
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item active">
          <a class="nav-link" href="#"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
        </li> -->
                        <!-- Dropdown menu Information-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-alt"></i> Informationen
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <!-- <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-pen-square"></i> Apply now</a>
        </li> -->
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <!-- Dropdown Login -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-alt"></i> Login
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <form class="px-4 py-3" action="login.php" method="post">
                                    <div class="form-group">
                                        <label for="exampleDropdownFormEmail1">E-Mail</label>
                                        <input name="email" type="email" class="form-control"
                                            id="exampleDropdownFormEmail1" placeholder="E-Mail">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleDropdownFormPassword1">Passwort</label>
                                        <input name="passwort" type="password" class="form-control"
                                            id="exampleDropdownFormPassword1" placeholder="Passwort">
                                    </div>
                                    <div class="form-check">
                                        <input name="rememberMe" type="checkbox" class="form-check-input"
                                            id="dropdownCheck" checked>
                                        <label class="form-check-label" for="dropdownCheck">
                                            angemeldet bleiben
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Anmelden</button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="register.php">Registrieren</a>
                                <a class="dropdown-item" href="passwortvergessen.php">Passwort vergessen?</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>