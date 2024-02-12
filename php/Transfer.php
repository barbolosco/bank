<?php
// Avvia la sessione
session_start();
ini_set('session.gc_maxlifetime', 1800);
// Check session expiration
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // Session expired, destroy session and redirect to login page
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

/*
Creare il generatore otp, inviare la mail e prendere dalla sessione l'email, con il pulsante annulla -> session destroy
  */
function generateOTP()
{
    $otpLength = 6;
    $otp = '';

    for ($i = 0; $i < $otpLength; $i++) {
        $otp .= mt_rand(0, 9);
    }

    return $otp;
}

// Update last activity time
$_SESSION['LAST_ACTIVITY'] = time();

//Verifica se l'email e l'id sono presenti nella sessione
if (isset($_SESSION['email']) && isset($_SESSION["contoID"])) {
    //Accedi all'email e all'id dalla sessione
    $email = $_SESSION['email'];
    $contoCorrenteIDx = $_SESSION['contoID'];

} else {
    //La sessione non contiene l'email e l'id, probabilmente l'utente non è autenticato
//Effettua un reindirizzamento alla pagina di login o gestisci l'errore in modo appropriato
    session_destroy();
    $message = "Oops! Something went wrong. Please log in again. ";
    echo "<script>alert('$message'); window.location.href = '/index.php';</script>";
    exit;
}

if (isset($_POST["submit"])) {
    // Check if the fields are blank
    if ((empty($_POST["NameBeneficiary"])) || (empty($_POST["IBANBeneficiary"])) || (empty($_POST["TransferType"])) || (empty($_POST["Amount"])) || (empty($_POST["TransferReason"]))) {
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
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
        $nomeBeneficiario = mysqli_real_escape_string($conn, $_POST["NameBeneficiary"]);
        $IBANB = mysqli_real_escape_string($conn, $_POST["IBANBeneficiary"]);
        $tipoTrasferimento = mysqli_real_escape_string($conn, $_POST["TransferType"]);
        $cifra = mysqli_real_escape_string($conn, $_POST["Amount"]);
        $causale = mysqli_real_escape_string($conn, $_POST["TransferReason"]);
        //prendo i dati in caso fosse inidirizzato ad un altra banca
        $_SESSION["NameBeneficiary"] = $nomeBeneficiario;
        $_SESSION["IBANBeneficiary"] = $IBANB;
        $_SESSION["Amount"] = $cifra;
        $_SESSION["TransferReason"] = $causale;
        //select per controllare se il saldo è disponibile
        $sql = "SELECT Saldo FROM TMovimentiContoCorrente WHERE ContoCorrenteID = ? ORDER BY MovimentoID DESC LIMIT 1";
        // Preparazione dello statement
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            // Bind del parametro ContoCorrenteID
            $stmt->bind_param("i", $contoCorrenteIDx);
            // Esecuzione dello statement
            $stmt->execute();
            // Ottieni il risultato della query
            $result = $stmt->get_result();

            // Verifica se la query ha restituito dei risultati
            if ($result->num_rows > 0) {
                // Ottieni il valore dell'ultimo saldo
                $row = $result->fetch_assoc();
                $saldo = $row['Saldo'];
                $_SESSION["Cash"] = $saldo;
            } else {
                echo "<script>alert('Missing or untraceable balance'); window.location.href = 'login.php';</script>";
            }
            // Chiusura dello statement
            $stmt->close();
        } else {
            echo "Errore nella preparazione dello statement: " . $conn->error;
        }
        //select per controllare se l'iban esiste altrimenti mandare messaggio di notifica che l'iban non è presente nella nostra banca
        //a prescindere si fa un insert dove viene inserito il nuovo movimento

        if ($saldo < $cifra) {
            echo "<script>alert('We have not the capacities');</script>";

        } else {
            $sql = "SELECT ContoCorrenteID FROM TConticorrenti WHERE NomeTitolare = ? AND IBAN = ?";

            // Preparazione dello statement
            $stmt2 = $conn->prepare($sql);

            if ($stmt2) {
                // Bind dei parametri NomeTitolare e IBAN
                $stmt2->bind_param("ss", $nomeBeneficiario, $IBANB);
                // Esecuzione dello statement
                $stmt2->execute();
                // Ottieni il risultato della query
                $result = $stmt2->get_result();
                // Verifica se la query ha restituito dei risultati
                if ($result->num_rows > 0) {
                    // Ottieni il valore di ContoCorrenteID
                    $row = $result->fetch_assoc();
                    $contoCorrenteBeneficiarioID = $row['ContoCorrenteID'];
                    $_SESSION["contoCorrenteBeneficiarioID"] = $contoCorrenteBeneficiarioID;
                    //creazione otp e invio email
                    $otpValido = generateOTP();

                    // Preparazione email con il codice OTP
                    $to = $email; //$email
                    $subject = 'OTP code for login verification';
                    $message = 'Your OTP code is: ' . $otpValido . '<br> Use it to send the bank transfer. <br><br> If you did not initiate this transfer, please notify us immediately so we can resolve it as soon as possible.';
                    $message = wordwrap($message, 950);
                    $headers = "From: ccgruppo3@gmail.com\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    // Invia l'email
                    if (mail($to, $subject, $message, $headers)) {
                        $message = "Email with OTP code successfully sent to: " . $to;
                        echo "<script type='text/javascript'>alert(" . $message . ");</script>";
                    } else {
                        $message = "Error during email sending";
                        echo "<script type='text/javascript'>alert(" . $message . "); window.location.href = 'login.php';</script>";
                        exit;
                    }
                    //inizio sessione con la e-mail
                    $_SESSION['otpValido'] = $otpValido;
                    $_SESSION['email'] = $email;
                    $_SESSION['contoID'] = $contoCorrenteIDx;
                    header("Location: verifytransfer.php");
                    exit;

                } else {
                    //echo "Nessun conto corrente trovato con il nome del titolare e l'IBAN specificati.";
                    $otpValido = generateOTP();

                    // Preparazione email con il codice OTP
                    $to = $email; //$email
                    $subject = 'OTP code for login verification';
                    $message = 'Your OTP code is: ' . $otpValido . '<br> Use it to send the bank transfer. <br><br> If you did not initiate this transfer, please notify us immediately so we can resolve it as soon as possible.';
                    $message = wordwrap($message, 950);
                    $headers = "From: ccgruppo3@gmail.com\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                    // Invia l'email
                    if (mail($to, $subject, $message, $headers)) {
                        $message = "Email with OTP code successfully sent to: " . $to;
                        echo "<script type='text/javascript'>alert(" . $message . ");</script>";
                    } else {
                        $message = "Error during email sending";
                        echo "<script type='text/javascript'>alert(" . $message . "); window.location.href = 'login.php';</script>";
                        exit;
                    }
                    $_SESSION['email'] = $email;
                    $_SESSION['contoID'] = $contoCorrenteIDx;
                    $_SESSION["otpValido"] = $otpValido;
                    $message = "Attenzione";
                    echo "<script>alert('$message'); window.location.href = 'transferext.php';</script>";
                }

                // Chiusura dello statement
                $stmt2->close();

            } else {
                echo "Errore nella preparazione dello statement: " . $conn->error;
                $message = "The name or email is incorrect!";
                echo "<script>alert(" . $message . ");</script>";
            }
        }
        // Close the database connection
        mysqli_close($conn);
    }

}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Transfer</title>
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

