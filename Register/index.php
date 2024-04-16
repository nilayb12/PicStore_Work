<?php include_once ('../modules/dbConfig.php');

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please Enter a Username.";
    } elseif (!preg_match('/^[a-zA-Z0-9._]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain Letters (A-Z, a-z), Numbers (0-9), and Dot (.)";
    } else {
        $sql = "SELECT ID FROM users WHERE UserName = ?";

        if ($stmt = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This Username already Exists.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went Wrong. Please Try Again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please Enter a Password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have Atleast 8 Characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please Confirm Password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password doesn't match.";
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        $sql = "INSERT INTO users (UserName, Password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                header("location: ../Login/");
            } else {
                echo "Oops! Something went Wrong. Please Try Again later.";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="../style2.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body class="d-flex align-items-center py-4">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <?php include ('../modules/colorToggle.php'); ?>

    <main class="form-signin w-100 m-auto">
        <h1 class="h3 mb-3 fw-normal">Create Account</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-floating mb-1">
                <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                    name="username" id="floatingInput" value="<?php echo $username; ?>"
                    placeholder="firstname.lastname">
                <label for="floatingInput">User ID</label>
                <span class="invalid-feedback">
                    <?php echo $username_err; ?>
                </span>
            </div>
            <div class="form-floating mb-1">
                <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                    name="password" id="floatingPassword" value="<?php echo $password; ?>" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <span class="invalid-feedback">
                    <?php echo $password_err; ?>
                </span>
            </div>
            <div class="form-floating">
                <input type="password"
                    class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                    name="confirm_password" id="floatingConfirmPass" value="<?php echo $confirm_password; ?>"
                    placeholder="Re-Enter Password">
                <label for="floatingConfirmPass">Confirm Password</label>
                <span class="invalid-feedback">
                    <?php echo $confirm_password_err; ?>
                </span>
            </div>
            <div class="d-flex my-3">
                <button class="btn btn-primary w-50 me-1" type="submit" value="Register">Register</button>
                <button class="btn btn-danger w-50" type="reset" value="Reset">Reset</button>
            </div>
            <p>Already have an account? <a class="badge text-bg-info" href="../Login/">Login Instead</a></p>
        </form>
    </main>
</body>

</html>