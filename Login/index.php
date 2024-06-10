<?php session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../");
    exit;
}
include_once ('../modules/dbConfig.php');

$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter Username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your Password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT ID, UserName, Password, CircleCode, IsAdmin FROM users WHERE UserName = ?";

        if ($stmt = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $circle, $isAdmin);

                    if (mysqli_stmt_fetch($stmt)) {

                        if (password_verify($password, $hashed_password)) {
                            // if (strcmp($password, $hashed_password) == 0) {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;
                            $_SESSION["circle"] = $circle;
                            $_SESSION["isAdmin"] = $isAdmin;
                            header("location: ../");
                        } else {
                            $login_err = "Invalid Password.";
                        }
                    }
                } else {
                    $login_err = "User doesn't Exist.";
                }
            } else {
                echo "Oops! Something went Wrong. Please Try again Later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../JS/colorToggle.js"></script>
    <title>User Sign-In</title>
    <link rel="icon" type="image/png" sizes="64x64"
        href="https://img.icons8.com/external-yogi-aprelliyanto-outline-color-yogi-aprelliyanto/64/000000/external-login-website-development-yogi-aprelliyanto-outline-color-yogi-aprelliyanto.png">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link href="../Bootstrap/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="../style2.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body class="d-flex align-items-center py-4">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script> -->
    <script src="../Bootstrap/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <?php include ('../modules/colorToggle.php'); ?>

    <main class="form-signin m-auto">

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <img class="mb-4" src="../Reliance_Jio_Logo.svg" alt="" width="64" height="64">
            <h1 class="h3 mb-3 fw-normal">Sign In</h1>

            <div class="form-floating mb-1">
                <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                    name="username" id="floatingInput" value="<?php echo $username; ?>"
                    placeholder="firstname.lastname">
                <label for="floatingInput">User ID</label>
                <span class="invalid-feedback">
                    <?php echo $username_err; ?>
                </span>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                    name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <span class="invalid-feedback">
                    <?php echo $password_err; ?>
                </span>
            </div>
            <!-- <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div> -->
            <div class="d-flex my-3">
                <button class="btn btn-primary w-50 me-1" type="submit" value="Login">Sign In <i
                        class="bi bi-box-arrow-in-right"></i></button>
                <!-- <button class="btn btn-danger w-50" type="reset" value="Reset">Reset</button> -->
            </div>
            <!-- <p>New Users <a class="badge text-bg-info link-underline link-underline-opacity-0"
                    href="../Register/">Register Here</a></p> -->
            <p class="mt-5 mb-3 text-body-secondary"><i class="bi bi-c-circle"></i> 19xx–2024</p>
        </form>
    </main>
</body>

</html>