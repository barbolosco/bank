<?php
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


if (!isset($_SESSION['started'])) {
    $_SESSION['started'] = date('Y-m-d');
}

if (!isset($_SESSION['address'])) {
    $_SESSION['address'] = $_SERVER['REMOTE_ADDR'];
}

if (isset($_SESSION['email'])) {
    header("Location: verifylogin.php");
}

$ipAddress = $_SESSION['address'];
//$ipAddress = "192.168.0.16";
$datestart = $_SESSION['started'];
// Assuming you have a database connection, replace the placeholders with your actual code
$hostname = "localhost:3306";
$username = "admin";
$password = "admin";
$database = "ccgroup3";

// Create a database connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Esegui la query preparata per controllare se l'indirizzo IP è blacklistato
$query = "SELECT * FROM TIndirizziIp WHERE IndirizzoIp = ? AND IsBlackListed = 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $ipAddress);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se l'indirizzo IP è blacklistato
if ($result->num_rows > 0) {
    // Indirizzo IP blacklistato
    //echo "Il tuo indirizzo IP è stato bloccato. Contatta l'amministratore del sito per sbloccarlo.";

    // Invia un'email all'utente
    $to = $email;
    $subject = 'Avviso di blocco IP';
    $message = 'Il tuo indirizzo IP è stato bloccato sul nostro sito. Per sbloccarlo, visita la seguente pagina: <a href="http://ccgroup3.altervista.org/php/faq.php">Sblocca il mio IP</a>';
    $message = wordwrap($message, 200);
    $headers = "From: ccgruppo3@gmail.com\r\n";
    $headers = "Content-Type: text/html; charset=UTF-8\r\n";

    // Invia l'email
    mail($to, $subject, $message, $headers);
    mysqli_stmt_close($stmt);
    session_destroy();
    $message = "Your IP is blocked!";
    echo "<script>alert('$message'); window.location.href = '/index.php';</script>";
    exit;
} else {
    mysqli_stmt_close($stmt);

    //Quando è stato premuto login
    if (isset($_POST["submit"])) {
        // Check if the fields are blank
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            echo "<script>alert('Please fill in all fields.');</script>";
        } else {
            // Verify reCAPTCHA response
            $captcha = $_POST['g-recaptcha-response'];
            $secret_key = '6Lfr53MmAAAAAM0WV4F3XYNiLML4qYx3osRJ2LWd';
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = array(
                'secret' => $secret_key,
                'response' => $captcha,
                'remoteip' => $ipAddress
            );
            $options = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($data)
                )
            );
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $response = json_decode($result);
            if ($response->success == true) {
                //Captcha Validification correct
                // Prepara la query per controllare se l'email è presente nel database
                $email = $_POST["email"];
                $query = "SELECT Email FROM TConticorrenti WHERE Email = ? AND RegistrazioneConfermata = 1";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);

                // Esegui lo statement
                mysqli_stmt_execute($stmt);

                // Ottieni il risultato dello statement
                $result = mysqli_stmt_get_result($stmt);

                // Controlla se la query ha restituito risultati
                if (mysqli_num_rows($result) > 0) {
                    // L'email è presente nel database
                    //Hash password
                    $passwordInserita = $_POST["password"];
                    $salt="ccgroup3bank";
                    $passwordInserita = crypt($passwordInserita,$salt);
                    //prendo la password 
                    $sql = "SELECT Password, ContoCorrenteID FROM TConticorrenti WHERE Email = ?";
                    $stmt2 = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt2, "s", $email);
                    mysqli_stmt_execute($stmt2);
                    $result = mysqli_stmt_get_result($stmt2);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        // echo "row".$row;
                        $passwordCriptata = $row['Password'];
                        $ccID = $row['ContoCorrenteID'];
                        if ($passwordCriptata === $passwordInserita) {
                            echo "<script type='text/javascript'>alert('Logged in successfully.');</script>";
                            // Prepara la query di aggiornamento
                            $query = "INSERT INTO TIndirizziIp (IndirizzoIp, DataOraAccesso, IsBlackListed, ContoCorrenteID, GuaranteedAccess)
                  VALUES (?, ?, ?, ?, ?)";

                            $stmt3 = mysqli_prepare($conn, $query);
                            if ($stmt3) {
                                $indirizzoIp = $ipAddress;
                                $dataOraAccesso = date('Y-m-d H:i:s');
                                $isBlackListed = 0;
                                $contoCorrenteID = $ccID; //
                                $guaranteedAccess = 1;

                                mysqli_stmt_bind_param($stmt3, "ssiii", $indirizzoIp, $dataOraAccesso, $isBlackListed, $contoCorrenteID, $guaranteedAccess);

                                if (mysqli_stmt_execute($stmt3)) {
                                    //echo "Inserimento riuscito.";
                                    mysqli_stmt_close($stmt3);
                                } else {
                                    echo "Errore duraning the insert: " . mysqli_stmt_error($stmt3);
                                }

                            } else {
                                echo "Error in the statement preparation: " . mysqli_error($conn);
                            }
                            //creazione otp e invio email
                            $otpValido = generateOTP();

                            // Preparazione email con il codice OTP
                            $to = $email; //$email
                            $subject = 'OTP code for login verification';
                            $message = 'Your OTP code is: ' . $otpValido . '<br> Use it to log in within 2 minutes. <br><br> If you did not initiate this login, please notify us immediately so we can resolve it as soon as possible.';
                            $message = wordwrap($message, 950);
                            $headers = "From: ccgruppo3@gmail.com\r\n";
                            $headers = "Content-Type: text/html; charset=UTF-8\r\n";

                            // Invia l'email
                            if (mail($to, $subject, $message, $headers)) {
                                $message = "Email successfully sent to: " . $to;
                                echo "<script type='text/javascript'>alert(" . $message . ");</script>";
                            } else {
                                $message = "Error during email sending";
                                echo "<script type='text/javascript'>alert(" . $message . "); window.location.href = 'login.php';</script>";
                                exit;
                            }
                            //inizio sessione con la e-mail
                            $_SESSION["email"] = $email;
                            $_SESSION['otpValido'] = $otpValido;
                            header("Location: verifylogin.php");
                            exit;

                        } else {

                            // Prepara la query di aggiornamento
                            $query = "INSERT INTO TIndirizziIp (IndirizzoIp, DataOraAccesso, IsBlackListed, ContoCorrenteID, GuaranteedAccess)
                      VALUES (?, ?, ?, ?, ?)";

                            $stmt4 = mysqli_prepare($conn, $query);
                            if ($stmt4) {
                                $indirizzoIp = $ipAddress;
                                $dataOraAccesso = date('Y-m-d H:i:s');
                                $isBlackListed = 0;
                                $contoCorrenteID = $ccID;
                                $guaranteedAccess = 0;

                                mysqli_stmt_bind_param($stmt4, "ssiii", $indirizzoIp, $dataOraAccesso, $isBlackListed, $contoCorrenteID, $guaranteedAccess);

                                if (mysqli_stmt_execute($stmt4)) {
                                    //echo "Inserimento riuscito.";
                                    mysqli_stmt_close($stmt4);
                                } else {
                                    echo "Error entering: " . mysqli_stmt_error($stmt4);
                                }

                            } else {
                                echo "IndirizzoIp Error in statement preparation: " . mysqli_error($conn);
                            }
                            //Controllo quante volte è stato fatto l'accesso 
                            //<3 riprova password  
                            //=3 timeout di 1 minuto 
                            //>3 blacklistato
                            $strSQLCounter = "SELECT * FROM `TIndirizziIp` WHERE `IndirizzoIp`=? AND `DataOraAccesso`>? ORDER BY `DataOraAccesso` DESC";
                            $stmt5 = $conn->prepare($strSQLCounter);
                            $stmt5->bind_param("ss", $indirizzoIp, $datestart);
                            $stmt5->execute();
                            $result5 = $stmt5->get_result();

                            $rowcount = $result5->num_rows;
                            // echo "rowcount".$rowcount;
                            if ($rowcount < 3) {
                                $message = "Wrong Password. Please try again.";
                                echo "<script type='text/javascript'>alert('$message');</script>";
                            } else if ($rowcount == 3) {
                                $message = "Wrong Password. Please try again."; //calcolare tempo 1 minuto timeout
                                echo "<script type='text/javascript'>alert('$message');</script>";
                                echo "<script type='text/javascript'>window.location.href ='blocked.php' </script>";
                            } else {
                                $first = $result5->fetch_assoc(); //l'ultimo inserimento perche bisogna updatare il 1 
                                $id = $first["IDIp"];
                                $strSQLBlacklist = "UPDATE `TIndirizziIp` SET `IsBlackListed` = 1 WHERE `IDIp`=?";

                                $stmt6 = $conn->prepare($strSQLBlacklist);
                                $stmt6->bind_param("s", $id);
                                $stmt6->execute();

                                session_destroy();
                                $message = "Your IP is blocked!";
                                echo "<script type='text/javascript'>alert('$message'); window.location.href = '/index.php';</script>";
                                exit;
                            }
                        }
                    }
                } else {
                    // L'email non è presente nel database
                    $message = "The email doesn't exist. You need to register on the registration page.";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    session_destroy();
                    header("Location: /index.php");
                }
                // Close the result set
                mysqli_stmt_close($stmt);
                mysqli_stmt_close($stmt2);

            } else {
                // reCAPTCHA validation failed
                echo "<script type='text/javascript'>alert('reCAPTCHA validation failed.');</script>";
            }
        }
        // Close the database connection
        mysqli_close($conn);
    }

}

