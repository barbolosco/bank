<?php
session_start();

if (isset($_SESSION["email"]) == FALSE) {
    session_destroy();
    header("location: /index.php");

}

ini_set('session.gc_maxlifetime', 1800);
// Check session expiration
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // Session expired, destroy session and redirect to login page
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}


?>
<!-- modifica paglia -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Personal Area</title>
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
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<!-- modifica paglia -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


<script>function Ricarica() {
        carrierString = FormRicarica.phone - carrier.value;
        numberString = FormRicarica.yourPhoneNumber.value;
        amountString = FormRicarica.amount.value;

        if (carrierString == "" || numberString == "" || amountString == "" || amountString == "0") {
            alert("Devi inserire i dati della ricarica corretti");
            return;
        }
        //phone-carrier yourPhoneNumber amount

        FormRicarica.submit();

    }
    function CountSearch() {
        countString = FormCount.count.value;


        if (carrierString == "") {
            alert("Devi inserire i dati della ricarica corretti");
            return;
        }
        //phone-carrier yourPhoneNumber amount

        FormCount.submit();
    }
    function DateSearch() {
        startString = FormDate.startdate.value;
        endString = FormDate.enddate.value;


        if (startString == "" || endString == "") {
            alert("Devi inserire i dati della ricarica corretti");
            return;
        }
        //phone-carrier yourPhoneNumber amount

        FormDate.submit();
    }
    function CategorySearch() {
        categoryString = FormCategory.category.value;

        if (categoryString == "") {
            alert("Devi inserire i dati della ricarica corretti");
            return;
        }
        //phone-carrier yourPhoneNumber amount

        FormCategory.submit();
    }

    function redirectToPage(url, variable) {


        // Construct the URL with the variable as a query parameter
        var destinationURL = url + '?variable=' + variable.value;

        // Redirect to the destination URL
        window.location.href = destinationURL;
    }
    function redirectToPage2(url, variable, variable2) {


        // Construct the URL with the variable as a query parameter
        var destinationURL = url + '?variable=' + variable.value + '&variable2=' + variable2.value;

        // Redirect to the destination URL
        window.location.href = destinationURL;
    }
</script>
<!-- modifica paglia -->
<!-- modifica paglia -->

