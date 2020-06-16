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
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <link rel="stylesheet" href="css/style.css">
        <!-- <link rel="stylesheet" href="css/testlayout.css"> -->

        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

        <!-- form validate -->
        <script src="js/form-validate"></script>

        <!-- jsPDF CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.3/jspdf.plugin.autotable.min.js">
        </script>

        <!-- bootstrap stepper -->
        <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">

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
                <a class="navbar-brand" href="index.php">
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
                                <i class="fas fa-info-circle"></i> Informationen
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
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="new_application.php"><i class="fas fa-pen"></i> Neue Bewerbung</a>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <!-- Dropdown menu Account-->
                        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-file"></i> Application
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#"><i class="fas fa-bell"></i> Application status</a>
            <a class="dropdown-item" href="#"><i class="fas fa-plane-departure"></i> Before Departure</a>
            <a class="dropdown-item" href="#"><i class="fas fa-plane-arrival"></i> After Departure</a>
          </div>
        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="status_application.php"><i class="fas fa-pen"></i>Bewerbung</a>
                        </li>
                        <!-- Dropdown menu Account-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-alt"></i> Account
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <!-- <a class="dropdown-item" href="test_status.php"><i class="fas fa-home"></i> Profile Homepage</a> -->
                                <a class="dropdown-item" href="settings.php"><i class="fas fa-cog"></i>
                                    Einstellungen</a>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i>
                                    Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>