<?php
// Avvia la sessione
session_start();

// Recupera i dati dalla sessione
if (isset($_SESSION["email"]) && isset($_SESSION["otpValido"]) && isset($_SESSION["contoID"])) {
  $email = $_SESSION["email"];
  $otpValido = $_SESSION["otpValido"];
  $contoCorrenteIDx = $_SESSION["contoID"];
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

  // Recupera i dati dalla sessione
  if (isset($_SESSION["NameBeneficiary"]) && isset($_SESSION["IBANBeneficiary"]) && isset($_SESSION["Amount"]) && isset($_SESSION["TransferReason"])) {
    $nomeBeneficiario = $_SESSION["NameBeneficiary"];
    $IBANB = $_SESSION["IBANBeneficiary"];
    $cifra = $_SESSION["Amount"];
    $causale = $_SESSION["TransferReason"];

    // Verifica se il parametro generate_otp è presente nell'URL e impostato su true
    if (isset($_GET['generate_otp']) && $_GET['generate_otp'] === 'true') {
      // Genera un nuovo codice OTP
      $newOTP = generateOTP(); // Sostituisci questa chiamata con la tua funzione di generazione del codice OTP

      // Associa il nuovo codice OTP all'utente
      $_SESSION['otpValido'] = $newOTP; // Salva il nuovo codice OTP nella sessione o nel database, a seconda delle tue esigenze
      // Preparazione email con il codice OTP
      $to = $email;
      $subject = 'OTP code for login verification';
      $message = 'Your OTP code is: ' . $newOTP . '<br>Use it to send the bank transfer. <br><br> If you did not initiate this transfer, please notify us immediately so we can resolve it as soon as possible.';
      $message = wordwrap($message, 950);
      $headers = "From: ccgruppo3@gmail.com\r\n";
      $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

      // Invia l'email
      if (mail($to, $subject, $message, $headers)) {
        $message = "Email with the new OTP Code successfully sent to: " . $to;
        echo "<script type='text/javascript'>alert('$message');</script>";
      } else {
        $message = "Error during email sending";
        echo "<script type='text/javascript'>alert('$message'); window.location.href = 'login.php';</script>";
        exit;
      }
    }
    $otpValido = $_SESSION["otpValido"];

    if (isset($_POST['submit']) && $_POST['submit'] === 'yes') {
      if (empty($_POST["otpcode"])) {
        echo "<script>alert('Please fill in all fields.');</script>";
      } else {
        $otpInserito = $_POST["otpcode"];
        if ($otpInserito === $otpValido) {
          // Il codice OTP inserito è valido

          // L'utente ha premuto "Si", esegui l'inserimento in MovimentoContoCorrente
          // Effettua la connessione al database
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
          // prendo il saldo
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
            } else {
              echo "No balance found for the specified bank account.";
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
            $stmt1 = $conn->prepare("INSERT INTO TMovimentiContoCorrente (ContoCorrenteID, Data, Importo, Saldo, CategoriaMovimentoID, DescrizioneEstesa) VALUES (?, ?, ?, ?, ?, ?)");

            // Verifica se la preparazione dello statement è avvenuta con successo
            if ($stmt1) {
              // Bind the parameters
              $stmt1->bind_param("isddis", $contoCorrenteID, $data, $importo, $saldo, $categoriaMovimentoID, $descrizioneEstesa);

              // Set the values of the parameters
              $contoCorrenteID = $contoCorrenteIDx;
              $data = date('Y-m-d H:i:s');
              $importo = $cifra;
              $saldo = $saldo - $cifra; //calcolo gia il saldo
              $categoriaMovimentoID = 3;
              $descrizioneEstesa = 'Bonifico in Uscita in favore di ' . $nomeBeneficiario . " \r\n Causale: " . $causale;

              // Execute the statement
              $stmt1->execute();

              // Close the statement
              $stmt1->close();
            } else {
              // Errore nella preparazione dello statement
              echo "Errore nella preparazione dello statement: " . $conn->error;
              // Oppure gestisci l'errore in modo appropriato, ad esempio:
              // die("Errore nella preparazione dello statement: " . $conn->error);
            }
            unset($_SESSION["NameBeneficiary"]);
            unset($_SESSION["IBANBeneficiary"]);
            unset($_SESSION["Amount"]);
            unset($_SESSION["TransferReason"]);
            //messaggio di invio
            $message = "Bank transfer sent successfully.";
            echo "<script>alert('$message'); window.location.href = 'transfer.php';</script>";
            exit;
          }
        } else {
          $message = "Wrong OTP";
          echo "<script>alert('$message');</script>";
        }
      }
    } elseif (isset($_POST['submit']) && $_POST['submit'] === 'no') {
      // L'utente ha premuto "No", reindirizza a personalarea.php
      unset($_SESSION["NameBeneficiary"]);
      unset($_SESSION["IBANBeneficiary"]);
      unset($_SESSION["Amount"]);
      unset($_SESSION["TransferReason"]);
      header("Location: personal_area.php");
      exit();
    }
  } else {
    // I dati non sono disponibili nella sessione
    // Puoi gestire l'errore o effettuare un reindirizzamento
    $message = "Oops! Something went wrong.";
    echo "<script>alert('$message'); window.location.href = 'Transfer.php';</script>";
    exit;
  }
} else {
  // I dati non sono disponibili nella sessione
  // Puoi gestire l'errore o effettuare un reindirizzamento
  session_destroy();
  $message = "Oops! Something went wrong.";
  echo "<script>alert('$message'); window.location.href = 'login.php';</script>";
  exit;
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
  <style>
    .input-small {
      width: 150px;
      text-align: center;
      margin: 0 auto;
    }
  </style>
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
        <div class="card p-4">
          <h2 style="text-align: center;"><strong>WARNING</strong></h2>
          <h5 style="text-align: center;">
            The IBAN entered is not registered in our database, which indicates that the transfer you want
            to perform is
            forensic. Do you want to proceed anyway?<br>
            Disclaimer: We do not assume responsibility for the transaction because it is not possible to
            manage money
            flows to other banks according to our regulations.
          </h5>

          <form action="transferext.php" method="POST">
            <div class="input-group has-validation">
              <input type="text" name="otpcode" class="form-control input-small" id="yourotpcode" required="" placeholder="Insert OTP Code">

              <div class="invalid-feedback">OTP code invalid retry.</div>
            </div>
            <div class="col-md-12 text-center" style="flex: 0 0 100%; max-width: 100%; margin-top: 10px;">
              <button type="submit" name="submit" value="yes"
                style="background-color: #008000; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">YES</button>
              <span style="margin: 0 10px;"></span>
              <button type="submit" name="submit" value="no"
                style="background-color: #CC0000; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">NO</button>
            </div>
            <div class="col-12" style="text-align: center;">
              <!-- <p class="small mb-0">Don't have the OTP code yet? <a href="verifylogin.php">Send another OTP code</a></p> -->
              <p class="small mb-0"><a href="transferext.php?generate_otp=true"></br>Send another OTP code</a></p>
            </div>

          </form>
        </div>
      </div>
    </section>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

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
