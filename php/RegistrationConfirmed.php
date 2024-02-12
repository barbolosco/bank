<?php
session_start();
ini_set('session.gc_maxlifetime', 1800);

// Check session expiration
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // Session expired, destroy session and redirect to login page
    session_unset();
    session_destroy();
    header("Location: /index.php");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

if (!isset($_SESSION['started'])) {
    $_SESSION['started'] = date('Y-m-d');
}

if (!isset($_SESSION['email']) || !isset($_SESSION['token'])) {
    header("Location: /index.php");
    exit();
}

$email = $_SESSION['email'];
$tokensession = $_SESSION['token'];


//send the email
$to = $email; //$email
$subject = 'Token for registration verification';
$message = 'Your token is: ' . $tokensession . '<br> Use it to register within 2 minutes. <br><br> If you did not initiate this login, please notify us immediately so we can resolve it as soon as possible.';
$message = wordwrap($message, 950);
$headers = "From: ccgruppo3@gmail.com\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Invia l'email
if (mail($to, $subject, $message, $headers)) {
    $message = "Email successfully sent to: " . $to;
    echo "<script type='text/javascript'>alert('$message');</script>";
} else {
    $message = "Error during email sending";
    echo "<script type='text/javascript'>alert('$message'); window.location.href = 'login.php';</script>";
    exit;
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
// Preparazione email con il token



if (isset($_POST['submit'])) {

    $tokenpost = $_POST["token"];
    // Esecuzione della query per verificare se il token corrisponde all'email nel database
    $sqij = $conn->prepare("SELECT Token FROM TConticorrenti WHERE Email = ?");
    $sqij->bind_param("s", $email);
    $sqij->execute();
    if ($sqij->error) {
        echo "Error during query execution: " . $sqij->error;
        session_unset();
        session_destroy();
        exit();
    }
    $result = $sqij->get_result();

    // Verifica se l'email corrisponde al token nel database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbToken = $row['Token'];
        if (($tokensession === $tokenpost) && ($dbToken === $tokenpost)) {
            // Token corretto, procedi alla pagina di login

            /**
             * Dopo aver confermato la registrazione inserire in automatico
             * nel relativo conto corrente un movimento di apertura con tutti gli importi a zero
             */
            $registrazioneConfermata = 1;
            $accountId = $email;
            $data = date('Y-m-d');
            $importo = 0;
            $saldo = 0;
            $descrizione = "Opening a current account";
            $categoriaMovimentoId = 1;

            $sql = "UPDATE TConticorrenti
                    SET RegistrazioneConfermata = 1
                    WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            if ($stmt->error) {
                echo "Error during query execution: " . $stmt->error;
                session_unset();
                session_destroy();
                exit();
            }

            $sql2 = "INSERT INTO TMovimentiContoCorrente (ContoCorrenteID, Data, Importo, Saldo, CategoriaMovimentoID, DescrizioneEstesa)
            SELECT TConticorrenti.ContoCorrenteID, ?, ?, ?, ?, ?
            FROM TConticorrenti
            WHERE TConticorrenti.Email = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("sddisi", $data, $importo, $saldo, $categoriaMovimentoId, $descrizione, $accountId);
            $stmt2->execute();
            if ($stmt2->error) {
                echo "Error during query execution: " . $stmt2->error;
                session_unset();
                session_destroy();
                exit();
            }

            echo "insert eseguito con successo.";
            //IBAN CREATION
            $iban = generateIBAN();
            //invio email con iban
            echo "iban generato";
            $to = $email; //$email
            $subject = 'Iban for registration verification';
            $message = 'Your Iban code is: ' . $iban . '<br> Here is your IBAN. <br><br> Have a nice journey with us.';
            $message = wordwrap($message, 950);
            $headers = "From: ccgruppo3@gmail.com\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";



            //Update iBAN
            $sql3 = "UPDATE TConticorrenti SET IBAN = ?
            WHERE Email = ?";


            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("ss", $iban, $email);
            $stmt3->execute();
            if ($stmt3->error) {
                echo "Error during query execution: " . $stmt3->error;
                session_unset();
                session_destroy();
                header("Location: /index.php");
                exit();
            }
          
            //email
            session_destroy();
            header("Location: login.php");
            exit();
       
       } 
      }
        
    

    $sqij->close();

    // Token non corretto, distruggi la sessione e reindirizza all'index
    session_unset();
    session_destroy();
    header("Location: /index.php");
    exit();
}
?>


<?php
function generateIBAN()
{
    // Definizione delle lettere associate ai numeri del codice IBAN
    $lettereNumeri = array(
        'A' => 10,
        'B' => 11,
        'C' => 12,
        'D' => 13,
        'E' => 14,
        'F' => 15,
        'G' => 16,
        'H' => 17,
        'I' => 18,
        'J' => 19,
        'K' => 20,
        'L' => 21,
        'M' => 22,
        'N' => 23,
        'O' => 24,
        'P' => 25,
        'Q' => 26,
        'R' => 27,
        'S' => 28,
        'T' => 29,
        'U' => 30,
        'V' => 31,
        'W' => 32,
        'X' => 33,
        'Y' => 34,
        'Z' => 35
    );

    // Generazione dei primi 10 caratteri casuali
    $primaParte = "";
    for ($i = 0; $i < 5; $i++) {
        $primaParte .= chr(rand(65, 90)); // Caratteri maiuscoli ASCII
    }

    // Generazione dei numeri casuali
    $secondaParte = "";
    for ($i = 0; $i < 12; $i++) {
        $secondaParte .= rand(0, 9);
    }

    // Calcolo del valore numerico del codice IBAN
    $codice = $secondaParte . $primaParte . '00';
    $valoreNumerico = "";
    foreach (str_split($codice) as $carattere) {
        if (is_numeric($carattere)) {
            $valoreNumerico .= $carattere;
        } else {
            $valoreNumerico .= $lettereNumeri[$carattere];
        }
    }

    // Calcolo del resto
    $resto = bcmod($valoreNumerico, '97');
    $controllo = str_pad(98 - $resto, 2, '0', STR_PAD_LEFT);

    // Costruzione dell'IBAN completo
    $iban = "IT" . $controllo . $primaParte . $secondaParte;

    return $iban;
}
?>

<?php

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

  <title>Verify Access</title>
 
  
  
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
function TokenCheck(){
    TokenString=FormToken.yourtoken.value;
    
    
    
    if(TokenString=="" ){
        alert("devi inserire i dati di registrazione");
        
        return;
    }


    FormToken.submit();
    
}
</script>
<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Home</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Verify Your Identity</h5>
                    <p class="text-center small">Enter your Token to login</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate action="" name="FormToken" method="post">

                    <div class="col-12">
                      <label for="yourtoken" class="form-label">Token</label>
                      <div class="input-group has-validation">
                        <input type="text" name="token" class="form-control" id="yourtoken" required>
                        <div class="invalid-feedback">Token invalid retry.</div>
                      </div>
                    </div>


                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="submit" value ="tokencheck" onclick="TokenCheck()">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have the Token yet? <a href="RegistrationConfirmed.php?generate_token=true">Send another Token</a></p>
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
	
</body>

</html>
