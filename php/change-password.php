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

if (!isset($_SESSION['email'])) {
	session_destroy();
    header("Location: /index.php");
    exit();
}

$email = $_SESSION['email'];

if (isset($_POST["submit"])) {
    // Check if the fields are blank
    if ((empty($_POST["oldpassword"])) || (empty($_POST["newpassword"])) || (empty($_POST["confirmpassword"]))) {
      echo "<script>alert('Please fill in all fields.');</script>";
    } elseif(($_POST["newpassword"]) != ($_POST["confirmpassword"])) { 
        echo "<script>alert('Password has not matched.');</script>";
    }else {
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
        $query = "SELECT Password FROM TConticorrenti WHERE Email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);

        // Esegui lo statement
        mysqli_stmt_execute($stmt);

        // Ottieni il risultato dello statement
        $result = mysqli_stmt_get_result($stmt);

        // Controlla se la query ha restituito risultati
        if (mysqli_num_rows($result) == 1 ) {
          // La password è presente nel database
          $oldpassword = $_POST["oldpassword"];
          $confirmpassword = $_POST["confirmpassword"];
          //Hash password
          $salt="ccgroup3bank";
          $passwordInserita = crypt($oldpassword,$salt);
          //prendo la password 
          $sql = "SELECT Password FROM TConticorrenti WHERE Email = ?";
          $stmt2 = mysqli_prepare($conn, $sql);
          mysqli_stmt_bind_param($stmt2, "s", $email);
          mysqli_stmt_execute($stmt2);
          $result = mysqli_stmt_get_result($stmt2);
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // echo "row".$row;
            $passwordCriptata = $row['Password'];
            if ($passwordCriptata === $passwordInserita) {
                $passwordCriptata = crypt($newpassword,$salt);
                $updateSql = "UPDATE TConticorrenti SET Password = ? WHERE Email = ?";

                // Prepare the statement
                $stmt = $conn->prepare($updateSql);
            
                if ($stmt) {
                    // Bind the parameters
                    $stmt->bind_param("ss", $passwordCriptata, $email);
            
                    // Execute the statement
                    if ($stmt->execute()) {
                        echo "Password updated successfully.";
                    } else {
                        echo "Error updating password: " . $stmt->error;
                    }
            
                    // Close the statement
                    $stmt->close();
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
              echo "<script type='text/javascript'>alert('Password Changed');  window.location.href = 'logout.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Password not correct');</script>";
            }
        }
    // Close the database connection
    mysqli_close($conn);
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Change Password</title>
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

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/php/personal_area.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Change Password</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Change your password</h5>
                    <p class="text-center small">Enter your old and new password</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate="" action="change-password.php" method="post">

                  <div class="col-12">
                      <label for="yourOldPassword" class="form-label">Old Password</label>
                      <input type="password" name="oldpassword" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your Old password!</div>
                  </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">New Password</label>
                      <input type="password" name="newpassword" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourConfirmPassword" class="form-label">Confirm New password</label>
                      <input type="password" name="confirmpassword" class="form-control" id="yourConfirmPassword" required>
                      <div class="invalid-feedback">Please enter again your password!</div>
                    </div>
                    
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="submit">Confirm</button>
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