<body class="toggle-sidebar">

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="personal_area.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Transfer</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

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
                <a class="nav-link collapsed" href="http://ccgroup3.altervista.org/php/account.php">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Transfer</h1>
        </div><!-- End Page Title -->

        <section class="section contact">

            <div class="row gy-4">



                <div class="col-xl-12">
                    <div class="card p-4">
                        <form action="Transfer.php" method="post">
                            <div class="row gy-4"
                                style="display: flex; flex-wrap: wrap; margin-right: -15px; margin-left: -15px;">

                                <div class="col-md-6" style="flex: 0 0 50%; max-width: 50%;">
                                    <input type="text" name="NameBeneficiary" class="form-control"
                                        placeholder="Name Beneficiary" required
                                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                </div>

                                <div class="col-md-6" style="flex: 0 0 50%; max-width: 50%;">
                                    <input type="text" class="form-control" name="IBANBeneficiary"
                                        placeholder="IBAN Beneficiary" required
                                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                </div>

                                <div class="col-md-6" style="flex: 0 0 50%; max-width: 50%;">
                                    <input type="text" name="TransferType" class="form-control"
                                        placeholder="Transfer Type" required
                                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                </div>

                                <div class="col-md-6" style="flex: 0 0 50%; max-width: 50%;">
                                    <input type="text" class="form-control" name="Amount" placeholder="Amount" required
                                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                </div>

                                <div class="col-md-12" style="flex: 0 0 100%; max-width: 100%;">
                                    <textarea class="form-control" name="TransferReason" rows="6"
                                        placeholder="Transfer Reason" required
                                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
                                </div>

                                <button name="submit" type="submit"
                                    style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Submit
                                    Transfer Request</button>
                            </div>

                    </div>


                    </form>
                </div>

            </div>

            </div>

        </section>



    </main><!-- End #main -->

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