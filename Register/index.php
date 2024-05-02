<?php include_once ('../modules/dbConfig.php');

$email = $username = $password = $confirm_password = $phone_no = $circle = "";
$email_err = $username_err = $password_err = $confirm_password_err = $phone_no_err = $circle_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --------------Email Validation
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please Enter your Email Address.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+\.[a-zA-Z]+@[a-zA-Z]+\.[a-z]+$/', trim($_POST["email"]))) {
        $email_err = "Email Address Format: [User ID]@ril.com";
    } else {
        $sql = "SELECT ID FROM users WHERE Email = ?";

        if ($stmt = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = trim($_POST["email"]);

            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This Email already Exists.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went Wrong. Please Try Again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    // --------------Username Validation
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please Enter a Username.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+\.[a-zA-Z]+$/', trim($_POST["username"]))) {
        $username_err = "Username Format: [FirstName].[LastName][Number]";
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

    // --------------Password Validation
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please Enter a Password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have Atleast 8 Characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // --------------Confirm Password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please Confirm Password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password doesn't Match.";
        }
    }

    // --------------Phone Number Validation
    if (empty(trim($_POST["phone_no"]))) {
        $phone_no_err = "Please Enter your Phone Number.";
    } elseif (strlen(trim($_POST["phone_no"])) < 10) {
        $phone_no_err = "Phone Number must have 10 Digits.";
    } else {
        $phone_no = trim($_POST["phone_no"]);
    }

    // --------------Circle Validation
    if (empty(trim($_POST["circle"]))) {
        $circle_err = "Please Select your Circle.";
    } else {
        $circle = trim($_POST["circle"]);
    }

    // --------------Insert Values to DB
    if (
        empty($email_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)
        && empty($phone_no_err) && empty($circle_err)
    ) {

        $sql = "INSERT INTO users (UserName, Email, Password, PhoneNo, CircleCode) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssis", $param_username, $param_email, $param_password, $param_phone_no, $param_circle);

            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_phone_no = $phone_no;
            $param_circle = $circle;

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
    <title>User Registration</title>
    <link rel="icon" type="image/png" sizes="64x64"
        href="https://img.icons8.com/external-yogi-aprelliyanto-outline-color-yogi-aprelliyanto/64/000000/external-login-website-development-yogi-aprelliyanto-outline-color-yogi-aprelliyanto.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="../style2.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body class="d-flex align-items-center py-4">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../JS/bootstrap-select(v1.14.0-gamma1).js"></script>
    <?php include ('../modules/colorToggle.php');
    include ('confirmRegister.php'); ?>

    <main class="form-signin m-auto">
        <img class="mb-4" src="https://upload.wikimedia.org/wikipedia/commons/b/bf/Reliance_Jio_Logo.svg" alt=""
            width="64" height="64">
        <h1 class="h3 mb-3 fw-normal">Create Account</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group mb-1">
                <div class="form-floating me-1">
                    <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                        name="email" id="floatingEmail" value="<?php echo $email; ?>"
                        placeholder="firstname.lastname@ril.com">
                    <label for="floatingEmail">Email Address</label>
                    <span class="invalid-feedback">
                        <?php echo $email_err; ?>
                    </span>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        name="username" id="floatingInput" value="<?php echo $username; ?>"
                        placeholder="firstname.lastname">
                    <label for="floatingInput">User ID</label>
                    <span class="invalid-feedback">
                        <?php echo $username_err; ?>
                    </span>
                </div>
            </div>
            <div class="input-group mb-1">
                <div class="form-floating me-1">
                    <input type="password"
                        class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password"
                        id="floatingPassword" value="<?php echo $password; ?>" placeholder="Password">
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
            </div>
            <div class="d-flex">
                <div class="input-group me-1">
                    <span class="input-group-text">+91</span>
                    <!-- <div class="form-floating me-1"> -->
                    <input type="tel" class="form-control <?php echo (!empty($phone_no_err)) ? 'is-invalid' : ''; ?>"
                        name="phone_no" id="floatingPhoneNo" value="<?php echo $phone_no; ?>" placeholder="Phone Number"
                        maxlength="10">
                    <!-- <label for="floatingPhoneno">Phone Number</label>
                </div> -->
                    <span class="invalid-feedback">
                        <?php echo $phone_no_err; ?>
                    </span>
                </div>
                <div>
                    <select
                        class="dropdown selectpicker show-tick <?php echo (!empty($circle_err)) ? 'is-invalid' : ''; ?>"
                        name="circle" value="<?php echo $circle; ?>" data-width="fit" title="Select Circle"
                        data-show-subtext="true" data-live-search="true" data-live-search-placeholder="🔎" data-size="5"
                        data-style="btn-outline-secondary text-body-emphasis form-control <?php echo (!empty($circle_err)) ? 'is-invalid' : ''; ?>"
                        data-icon-base="bi" data-tick-icon="bi-check-lg" id="floatingCircle">
                        <option data-divider="true" disabled></option>
                        <option data-subtext="<Blank>" selected></option>
                        <?php
                        $query = "SELECT * FROM circle";
                        $result = mysqli_query($db, $query);

                        while ($data = mysqli_fetch_assoc($result)) {
                            echo '<option data-subtext="' . $data['CircleName'] . '">' . $data['CircleCode'] . '</option>';
                        }
                        ?>
                    </select>
                    <span class="invalid-feedback">
                        <?php echo $circle_err; ?>
                    </span>
                </div>
            </div>
            <div class="d-flex my-3">
                <button class="btn btn-primary w-50 me-1" type="button" data-bs-toggle="modal"
                    data-bs-target="#regModal">Register</button>
                <button class="btn d-none" type="submit" id="registerBtn" value="Register"></button>
                <a class="btn btn-danger w-50" value="Reset" href="./">Reset</a>
            </div>
            <p>Existing Users <a class="badge text-bg-info link-underline link-underline-opacity-0"
                    href="../Login/">Login Here</a></p>
            <p class="mt-5 mb-3 text-body-secondary"><i class="bi bi-c-circle"></i> 19xx–2024</p>
        </form>
    </main>

    <script type='text/javascript'>
        $('#regConfirm').click(function () {
            $('#registerBtn').click();
        });
    </script>
</body>

</html>