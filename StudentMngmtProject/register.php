<?php include('includes/register-form.php') ?>

<html lang="en-gb">
    <head>
        <title>CASARA SIS Portal</title>
        <link rel="stylesheet" href="login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;700&display=swap" rel="stylesheet">
        <link rel="icon" href="assets/favicon.ico">
    </head>
    <body>
        <div class="main-flex-container">
            <div class="image-half full-width">
            <div class="login-half">
                <div class="login-flex-container">
                    <div class="register-flex-item">
                        <img class="casara-logo" src="assets/casara-logo-white-selfmade.png">
                        <div class="register-wording">
                            <h1 class="register-title">Building the Future...</h1>
                            <p class="register-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit dolorem consequuntur.</p>
                        </div>
                    </div>
                    <div class="form-flex-item">
                        <img class="main-title" src="assets/casara-logo-black-selfmade.png">
                        <h2 class="sub-title">Create an account</h2>
                        <p class="sub-text">Let's get you started!</p>
                        <form action="register.php" method="post">
                            <?php include('includes/form-errors.php'); ?>
                            <div class="form-input">
                                <label for="name" class="form-label">Name</label>
                                <input name="name" class="form-input-label" type="text" placeholder="John">
                            </div>
                            <div class="form-input">
                                <label for="surname" class="form-label">Surname</label>
                                <input name="surname" class="form-input-label" type="text" placeholder="Doe">
                            </div>
                            <div class="form-input">
                                <label for="faculty_id" class="form-label">Student/Faculty ID</label>
                                <input name="faculty_id" class="form-input-label" type="number" placeholder="12345678">
                            </div>
                            <div class="form-input">
                                <label for="username" class="form-label">E-Mail</label>
                                <input name="username" class="form-input-label" type="email" placeholder="email@example.com">
                            </div>
                            <div class="form-input">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" class="form-input-label" type="password" placeholder="Your Password">
                            </div>
                            <div class="form-input">
                                <label for="password" class="form-label">Confirm Password</label>
                                <input name="password_confirmation" class="form-input-label" type="password" placeholder="Your Password">
                            </div>
                            <input class="login-button" type="submit" value="Register" name="register_user">
                            <div class="spacer"></div>
                            <p class="register-text">Already have an account? <a class="forgot-password-link" href="login.php">Login Here</a></p>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </body>
</html>
