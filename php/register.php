<?php

session_start();
ini_set('session.gc_maxlifetime', 1800);

// Check session expiration
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // Session expired, destroy session and redirect to login page
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

if (!isset($_SESSION['started'])) {
    $_SESSION['started'] = date('Y-m-d');
}

if (isset($_SESSION['email'])) {
    header("Location: verifylogin.php");
    exit();
}

$servername = "localhost"; // Nome del server
$username = "ccgroup3"; // Nome utente del database
$password = ""; // Password del database
$dbname = "my_ccgroup3"; // Nome del database

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

//L'utente preme invio
if (isset($_POST['submit'])) {
    $nome = $_POST['name'];
    $cognome = $_POST['surname'];
    $numerotelefono = $_POST['phoneNumber'];
    $email = $_POST['username'];
    $password = $_POST['password'];
    $confermapassword = $_POST['confirmpassword'];
    $DataApertura = date('Y-m-d');

    // Esecuzione della query per verificare se l'email è già presente nel database
    $sqij = $conn->prepare("SELECT Email FROM TConticorrenti WHERE Email = ?");
    $sqij->bind_param("s", $email);
    $sqij->execute();
    $result = $sqij->get_result();

    // Verifica se l'email corrispondente esiste nel database
    if ($result->num_rows > 0) {
        // L'email corrispondente esiste nel database
        //echo "L'email inserita è già presente nel database.";

        $message = "Email already in the system";
        session_destroy();
        echo "<script type='text/javascript'>alert(" . $message . "); window.location.href = 'login.php';</script>";

        exit;
    } else {
        // L'email corrispondente non esiste nel database
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Filtri personalizzati per controllare se la mail può essere valida
            if (preg_match('/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/', $email)) {
                echo "L'indirizzo email è valido.";
            } else {
                echo "L'indirizzo email non è valido.";
            }
        } else {
            echo "L'indirizzo email non è valido.";
        }
        if ($password === $confermapassword) {
            // Hasho la password
            $salt = "ccgroup3bank";
            $passwordCriptata = crypt($password, $salt);

            // Generazione del token
            $token = generateToken();

            // Preparazione dell'istruzione di inserimento
            $sqij = $conn->prepare("INSERT INTO TConticorrenti (NomeTitolare, CognomeTitolare, NumeroTelefono, Email, Password, Token, DataApertura) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $sqij->bind_param("sssssss", $nome, $cognome, $numerotelefono, $email, $passwordCriptata, $token, $DataApertura);

            if ($sqij->execute()) {
                echo "Record inserito con successo.";
                $_SESSION['email'] = $email; // Set the email in the session
                $_SESSION['token'] = $token; // Set the token in the session

                //send the email to the user that need to verify the registration.
                header("Location: RegistrationConfirmed.php"); // Redirect to verification page
                exit();
            } else {
                echo "Errore durante l'inserimento del record: " . $sqij->error;
            }
        } else {
            echo "La password non corrisponde alla conferma password.";
        }
    }
    $sqij->close();
}


// Chiusura della connessione
$conn->close();

// Function to generate a random token
function generateToken()
{
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $token;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register</title>
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

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="/index.php"
                                    class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Register</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate action="" name="FormRegistrazione"
                                        method="post">
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Your Name</label>
                                            <input type="text" name="name" class="form-control" id="yourName" required>
                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourSurame" class="form-label">Your Surname</label>
                                            <input type="text" name="surname" class="form-control" id="yourSurame"
                                                required>
                                            <div class="invalid-feedback">Please, enter your surname!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="username" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Per favore inserisci la tua Email.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPhoneNumber" class="form-label">Phone number</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text">+39</span>
                                                <input type="text" name="phoneNumber" class="form-control"
                                                    id="yourPhoneNumber">
                                                <div class="invalid-feedback">Please insert your phone number.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourConfirmPassword" class="form-label">Confirm password</label>
                                            <input type="password" name="confirmpassword" class="form-control"
                                                id="yourConfirmPassword" required>
                                            <div class="invalid-feedback">Please enter again your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="g-recaptcha"
                                                data-sitekey="6Lfr53MmAAAAAAd2YM1F2gEz49g_kw9VaWIV-YL0"></div><br>
                                            <button class="btn btn-primary w-100" type="submit" name="submit"
                                                value="registrati" onclick="Registrazione()">Create Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a
                                                    href="/php/login.php">Log in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">

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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!--Controllo Required -->

    <!-- Controllo password uguali -->

    <script src="https://www.google.com/recaptcha/api.js?hl=it" async="" defer=""></script>


</body>

</html>