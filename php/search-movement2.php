<?php 
session_start();

if(isset($_SESSION["email"])==FALSE){
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
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Search by Date</title>
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
<script>
function redirectToPage(url) {
    var myVariable = '<?php echo $_SESSION['query']; ?>';

// Construct the URL with the variable as a query parameter
var destinationURL = url;

// Redirect to the destination URL
window.location.href = destinationURL;
}
</script>
<body class="toggle-sidebar">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="personal_area.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Search by Date</span>
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

        <!-- End Search Icon-->

        

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

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav>

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
                <a class="nav-link collapsed" href="http://ccgroup3.altervista.org/php/account.php">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

        </ul>
    </aside><!-- End Sidebar -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Search by Date
            </h1>

        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">



                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Details </h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Balance</th>
                                                <th scope="col">Movement category</th>
                                                <th scope="col">Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                        
                          $email="example@email.com";
                          $conn=mysqli_connect("127.0.0.1","ccgroup3","f2b5rfFQhhgA","my_ccgroup3");
                          /*
                            echo($_SESSION["contoID"]);
                            echo($_SESSION["nome"]);
                            echo($_SESSION["cognome"]);
                            echo($_SESSION["dataApertura"]);
                            */
                          $contoID=$_SESSION["contoID"];
                          echo($contoID);
                          //$contoID='1';
                          //$movimentoid=isset($_GET['MovimentoID']) ? $_GET['MovimentoID'] : 'Error MovimentoID is missing';
                          $startdate=$_GET["variable"];
                          //echo($startdate);
                          $enddate=$_GET['variable2'];
                          //echo($enddate);
                          $_SESSION["startdate"]=$startdate;
                          $_SESSION["enddate"]=$enddate;
                          //$startdate="2023-04-26";
                          //$enddate="2023-07-03";

                          /*
                            // trovo id conto corrente 


                            $sqlid="SELECT `ContoCorrenteID` FROM `TMovimentiContoCorrente` WHERE `MovimentoID` = ?";
                            $sqij = $conn->prepare($sqlid);
                            $sqij->bind_param("i", $movimentoid);
                            $sqij->execute();
                            $resultID = $sqij->get_result();
                            $testID=$resultID->fetch_assoc();
                            //controllo se                        
                            Fatal error: Uncaught mysqli_sql_exception: Incorrect DATE value: '?' 
                            in /membri/ccgroup3/phpPROVE/search-movement2.php:191 Stack trace: #0 
                            /membri/ccgroup3/phpPROVE/search-movement2.php(191): mysqli->prepare('SELECT TC.Descr...') 
                            #1 {main} thrown in /membri/ccgroup3/phpPROVE/search-movement2.php on line 191                         
                            */
                            $sqltable = $conn->prepare("SELECT TC.DescrizioneEstesa, TC.Saldo, TC.Data, TC.Importo, CM.NomeCategoria 
                                                    FROM TMovimentiContoCorrente TC
                                                    JOIN TCategorieMovimenti CM ON TC.CategoriaMovimentoID = CM.CategoriaMovimentoID
                                                    WHERE TC.ContoCorrenteID = ?
                                                    AND TC.Data BETWEEN ? AND ?
                                                    ORDER BY TC.Data DESC");
                            $sqltable->bind_param("iss",$contoID, $startdate, $enddate);
                            $sqltable->execute();
                            $result = $sqltable->get_result();
                                                        

                            
                            
                            if(!empty($result)){

                            while($row=$result->fetch_assoc()){
                                
                              
                              echo("<tr>");
                              $recorData="<td>".$row["Data"]."</td>";
                              $recordImport="<td>".$row["Importo"]."</td>";
                              $recordBalance="<td>".$row["Saldo"]."</td>";
                              $recordCategoria="<td>".$row["NomeCategoria"]."</td>";
                              $recordDescrizione="<td>".$row["DescrizioneEstesa"]."</td>";
                              //$recordDettaglio="<td><a href=\"movementdetail.php?MovimentoID=".$row["MovimentoID"]."\">Dettegli</a></td>";
                              
                              echo($recorData);
                              echo($recordImport);
                              echo($recordBalance);
                              echo($recordCategoria);
                              echo($recordDescrizione);
                              
                              //echo($recordDettaglio);
                              
                              echo("</tr>");
                              
                        }
                    }
                    else{
                        $message="Error impossible to load the results or no results found.";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                        mysqli_close($conn);
                      ?>
                                        </tbody>
                                    </table>
                                    <form style="margin:20px;margin-top:5px;" action="" name="FormCount" method="post">

                                        <button type="button" class="btn btn-primary" onclick="redirectToPage('export2.php')" value ="countsearch"
                                        style="margin-bottom:5px;font-size:78%;margin-top:10px">
                                        Export to file
                                        </button>

                                        </form>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->

        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
