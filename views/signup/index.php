<?php
session_start();

$isRegistrationSuccessful = $hasUser = $hasEmail = false;
$username = $email = $password = $confirm_password = $age = $gender = null;
$errors = [];

if (isset($_SESSION['user'])) {
    $hasUser = true;
}

if (isset($_COOKIE['email'])) {
    $hasEmail = true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password_raw = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $age = (int)htmlspecialchars($_POST['age']);
    $gender = htmlspecialchars($_POST['gender']);

    if (empty($username)) $errors[] = "Username is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if ($password_raw !== $confirm_password) $errors[] = "Passwords do not match.";
    if ($age < 13 || $age > 120) $errors[] = "Age must be between 13 and 120.";
    if (!in_array($gender, ['male', 'female'])) $errors[] = "Gender must be selected.";

    if (empty($errors)) {
        setcookie('email', $email, time() + (86400 * 30), "/");
        $_SESSION['user'] = $username;
        $isRegistrationSuccessful = true;
        $hasUser = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <!-- Include Font Awesome for show/hide icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .error-msg { font-size: 0.875rem; color: red; display: none; }
        .is-invalid { border-color: red; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-3">
    <h1 class="text-center">Sign Up Form</h1>
</div>

<?php if (!empty($errors)): ?>
    <div class="container alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container mb-4 rounded bg-white shadow">
    <div class="p-4 mt-3">
        <form action="" method="POST" id="signup-form" novalidate>
            <div class="form-group">
                <label class="font-weight-bold" for="username">Username:</label>
                <input class="form-control" type="text" name="username" id="username">
                <small class="error-msg" id="username-msg">Username is required.</small>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="email">Email:</label>
                <input class="form-control" type="email" name="email" id="email">
                <small class="error-msg" id="email-msg">Please enter a valid email address (e.g., user@gmail.com).</small>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="password">Password:</label>
                <div class="input-group">
                    <input class="form-control" type="password" name="password" id="password">
                    <div class="input-group-append">
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <small class="error-msg" id="strength-msg">Password must be 8+ characters with uppercase, lowercase, number, and symbol.</small>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="confirm-password">Confirm Password:</label>
                <div class="input-group">
                    <input class="form-control" type="password" name="confirm_password" id="confirm-password">
                    <div class="input-group-append">
                        <span class="input-group-text" id="toggleConfirm" style="cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <small class="error-msg" id="match-msg">Passwords do not match.</small>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="age">Age:</label>
                <input class="form-control" type="number" name="age" id="age">
                <small class="error-msg" id="age-msg">Age must be between 13 and 120.</small>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="gender">Gender:</label>
                <select class="form-control" name="gender" id="gender">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <small class="error-msg" id="gender-msg">Please select your gender.</small>
            </div>

            <button class="btn btn-success font-weight-bold mt-3 w-100" type="submit" name="submit">Sign up</button>
        </form>
    </div>
</div>

<!-- Registration Success -->
<div class="container rounded bg-white shadow mb-4 <?= $isRegistrationSuccessful ? "d-block" : "d-none" ?>">
    <div class="container"><h2 class="font-weight-bold pt-4">Registration Successful!</h2></div>
    <div class="container py-3">
        <span class="d-block font-weight-bold">Username: <p class="d-inline font-weight-normal"><?= $username ?></p></span>
        <span class="d-block font-weight-bold">Email: <p class="d-inline font-weight-normal"><?= $email ?></p></span>
        <span class="d-block font-weight-bold">Age: <p class="d-inline font-weight-normal"><?= $age ?></p></span>
        <span class="d-block font-weight-bold">Gender: <p class="d-inline font-weight-normal"><?= $gender ?></p></span>
    </div>
</div>

<!-- Welcome Back -->
<div class="container mb-3 <?= $hasUser ? "d-block" : "d-none" ?>">
    <p class="text-center">Welcome back, <span class="font-weight-bold"><?= $_SESSION['user'] ?></span></p>
</div>

<!-- Last Used Email -->
<div class="container mb-3 <?= $hasEmail ? "d-block" : "d-none" ?>">
    <p class="text-center">Your last used email: <span class="font-weight-bold"><?= $_COOKIE['email'] ?></span></p>
</div>

<script>
    const form = document.getElementById("signup-form");

    const fields = {
        username: {
            el: document.getElementById("username"),
            msg: document.getElementById("username-msg"),
            validate: val => val.trim() !== ""
        },
        email: {
            el: document.getElementById("email"),
            msg: document.getElementById("email-msg"),
            validate: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)
        },
        password: {
            el: document.getElementById("password"),
            msg: document.getElementById("strength-msg"),
            validate: val => /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(val)
        },
        confirm_password: {
            el: document.getElementById("confirm-password"),
            msg: document.getElementById("match-msg"),
            validate: () => fields.password.el.value === fields.confirm_password.el.value
        },
        age: {
            el: document.getElementById("age"),
            msg: document.getElementById("age-msg"),
            validate: val => val >= 13 && val <= 120
        },
        gender: {
            el: document.getElementById("gender"),
            msg: document.getElementById("gender-msg"),
            validate: val => val !== ""
        }
    };

    function validateField(fieldKey) {
        const field = fields[fieldKey];
        const value = field.el.value;
        const isValid = field.validate(value);

        if (!isValid) {
            field.el.classList.add("is-invalid");
            field.msg.style.display = "block";
        } else {
            field.el.classList.remove("is-invalid");
            field.msg.style.display = "none";
        }

        return isValid;
    }

    Object.keys(fields).forEach(key => {
        fields[key].el.addEventListener("input", () => validateField(key));
    });

    form.addEventListener("submit", function (e) {
        let allValid = true;
        let firstInvalid = null;

        Object.keys(fields).forEach(key => {
            const valid = validateField(key);
            if (!valid && !firstInvalid) {
                firstInvalid = fields[key].el;
                allValid = false;
            }
        });

        if (!allValid) {
            e.preventDefault();
            firstInvalid.focus();
            firstInvalid.scrollIntoView({ behavior: "smooth", block: "center" });
        }
    });

    // Toggle password visibility
    document.getElementById("togglePassword").addEventListener("click", function () {
        const pwd = document.getElementById("password");
        pwd.type = pwd.type === "password" ? "text" : "password";
        this.innerHTML = pwd.type === "password" ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });

    document.getElementById("toggleConfirm").addEventListener("click", function () {
        const cpwd = document.getElementById("confirm-password");
        cpwd.type = cpwd.type === "password" ? "text" : "password";
        this.innerHTML = cpwd.type === "password" ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });
</script>

</body>
</html>