session_destroy();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>



<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
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

  <script src="https://www.google.com/recaptcha/api.js"></script>
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

<body class="vsc-initialized" data-new-gr-c-s-check-loaded="14.1111.0" data-gr-ext-installed="">
<script>
  timerAcceso = true;
  // Function to clear the page
  function clearPage() {
    location.reload();
  }

  // Countdown function
  function countdown() {
    var seconds = 30;
    var countdownElement = document.getElementById('countdown');
    var timer = setInterval(function () {
      if (timerAcceso) {
        seconds--;
        countdownElement.textContent = seconds;
        if (seconds <= 0) {
          clearInterval(timer);
          countdownElement.textContent = '0';
          clearPage(); // Call the clearPage function
        }
      }


    }, 1000); // 1000 milliseconds = 1 second
  }
  window.onload = countdown;


  function timercheck() {



    function stopTimer() {
      clearInterval(timer);
    }

    function startTimer() {
      timer = setInterval(function () {
        window.location.reload();
      }, 30000);
    }

    // Start the 30-second timer when the page loads
    startTimer();

    // When the user clicks the login button, increment the login attempt counter
    var loginAttempts = 0;
    document.getElementsByName("submit").addEventListener("click", function () {
      loginAttempts++;
      if (loginAttempts >= 3) {
        // Stop the timer and display an alert box that lasts for 60 seconds
        stopTimer();

        var alertTimer = setTimeout(function () {
          alert("Blocked! Wait 60 sec");
          startTimer();
        }, 60000);
      }
    });

  }

</script>




<script>
  function Login() {
    EmailInsertString = FormRegistrazione.textEmailInsert.value;

    PasswordInsertString = FormRegistrazione.textPasswordInsert.value;

    if (EmailInsertString == "" || PasswordInsertString == "") {
      alert("Please enter your registration data.");
      return;
    }


    FormLogin.submit();

  }
</script>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Login</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your Email &amp; password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate="" action="login.php" name="FormLogin" method="post">

                    <div class="col-12">
                      <label for="textEmailInsert" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control" id="textEmailInsert" required="">
                        <div class="invalid-feedback">Please enter your Email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="textPasswordInsert" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="textPasswordInsert" required="">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <!-- capthca here -->
                      <div class="g-recaptcha" name="g-recaptcha"
                        data-sitekey="6Lfr53MmAAAAAAd2YM1F2gEz49g_kw9VaWIV-YL0"></div><br>
                      <button class="btn btn-primary w-100" type="submit" value="login" onclick="Login()"
                        name="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="register.php">Create an account</a></p>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">Password Forgotten? <a href="/php/password-forgotten.php">Click here</a></p>
                      <p>La pagina si pulira tra: <span id="countdown">30</span> secondi.</p>
                    </div>


                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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




</body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>