<body class="toggle-sidebar">
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="personal_area.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Group3</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
        <!--
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> Erase -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Update</h4>
                                <p>New update coming. Stay updated!</p>
                                <p>Less than an hour ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Security</h4>
                                <p>Remember, never share your password. Protect your online security.</p>
                                <p>Less than an hour ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Assistance</h4>
                                <p>If you have problems, do not hesitate to contact us from the contacts section or
                                    visit the F.A.Q
                                    page.</p>
                                <p>Less than an hour ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Welcome!</h4>
                                <p>Your bank account has been opened.</p>
                                <p>Less than an hour ago</p>
                            </div>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->
                <li class="nav-item dropdown pe-3">
                    <!-- Id per stampare Items -->
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="d-none d-md-block dropdown-toggle ps-2" id="nameAccountMenu">K. Anderson</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="">
                        <li class="dropdown-header">
                            <h6 id="nameAccount">Kevin Anderson</h6>
                            <span id="dateCreation">Web Designer</span>
                        </li>
                        <!-- End id stampare Items -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="account.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

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
                            <a class="dropdown-item d-flex align-items-center"
                                href="http://ccgroup3.altervista.org/php/logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li>

                <li class="nav-item dropdown">

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->


                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>Kevin Anderson</h6>
                        <span>Web Designer</span>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="account.php">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="account.php">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

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
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
                <!-- End Profile Nav -->

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

            <li class="nav-item">
                <a class="nav-link" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#" aria-expanded="true">
                    <i class="bi bi-journal-text"></i><span>Transfer</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav" style="">
                    <li>
                        <a href="Transfer.php">
                            <i class="bi bi-circle"></i><span>Transfer</span>
                        </a>
                    </li>
                    <li class="recharge-phone">
                        <a href="#">
                            <i class="bi bi-circle"></i>
                            <span>Add Phone Credit</span>
                        </a>
                        <!-- Sub-menu for phone recharge -->
                        <!-- modifica paglia -->
                        <ul class="sub-menu">
                            <li>
                                <form name="FormRicarica" action="" method="post">
                                    <div class="col-12">
                                        <label for="yourPhoneNumber" class="form-label">Phone number</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text">+39</span>
                                            <input type="text" name="yourPhoneNumber" class="form-control"
                                                id="yourPhoneNumber">
                                            <div class="invalid-feedback">Please insert your phone number.</div>
                                        </div>
                                    </div>
                                    <br>
                                    <label for="recharge-amount">Amount:</label>
                                    <div class="input-icon">
                                        <i class="fas fa-chevron-down"></i>
                                        <select id="amount" name="amount" class="form-control">
                                            <option value="">0</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                        </select>
                                    </div>
                                    <br>
                                    <label for="phone-carrier">Carrier:</label>
                                    <div class="input-icon">
                                        <i class="fas fa-chevron-down"></i>
                                        <select id="phone-carrier" name="phone-carrier" class="form-control">
                                            <option value="">----</option>
                                            <option value="Iliad">Iliad</option>
                                            <option value="Tim">Tim</option>
                                            <option value="Vodafone">Vodafone</option>
                                            <option value="Wind">Wind</option>
                                            <option value="Tre">Tre</option>
                                            <option value="Fastweb">Fastweb</option>
                                            <option value="Very Mobile">Very Mobile</option>
                                            <option value="other">other</option>
                                        </select>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary" value="ricarica"
                                        onclick="Ricarica()">Recharge</button>
                                </form>
                            </li>

                        </ul><!-- End sub-menu -->
                    </li>
                    <!-- modifica paglia -->
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="account.php">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="contacts.php">
                    <i class="bi bi-envelope"></i>
                    <span>Contact</span>
                </a>
            </li><!-- End Contact Page Nav -->

        </ul>
    </aside><!-- End Sidebar -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="personal_area.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">


                        <!-- Revenue Card -->
                        <div class="col-12">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Revenue</h5>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><span id="revenueAmount">$3,264</span></h6>

                                        </div>
                                        <div class="ps-3">
                                            <button class="btn btn-link" id="hideRevenueBtn"
                                                onclick="toggleRevenueVisibility()">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Revenue Card -->

                        <script>
                            function toggleRevenueVisibility() {
                                var revenueAmount = document.getElementById('revenueAmount');
                                var hideRevenueBtn = document.getElementById('hideRevenueBtn');
                                if (revenueAmount.style.display === 'none') {
                                    revenueAmount.style.display = 'inline';
                                    hideRevenueBtn.innerHTML = '<i class="bi bi-eye"></i>';
                                } else {
                                    revenueAmount.style.display = 'none';
                                    hideRevenueBtn.innerHTML = '<i class="bi bi-eye-slash"></i>';
                                }
                            }
                        </script>



                        <!-- Reports -->
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Reports</h5>
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <script type="text/javascript"
                                            src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
                                            async>
                                                {
                                                    "symbols": [
                                                        {
                                                            "proName": "FOREXCOM:SPXUSD",
                                                            "title": "S&P 500"
                                                        },
                                                        {
                                                            "proName": "FOREXCOM:NSXUSD",
                                                            "title": "US 100"
                                                        },
                                                        {
                                                            "proName": "FX_IDC:EURUSD",
                                                            "title": "EUR/USD"
                                                        },
                                                        {
                                                            "proName": "BITSTAMP:BTCUSD",
                                                            "title": "Bitcoin"
                                                        },
                                                        {
                                                            "proName": "BITSTAMP:ETHUSD",
                                                            "title": "Ethereum"
                                                        }
                                                    ],
                                                        "showSymbolLogo": true,
                                                            "colorTheme": "light",
                                                                "isTransparent": false,
                                                                    "displayMode": "adaptive",
                                                                        "locale": "en"
                                                }
                                            </script>
                                    </div>
                                    <!-- TradingView Widget END -->

                                </div>

                            </div>
                        </div><!-- End Reports -->
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown" aria-expanded="false"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="">
                                        <li class="dropdown-header text-start"
                                            style="padding-bottom:0px;padding-left:20px">
                                            <h6>Filter</h6>
                                        </li>






                                        <!-- Sub-menu for date search -->

                                        <li class="recharge-phone">

                                            <!-- Sub-menu for phone recharge -->

                                        </li>
                                        <!--  inizio roba modificata -->
                                        <li>
                                            <form style="margin:20px;margin-top:5px;" action="" name="FormCount"
                                                method="post">

                                                <button type="button" class="btn btn-primary"
                                                    onclick="redirectToPage('search-movement1.php', count)"
                                                    value="countsearch"
                                                    style="margin-bottom:5px;font-size:78%;margin-top:10px">
                                                    serch for an amount:
                                                </button>
                                                <input type="number" class="form-control" id="count" name="count">
                                            </form>

                                            <form style="margin:20px;margin-top:5px;" action="" name="FormDate"
                                                method="post">
                                                <button type="button" class="btn btn-primary"
                                                    onclick="redirectToPage2('search-movement2.php', startdate, enddate)"
                                                    value="datesearch"
                                                    style="margin-bottom:5px;font-size:16.5px;margin-top:10px">
                                                    serch for date :
                                                </button>
                                                <div class="input-icon">
                                                    <i class="fas fa-chevron-down"></i>
                                                    <input type="date" class="form-control" id="startdate"
                                                        name="startdate" style="margin-bottom:10px">
                                                    <div class="invalid-feedback">Please insert the end date.</div>

                                                </div>


                                                <div class="input-icon">
                                                    <i class="fas fa-chevron-down"></i>
                                                    <input type="date" class="form-control" id="enddate" name="enddate">
                                                </div>
                                                <div class="invalid-feedback">Please insert the end date.</div>

                                            </form>

                                            <form style="margin:20px;margin-top:5px;" action="" name="FormCategory"
                                                method="post">
                                                <div class="input-icon">

                                                    <button type="button"
                                                        onclick="redirectToPage('search-movement3.php', category)"
                                                        value="categorysearch" class="btn btn-primary"
                                                        style="margin-bottom:5px;font-size:14px;margin-top:10px">
                                                        serch for category:
                                                    </button>
                                                </div>

                                                <div class="col-12">

                                                    <div class="input-group has-validation">

                                                        <select id="category" name="category" class="form-control">
                                                            <option value="">-----</option>
                                                            <option value="1">Opening a current account</option>
                                                            <option value="2">Incoming Bank Transfer</option>
                                                            <option value="3">Outgoing Bank Transfer</option>
                                                            <option value="4">Cash Withdrawal</option>
                                                            <option value="5">Bill Payment</option>
                                                            <option value="6">Recharge</option>
                                                            <option value="7">ATM Deposit</option>
                                                            <option value="8">Payments</option>
                                                            <option value="9">Emolument Credit</option>
                                                            <option value="10">Loans</option>
                                                            <option value="11">Mortgages</option>
                                                        </select>

                                                    </div>
                                                </div>



                                            </form>
                                        </li>


                                        <!-- end Sub-menu for date search -->
                                    </ul>
                                </div>

                                <!-- end  roba modificata -->
                                <div class="card-body">
                                    <!-- inizio roba modificata -->
                                    <h5 class="card-title">Recent Sales </h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Movement Category</th>
                                                <th scope="col">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            session_start();
                                            $email = $_SESSION["email"];
                                            $conn = mysqli_connect("127.0.0.1", "ccgroup3", "f2b5rfFQhhgA", "my_ccgroup3");

                                            // trovo idconto
                                            $sqlid = "SELECT `ContoCorrenteID`,`NomeTitolare`, `CognomeTitolare`, `DataApertura` FROM `TConticorrenti` WHERE `Email` = ? ";
                                            $sqij = $conn->prepare($sqlid);
                                            $sqij->bind_param("s", $email);
                                            $sqij->execute();
                                            $resultID = $sqij->get_result();
                                            $contoID = $resultID->fetch_assoc();
                                            //setto variabili sessione
                                            $_SESSION["contoID"] = $contoID["ContoCorrenteID"];
                                            $_SESSION["nome"] = $contoID["NomeTitolare"];
                                            $_SESSION["cognome"] = $contoID["CognomeTitolare"];
                                            $_SESSION["dataApertura"] = $contoID["DataApertura"];
                                            echo "<script>document.getElementById('nameAccountMenu').innerHTML= '" . $_SESSION["nome"] . " " . $_SESSION["cognome"] . "';</script>";
                                            echo "<script>document.getElementById('nameAccount').innerHTML= '" . $_SESSION["nome"] . " " . $_SESSION["cognome"] . "';</script>";
                                            echo "<script>document.getElementById('dateCreation').innerHTML= 'C.A. Creation: " . $_SESSION["dataApertura"] . "';</script>";


                                            //seleziono il saldo
                                            $sqlsaldo = $conn->prepare("SELECT `Saldo` FROM `TMovimentiContoCorrente` WHERE `ContoCorrenteID` = ? ORDER BY `MovimentoID` DESC LIMIT 1");
                                            $sqlsaldo->bind_param("s", $_SESSION["contoID"]);
                                            $sqlsaldo->execute();
                                            $resultsaldo = $sqlsaldo->get_result();
                                            $saldo = $resultsaldo->fetch_assoc();
                                            $_SESSION["saldo"] = $saldo["Saldo"];
                                            echo "<script>document.getElementById('revenueAmount').innerHTML= '$" . $_SESSION["saldo"] . "';</script>";
                                            //selseziono dati per tabella
                                            // SELECT `Data`, `Importo` ORDER BY `Data` LIMIT 5
                                            
                                            $sqltable = $conn->prepare("SELECT TC.MovimentoID, TC.Data, TC.Importo, CM.NomeCategoria FROM TMovimentiContoCorrente TC JOIN TCategorieMovimenti CM ON TC.CategoriaMovimentoID = CM.CategoriaMovimentoID WHERE TC.ContoCorrenteID = ? ORDER BY TC.MovimentoID DESC LIMIT 5");
                                            $sqltable->bind_param("s", $_SESSION["contoID"]);
                                            $sqltable->execute();
                                            $result = $sqltable->get_result();



                                            while ($row = $result->fetch_assoc()) {


                                                echo ("<tr>");
                                                $recorData = "<td>" . $row["Data"] . "</td>";
                                                $recordBalance = "<td>" . $row["Importo"] . "</td>";
                                                $recordCategoria = "<td>" . $row["NomeCategoria"] . "</td>";
                                                $recordDettaglio = "<td><a href=\"movementdetail.php?MovimentoID=" . $row["MovimentoID"] . "\">Details</a></td>";

                                                echo ($recorData);
                                                echo ($recordBalance);
                                                echo ($recordCategoria);
                                                echo ($recordDettaglio);

                                                echo ("</tr>");


                                            }
                                            mysqli_close($conn);
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            <!-- end  roba modificata -->
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->

                <div class="col-lg-4">
                    <div class="card">
                        <canvas id="grafico"></canvas>
                    </div>
                </div>
                <?php
                session_start();
                $email = $_SESSION["email"];
                // Connessione al database
                $conn = mysqli_connect("127.0.0.1", "ccgroup3", "f2b5rfFQhhgA", "my_ccgroup3");

                // Verifica della connessione
                if (!$conn) {
                    die("Connessione al database fallita: " . mysqli_connect_error());
                }

                // Array dei mesi
                $mesi = array(
                    '01' => 'January',
                    '02' => 'February',
                    '03' => 'March',
                    '04' => 'April',
                    '05' => 'May',
                    '06' => 'June',
                    '07' => 'July',
                    '08' => 'August',
                    '09' => 'September',
                    '10' => 'October',
                    '11' => 'November',
                    '12' => 'December'
                );

                // Array per le Expenditure e le Income
                $Expenditure = array();
                $Income = array();

                // Esegui le query per ottenere i dati
                for ($mese = 1; $mese <= 12; $mese++) {
                    // Query per le Expenditure
                    $queryExpenditure = "SELECT COUNT(*) AS Expenditure
                    FROM TMovimentiContoCorrente AS m
                    INNER JOIN TCategorieMovimenti AS c ON m.CategoriaMovimentoID = c.CategoriaMovimentoID
                    WHERE m.ContoCorrenteID = 1 AND c.Tipologia = 'Expenditure' AND MONTH(m.Data) = $mese";

                    $resultExpenditure = mysqli_query($conn, $queryExpenditure);
                    $rowExpenditure = mysqli_fetch_assoc($resultExpenditure);
                    $Expenditure[$mese] = $rowExpenditure['Expenditure'];

                    // Query per le Income
                    $queryIncome = "SELECT COUNT(*) AS Income
                     FROM TMovimentiContoCorrente AS m
                     INNER JOIN TCategorieMovimenti AS c ON m.CategoriaMovimentoID = c.CategoriaMovimentoID
                     WHERE m.ContoCorrenteID = 1 AND c.Tipologia = 'Income' AND MONTH(m.Data) = $mese";

                    $resultIncome = mysqli_query($conn, $queryIncome);
                    $rowIncome = mysqli_fetch_assoc($resultIncome);
                    $Income[$mese] = $rowIncome['Income'];
                }

                // Chiudi la connessione al database
                mysqli_close($conn);
                ?>
                <!-- <style>
          .card {
            width: 100%;
            height: 400px;
            padding: 10px;
          }
        </style> -->

                <!-- JavaScript -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Dati per il grafico
                        var mesi = <?php echo json_encode(array_values($mesi)); ?>;
                        var Expenditure = <?php echo json_encode(array_values($Expenditure)); ?>;
                        var Income = <?php echo json_encode(array_values($Income)); ?>;

                        // Crea il grafico a barre
                        var ctx = document.getElementById('grafico').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: mesi,
                                datasets: [{
                                    label: 'Expenditure',
                                    backgroundColor: 'red',
                                    data: Expenditure
                                }, {
                                    label: 'Income',
                                    backgroundColor: 'blue',
                                    data: Income
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        precision: 0
                                    }
                                }
                            }
                        });
                    });
                </script>

            </div><!-- End Left side columns -->






            </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->
    <!-- modifica paglia -->
    <?php
    session_start();
    // echo ("fuori");
    /*
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    */
    $email = $_SESSION["email"];
    //phone-carrier yourPhoneNumber amount
    $number = $_POST["yourPhoneNumber"];
    $amount = $_POST["amount"];
    $carrier = $_POST["phone-carrier"];

    
    if (empty($number) == True || empty($amount) == True || empty($carrier) == True) {
        //prima volta e vuoto o ci sono problemi nel passaggio dei parametri
//controlla attributi name e id
    
    } else {
        $email = $_SESSION["email"];
        $hostname = "localhost";
        $username = "ccgroup3";
        $password = "f2b5rfFQhhgA";
        $database = "my_ccgroup3";

        // Create a database connection
        $conn = mysqli_connect($hostname, $username, $password, $database);

        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $saldo = $_SESSION["saldo"];


        if (floatval($amount) > floatval($saldo)) {

            $message = "You don't have not enough funds!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {

            $email = $_SESSION["email"];
            // Prepare the statement
            $stmt3 = $conn->prepare("INSERT INTO `TMovimentiContoCorrente` (`ContoCorrenteID`, `Data`, `Importo`, `Saldo`, `CategoriaMovimentoID`, `DescrizioneEstesa`) VALUES (?, ?, ?, ?, ?, ?)");

            // Set the values of the parameters
            //$contoCorrenteID = $_SESSION['ContoCorrenteID'];
            $contoCorrenteID = $_SESSION["contoID"];
            $data = date('Y-m-d H:i:s');
            $importo = floatval($amount);
            $saldo = floatval($saldo) - floatval($amount); //calcolo gia il saldo
            $categoriaMovimentoID = 6;
            $descrizioneEstesa = 'Recharge of the ' . $number . " With Phone Carrier: " . $carrier;

            // Bind the parameters
            $stmt3->bind_param("isddis", $contoCorrenteID, $data, $importo, $saldo, $categoriaMovimentoID, $descrizioneEstesa);


            // Execute the statement
            $stmt3->execute();

            if ($stmt3) {
                $message = "Recharge succesfull.";
                echo "<script type='text/javascript'>alert('$message');</script>";


            } else {
                $message = "Error impossible to continue the operation!";
                echo "<script type='text/javascript'>alert('$message');</script>";

                echo ($conn->error);
            }
            // Close the statement
            $stmt3->close();
        }
        mysqli_close($conn);


    }

    ?>
    <!-- modifica paglia -->
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
