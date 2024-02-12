<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Users / Profile </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/ -->
</head>

<body class="toggle-sidebar">

    <?php
    // Avvia la sessione
    $hostname = "localhost";
    $username = "ccgroup3";
    $password = "f2b5rfFQhhgA";
    $database = "my_ccgroup3";

    // Create a database connection
    $conn = mysqli_connect($hostname, $username, $password, $database);

    session_start();
    $email = "example@email.com";
    //$email = $_SESSION['email'];
    $sqlid = "SELECT `IBAN`, `NumeroTelefono` FROM `TConticorrenti` WHERE `Email` = ? ";
    $sqij = $conn->prepare($sqlid);
    $sqij->bind_param("s", $email);
    $sqij->execute();
    $result = $sqij->get_result();
    $record = $result->fetch_assoc();
    // Controlla se l'utente è loggato
// || !isset($_SESSION['email']) aggiungere quando c'è sessione
/*
if (!isset($_SESSION['nome']) || !isset($_SESSION['cognome'])  ) {
    // L'utente non è loggato, puoi aggiungere qui il codice di reindirizzamento a una pagina di accesso
    echo "<script>alert('Accesso negato. Effettua l\'accesso per visualizzare le informazioni.');</script>";
    exit;
}
*/
    // Estrai i dati dall'array di sessione
    $nome = $_SESSION['nome'];
    $cognome = $_SESSION['cognome'];

    $phone = $record['NumeroTelefono'];
    $data = $_SESSION['dataApertura'];
    $iban = $record['IBAN'];

    ?>
    <!--end changed by barbo needs review 4/6/23 16:35-->
    <!-- ======= Header ======= -->

    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Group3</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Menu</span>
                    </a><!-- End Profile Iamge Icon -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="faq.php">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->
            </ul>
        </nav><!-- End Icons Navigation -->
    </header><!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " href="personal_area.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <!-- End Operations -->
            <li class="nav-heading">Pages</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/php/contacts.php">
                    <i class="bi bi-envelope"></i>
                    <span>Contact</span>
                </a>
            </li><!-- End Contact Page Nav -->
        </ul>
    </aside>
    <!-- End Sidebar -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>

        </div><!-- End Page Title -->
        <section class="section profile">
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview" aria-selected="true"
                                        role="tab">Overview</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit"
                                        aria-selected="false" role="tab" tabindex="-1">Edit Profile</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings"
                                        aria-selected="false" tabindex="-1" role="tab">Settings</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade profile-overview active show" id="profile-overview"
                                    role="tabpanel">
                                    <h5 class="card-title">Profile Details</h5>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name:</div>
                                        <!-- changed by barbo needs review 4/6/23 16:35-->
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $nome . " " . $cognome; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone:</div>
                                        <!-- changed by barbo needs review 4/6/23 16:35-->
                                        <div class="col-lg-9 col-md-8">
                                            <?php if (!empty($phone)) {
                                                echo $phone;
                                            } else {
                                                echo "- - - - - -";
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email:</div>
                                        <!-- changed by barbo needs review 4/6/23 16:35-->
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $email; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">IBAN:</div>
                                        <!-- changed by barbo needs review 4/6/23 16:35-->
                                        <div class="col-lg-9 col-md-8">
                                            <?php if (!empty($iban)) {
                                                echo $iban;
                                            } else {
                                                echo "- - - - - -";
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">C.C. Creation:</div>
                                        <!-- changed by barbo needs review 4/6/23 16:35-->
                                        <div class="col-lg-9 col-md-8">
                                            <?php echo $data; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">
                                    <!-- Profile Edit Form -->

                                    <form action="" name="FormSave" method="post">
                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <!-- changed by barbo needs review 4/6/23 16:35-->
                                                <div class="col-lg-9 col-md-8">
                                                    <?php echo "<input name=\"nome\" type=\"text\" class=\"form-control\" id=\"nome\" value=" . $nome . ">" ?>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Surname</label>
                                            <div class="col-md-8 col-lg-9">
                                                <!-- changed by barbo needs review 4/6/23 16:35-->
                                                <div class="col-lg-9 col-md-8">
                                                    <?php echo "<input name=\"cognome\" type=\"text\" class=\"form-control\" id=\"cognome\" value=" . $cognome . ">" ?>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">

                                                <div class="col-lg-9 col-md-8">
                                                    <?php echo "<input name=\"phone\" type=\"text\" class=\"form-control\" id=\"phone\" value=" . $phone . ">" ?>
                                                </div>
                                                <!-- changed by barbo needs review 4/6/23 16:35-->

                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary" name="save" value="save"
                                                onclick="Save()">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                    <div>

                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="text-center">
                                                <a href=""></a>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="window.location.href ='change-password.php' ">
                                                    Change Password
                                                </button>
                                            </div>

                                            <!-- Button delate          <div class="text-center">
                <hr>
  <button type="submit" class="btn btn-danger" name="delete" style="color: white; background-color: red; border: none; padding: 10px 20px 10px;margin: 10px 20px 10px;">Delete Account</button>
</div>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade pt-3" id="profile-settings" role="tabpanel">
                                    <!-- Settings Form -->
                                    <form>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                                Notifications</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade"
                                                        checked="">
                                                    <label class="form-check-label" for="changesMade">
                                                        Changes made to your account
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts"
                                                        checked="">
                                                    <label class="form-check-label" for="newProducts">
                                                        Information on new products and services
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Marketing and promo offers
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="securityNotify"
                                                        checked="" disabled="">
                                                    <label class="form-check-label" for="securityNotify">
                                                        Security alerts
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End settings Form -->
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <script>function Save() {
            nomeString = FormSave.nome.value;
            cognomeString = FormSave.cognome.value;
            phoneString = FormSave.phone.value;



            if (nomeString == "" || cognomeString == "" || phoneString= "") {
                alert("error you have to insert the data in the form ");

                return;
            }


            FormSave.submit();

        }

    </script>
    <?php

    $email = "example@email.com";
    //$email = $_SESSION['email'];
    $phone = $_POST["phone"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if (empty($phone) == True || empty($nome) == True || empty($cognome) == True) {
        //prima volta è vuota
    } else {
        $sqli = $conn->prepare("UPDATE `TConticorrenti` SET `NumeroTelefono`=?, `NomeTitolare`=?, `CognomeTitolare`=? WHERE `Email`=?");
        $sqli->bind_param("ssss", $phone, $nome, $cognome, $email);
        //controlo se funziona
        if ($sqli->execute()) {

        } else {
            $message = "Error during the saving of the data" . $sqij->error;
            echo "<script type='text/javascript'>alert('$message');</script>";
        }

    }






    ?>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="copyright">
            © Copyright <strong><span>Group3</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->
    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>