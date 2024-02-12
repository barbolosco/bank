<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PswForgotten</title>
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
    <link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet">
    <link href="assets/css/user-registration.css" type="text/css" rel="stylesheet">
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
                                <a href="http://ccgroup3.altervista.org/index.php"
                                    class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Home</span>
                                </a>
                            </div><!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Retrieve your password</h5>
                                        <p class="text-center small">Enter your email to change your password</p>
                                    </div>
                                    <form name="login" action="" method="post" onsubmit="return loginValidation()"
                                        class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="email" class="form-control" id="yourUsername"
                                                    required>
                                                <div class="invalid-feedback">Please enter a valid email address.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                name="forgot-btn">Send</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have an account? <a href="register.php">Create
                                                    an account</a></p>
                                        </div>
                                        <?php
                                        if (!empty($_POST["email"])) {

                                            // Informazioni del database
                                            $hostname = "localhost";
                                            $username = "ccgroup3";
                                            $password = "f2b5rfFQhhgA";
                                            $database = "my_ccgroup3";

                                            // Connessione al database
                                            $conn = mysqli_connect($hostname, $username, $password, $database);

                                            // Verifica se la form di recupero password è stata inviata
                                            if (isset($_POST['forgot-btn'])) {
                                                // Recupera l'indirizzo email fornito dall'utente
                                                $email = $_POST['email'];

                                                // Verifica se l'utente esiste nel database utilizzando un prepared statement
                                                $query = "SELECT Password FROM TConticorrenti WHERE Email = ?";
                                                $stmt = mysqli_prepare($conn, $query);
                                                mysqli_stmt_bind_param($stmt, "s", $email);
                                                mysqli_stmt_execute($stmt);
                                                $result = mysqli_stmt_get_result($stmt);

                                                if (mysqli_num_rows($result) == 1) {
                                                    // Genera una nuova password casuale
                                                    $password = generateRandomPassword();
                                                    // Hasho la password
                                                    $salt = "ccgroup3bank";
                                                    $newPassword = crypt($password, $salt);


                                                    // Aggiorna la password nel database utilizzando un prepared statement
                                                    $updateQuery = "UPDATE TConticorrenti SET password = ? WHERE Email = ?";
                                                    $stmt = mysqli_prepare($conn, $updateQuery);
                                                    mysqli_stmt_bind_param($stmt, "ss", $newPassword, $email);
                                                    mysqli_stmt_execute($stmt);

                                                    $to = $email;
                                                    $subject = 'Reset password';
                                                    $message = 'Your new password is: '.$password.'\r\n If you did not initiate this login, please notify us immediately so we can resolve it as soon as possible.';
                                                    $message = wordwrap($message, 210);
                                                    $headers = "From: ccgruppo3@gmail.com";
                                                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                                                    if (mail($to, $subject, $message, $headers)) {
                                                        $message = "Email with the new password successfully sent to: " . $to;
                                                        echo "<script type='text/javascript'>alert('$message'); window.location.href = 'login.php';</script>";
                                                    } else {
                                                        $message = "Error during email sending";
                                                        echo "<script type='text/javascript'>alert('$message'); window.location.href = 'login.php';</script>";
                                                        exit;
                                                    }
                                                }
                                            } else {
                                                echo "L'indirizzo email fornito non esiste nel database.";
                                            }
                                        }

                                        function generateRandomPassword()
                                        {
                                            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                                            $password = '';

                                            for ($i = 0; $i < 8; $i++) {
                                                $index = rand(0, strlen($characters) - 1);
                                                $password .= $characters[$index];
                                            }

                                            return $password;
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                            <div class="credits"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->
    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
    <script>
        function loginValidation() {
            var emailInput = document.getElementById("yourUsername");
            var email = emailInput.value.trim();

            // Validate email format
            var emailRegex = "/^\S+@\S+\.\S+$/";
            if (!emailRegex.test(email)) {
                emailInput.classList.add("is-invalid");
                emailInput.nextElementSibling.style.display = "block";
                return false;
            }

            // Remove validation errors if any
            emailInput.classList.remove("is-invalid");
            emailInput.nextElementSibling.style.display = "none";

            return true;
        }
    </script>

</body>

</html>
