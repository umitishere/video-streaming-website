<?php
require_once("includes/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Video Streaming</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/<?php echo $fontAwesomeKey; ?>.js" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body>

    <div class="signInContainer">

        <div class="column">

            <div class="header">
                <img src="assets/images/icons/VideoTubeLogo.png" title="logo" alt="Site logo" />

                <h3>Sign In</h3>
                <span>to continue to VideoTube</span>
            </div>

            <div class="loginForm">

                <form action="signIn.php" method="POST">

                    <input type="text" name="username" placeholder="Username" autocomplete="off" required />
                    
                    <input type="password" name="password" placeholder="Password" required />

                    <input type="submit" name="submitButton" value="SUBMIT" />

                </form>

            </div>

            <a class="signInMessage" href="signUp.php">Need an account? Sign up here!</a>

        </div>

    </div>

</body>

</html>