<?php
    session_start();
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }
    </style>
    
</head>
<body>

    <?php
        require_once('nav.php');
    ?>

    <main class="form-signin w-100 m-auto">
        <form action="register_db.php" method="POST">

        <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-error" role="alert">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>

            <h1 class="h3 mb-3 fw-normal">Please sign up</h1>


            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="firstname" placeholder="Enter your firstname" required>
                <label for="firstname">Firstname</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="lastname" placeholder="Enter your lastname" required>
                <label for="lastname">Lastname</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="c_password" placeholder="Confirm Password" required>
                <label for="confirmpassword">Confirm Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" name="signup" type="submit">Sign up</button>
        </form>
    </main>

    <?php 
        require_once('footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
