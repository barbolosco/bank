<?php
session_start();

// Recupera i dati dalla sessione
if (isset($_SESSION["email"]) && isset($_SESSION["otpValido"]) && isset($_SESSION["contoID"])) {
    $email = $_SESSION["email"];
    $otpValido = $_SESSION["otpValido"];
    $contoCorrenteIDx = $_SESSION["contoID"];

    if ((isset($_SESSION["Amount"])) && (isset($_SESSION["NameBeneficiary"])) && (isset($_SESSION["IBANBeneficiary"])) && (isset($_SESSION["TransferReason"])) && (isset($_SESSION["Cash"]))) {
        $nomeBeneficiario = $_SESSION["NameBeneficiary"];
        $IBANB = $_SESSION["IBANBeneficiary"];
        $cifra = $_SESSION["Amount"];
        $causale = $_SESSION["TransferReason"];
        $saldo = $_SESSION["Cash"];
        $contoCorrenteBeneficiarioID = $_SESSION["contoCorrenteBeneficiarioID"];
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

    // Verifica se il parametro generate_otp è presente nell'URL e impostato su true
    if (isset($_GET['generate_otp']) && $_GET['generate_otp'] === 'true') {
        // Genera un nuovo codice OTP
        $newOTP = generateOTP(); // Sostituisci questa chiamata con la tua funzione di generazione del codice OTP

        // Associa il nuovo codice OTP all'utente
        $_SESSION['otpValido'] = $newOTP; // Salva il nuovo codice OTP nella sessione o nel database, a seconda delle tue esigenze
// Preparazione email con il codice OTP
        $to = $email; //$email
        $subject = 'OTP code for login verification';
        $message = 'Your OTP code is: ' . $newOTP . '<br> Use it to log in within 2 minutes. <br><br> If you did not initiate this login, please notify us immediately so we can resolve it as soon as possible.';
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


    if (isset($_POST['submit'])) {
        if (empty($_POST["otpcode"])) {
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
            //controllo se il codice inserito è uguale a quello inviato
            $otpInserito = $_POST["otpcode"];

            if ($otpInserito === $otpValido) {
                // Il codice OTP inserito è valido
                //Insert transazione
                // Prepare the statement
                $stmt3 = $conn->prepare("INSERT INTO TMovimentiContoCorrente (ContoCorrenteID, Data, Importo, Saldo, CategoriaMovimentoID, DescrizioneEstesa) VALUES (?, ?, ?, ?, ?, ?)");

                // Verifica se la preparazione dello statement è avvenuta con successo
                if ($stmt3) {
                    // Bind the parameters
                    $stmt3->bind_param("isddis", $contoCorrenteID, $data, $importo, $saldo, $categoriaMovimentoID, $descrizioneEstesa);

                    // Set the values of the parameters
                    $contoCorrenteID = $contoCorrenteIDx;
                    $data = date('Y-m-d H:i:s');
                    $importo = $cifra;
                    $saldo = $saldo - $cifra; //calcolo gia il saldo
                    $categoriaMovimentoID = 3;
                    $descrizioneEstesa = 'Outgoing Transfer in favor of' . $nomeBeneficiario . " \r\n Reason: " . $causale;

                    // Execute the statement
                    $stmt3->execute();

                    // Close the statement
                    $stmt3->close();
                } else {
                    // Errore nella preparazione dello statement
                    echo "Errore nella preparazione dello statement: " . $conn->error;
                    // Oppure gestisci l'errore in modo appropriato, ad esempio:
                    // die("Errore nella preparazione dello statement: " . $conn->error);
                }
                //ottengo il nome titolare di chi invia il bonifico
                $sql = "SELECT NomeTitolare FROM TConticorrenti WHERE Email = ?";
                // Preparazione dello statement
                $stmt5 = $conn->prepare($sql);
                if ($stmt5) {
                    // Bind del parametro Email
                    $stmt5->bind_param("s", $email);
                    // Esecuzione dello statement
                    $stmt5->execute();
                    // Ottieni il risultato della query
                    $result = $stmt5->get_result();

                    // Verifica se la query ha restituito dei risultati
                    if ($result->num_rows > 0) {
                        // Ottieni il nome del titolare
                        $row = $result->fetch_assoc();
                        $nomeTitolare = $row['NomeTitolare'];
                    } else {
                        // Nessun risultato trovato
                        echo "No account holder name found for the specified email.";
                    }
                    // Chiusura dello statement
                    $stmt5->close();
                } else {
                    // Errore nella preparazione dello statement
                    echo "Errore nella preparazione dello statement: " . $conn->error;
                }
                //select per ottenere il saldo del beneficiario
                $sqlsb = "SELECT Saldo FROM TMovimentiContoCorrente WHERE ContoCorrenteID = ? ORDER BY MovimentoID DESC LIMIT 1";
                // Preparazione dello statement
                $stmt7 = $conn->prepare($sqlsb);
                if ($stmt7) {
                    // Bind del parametro ContoCorrenteID
                    $stmt7->bind_param("i", $contoCorrenteBeneficiarioID);
                    // Esecuzione dello statement
                    $stmt7->execute();
                    // Ottieni il risultato della query
                    $result = $stmt7->get_result();

                    // Verifica se la query ha restituito dei risultati
                    if ($result->num_rows > 0) {
                        // Ottieni il valore dell'ultimo saldo
                        $row = $result->fetch_assoc();
                        $saldoBeneficiario = $row['Saldo'];
                    } else {
                        echo "No balance found for the specified bank account.";
                    }
                    // Chiusura dello statement
                    $stmt7->close();
                } else {
                    echo "Errore nella preparazione dello statement: " . $conn->error;
                }
                //Insert nel conto corrente beneficiario
                // Prepare the statement
                $stmt4 = $conn->prepare("INSERT INTO TMovimentiContoCorrente (ContoCorrenteID, Data, Importo, Saldo, CategoriaMovimentoID, DescrizioneEstesa) VALUES (?, ?, ?, ?, ?, ?)");

                // Bind the parameters
                $stmt4->bind_param("isddis", $contoCorrenteID, $data, $importo, $saldoBeneficiario, $categoriaMovimentoID, $descrizioneEstesa);

                // Set the values of the parameters
                $contoCorrenteID = $contoCorrenteBeneficiarioID;
                $data = date('Y-m-d H:i:s');
                $importo = $cifra;
                $saldoBeneficiario = $saldoBeneficiario + $cifra; //calcolo gia il saldo
                $categoriaMovimentoID = 2;
                $descrizioneEstesa = 'Incoming Bank Transfer made by ' . $nomeTitolare . " \r\n Reason: " . $causale;

                // Execute the statement
                $stmt4->execute();
                // Close the statement
                $stmt4->close();
                //messaggio di invio
                $message = "Bank transfer sent successfully.";
                echo "<script>alert('$message'); window.location.href = 'Transfer.php';</script>";
                exit;


            } else {
                // Il codice OTP inserito non è valido
                // Esegui le azioni desiderate in caso di codice OTP non valido
                //genero otp
                $message = "Wrong OTP";
                echo "<script>alert('$message');</script>";
            }
        }
    } elseif (isset($_POST['submitno'])) {
        // L'utente ha premuto "No", reindirizza a index.php

        // Elimina i dati dalla sessione (opzionale)
        unset($_SESSION["NameBeneficiary"]);
        unset($_SESSION["IBANBeneficiary"]);
        unset($_SESSION["Amount"]);
        unset($_SESSION["TransferReason"]);
        unset($_SESSION["Cash"]);
        unset($_SESSION["otpValido"]);
        $message = "Operation canceled.";
        echo "<script>alert('$message'); window.location.href = 'index.php';</script>";
        exit;
        $conn->close();
    }

} else {
    session_destroy();
    $message = "Oops, something went wrong.";
    echo "<script>alert('$message'); window.location.href = 'login.php';</script>";
    // I dati non sono disponibili nella sessione
    // Puoi gestire l'errore o effettuare un reindirizzamento
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Verify Transfer</title>



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
                                    <span class="d-none d-lg-block">Verify</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Verify Your Identity</h5>
                                        <p class="text-center small">Enter your OTP code to confirm the transfer</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate action="verifytransfer.php"
                                        method="post">

                                        <div class="col-12">
                                            <label for="yourotpcode" class="form-label">OTP code</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="otpcode" class="form-control" id="yourotpcode"
                                                    required>
                                                <div class="invalid-feedback">OTP code invalid retry.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                name="submit">Confirm</button>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                name="submit">Cancel</button>
                                        </div>


                                        <div class="col-12">
                                            <p class="small mb-0">Don't have the OTP code yet? <a
                                                    href="/php/verifytransfer.php?generate_otp=true">Send
                                                    another OTP code</a></p>
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