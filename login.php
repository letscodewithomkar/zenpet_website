<?php
ob_start(); // Start output buffering
error_reporting(E_ALL); // Enable error reporting for debugging
session_start();
include("connection.php");
if (isset($_POST['login'])) {
    $name = $_POST['username'];
    $userpassword = $_POST['password'];
    echo $name ;
    echo $userpassword;
    $query = "SELECT * FROM user WHERE name = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);
    if ($data && mysqli_num_rows($data) > 0) {
        $user = mysqli_fetch_assoc($data);
        // Check if the password matches the hashed password in the database
        if (password_verify($userpassword, $user['password'])) {
            // Store the username in the session if login is successful
            $_SESSION['personname'] = $name;
            $_SESSION['status'] = 1;
            header("Location: shop.php"); // Redirect to the shop page
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Invalid username!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b18067c249.js" crossorigin="anonymous"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
         :root {
            --primary-color: #28B45F;
            --text-color: #ffffff;
            --card-background: #174478;
            --nav-bacground: #224D76;
            --nav-decoration: #111111;
            --selector-mode: #1F74C8;
            --bgcolor: #041234;
            --bgcolor2: #110A4E;
            --footer-color: #111111
        }
        
        .darkmode {
            --primary-color: #00C9A2;
            --text-color: #ffffff;
            --card-background: #041234;
            --nav-bacground: #252525;
            --nav-decoration: #103764;
            --selector-mode: #1F74C8;
            --bgcolor: #111111;
            --bgcolor2: #111111;
            --bgcolor3: #111111, #111111, #111111, #111111, #111111;
            --footer-color: #252525
        }
        
        * {
            margin: 0px;
            padding: 0px;
        }
        
        body {
            overflow-x: hidden;
                background-color: #f0f2f5;
        }
        
        html,
        body {
            height: 100%;
            width: 100%;
        }
        nav {
            background-color: #174478;
            z-index: 200;
            width: 100%;
            top: 0;
        }
        
        .navbar-section {
            justify-content: space-evenly;
            width: 80vw;
            max-width: 1400px;
        }
        
        .navbar-nav a {
            color: #28B45F;
            z-index: 1;
        }
        
        .navbar-img img {
            width: 10rem;
        }
        
        .navbar-links {
            justify-content: flex-end;
        }
        
        .wishlist {
            color: #E6616A;
            margin-left: 20px;
        }
        
        #selector {
            position: absolute;
            background-color: var(--selector-mode);
            width: 45px;
            height: 36px;
            top: 0px;
            border-radius: 30px;
            right: 36px;
            transition: right .5s ease;
        }
        
        .selectortoggle {
            right: 0px !important;
        }
        
        #singupsection {
            background-color: #f0f2f5;
            display: grid;
            place-items: center;
            height: 80vh;
        }
        
        #singup {
            background-color: var(--card-background);
            padding: 20px;
            width: 355px;
            border-radius: 20px;
        }
        
        form input {
            width: 97%;
            height: 30px;
            padding: 3px;
            border-radius: 6px;
        }
        
        #singup h2:first-child {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 2rem;
        }
        
        .alertdiv {
            color: red;
            margin-bottom: 10px;
            margin-top: 5px;
        }
        
        button {
            padding: 8px;
            font-size: 1.2rem;
            background: var(--primary-color);
            border-radius: 10px;
            border: none;
        }
        
        #btndiv {
            display: grid;
            place-items: center;
        }
        
        .eyeicon {
            translate: -4vh 1.5vh;
            position: absolute;
        }
        
        .singupinputdiv {
            margin-bottom: 15px;
        }
        
        .footer-color {
            background-color: #28B45F
        }
        
        #btn {
            width: 30%;
            background-color: #28B45F;
        }
        
         ::-webkit-scrollbar {
            width: .7em;
        }
        
         ::-webkit-scrollbar-track {
            background: #3B309B;
        }
        
         ::-webkit-scrollbar-thumb {
            background: #34ACBE;
            border-radius: 20px;
        }
        
        @media screen and (width < 420px) {
            #shoecards {
                grid-template-columns: repeat(1, 1fr);
            }
            #shopsection-box {
                width: 90%;
            }
            #shoecards {
                grid-template-columns: repeat(1, 1fr);
            }
            #shopsection-box {
                width: 90%;
            }
            .singupinputdiv {
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
            }
            #username,
            #Password,
            #ComfirmPassword {
                width: 80%;
            }
            .eyeicon {
                translate: 21vw 0vh;
                position: absolute;
            }
            #btn {
                width: 40%;
                background-color: #28B45F;
            }
            .alertdiv {
                width: 80%;
            }
            #singup {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid navbar-section ">
            <a class="navbar-brand navbar-img" href="#"><img src="./webimg/finalfinallogozenpets.png" alt="zenpets"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse navbar-links" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="./index.php">Home</a>
                    <a class="nav-link" href="./shop.php">Shop</a>
                    <a class="nav-link" href="./BookAppointment.php">Book Appointment</a>
                    <a class="nav-link" href="./contact.php">Contact us</a>
                    <a class="nav-link" href="./login.php">Log In</a>
                    <a class="nav-link" href="./singup.php">Sing In</a>
                </div>
            </div>
        </div>
    </nav>
    <?php
 if (isset($error)) {
            $_SESSION['status'] = 0;
            echo '<div style="width: 90%;margin: auto;margin-top: 10px;" class="alert my-alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Username or password is incorrect!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
?>
    <section id="singupsection">
        <div id="singup">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <div class="singupinputdiv">
                    <input type="text" placeholder="Username" id="username" name="username">
                </div>
                <div class="singupinputdiv">
                    <input type="password" placeholder="Password" name="password" id="Password">
                    <i class="fa-solid fa-eye-slash eyeicon" id="togglePassword1"></i>
                </div>
                <div id="btndiv">
                    <input type="submit" name="login" id="btn">
                </div>
                <div id="loginlink">
                    <a href="singup.php">Create Account</a>
                </div>
            </form>
        </div>
    </section>
    <footer class="footer-color text-center text-white">
        <div class="container p-4 pb-0">
            <section class="mb-4">
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i
            ></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i
            ></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i
            ></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i
            ></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i
            ></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i
            ></a>
            </section>
        </div>
        <div class="text-center p-3" style="background-color: rgba(15, 103, 235, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="#">ZenPets</a>
        </div>
    </footer>
    <script>
        const togglePassword = document.getElementById("togglePassword1");
           const password = document.getElementById("Password");
         togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            if (togglePassword.classList.contains("fa-eye-slash")) {
                togglePassword.classList.remove("fa-eye-slash")
                togglePassword.classList.add("fa-eye")
            } else {
                togglePassword.classList.remove("fa-eye")
                togglePassword.classList.add("fa-eye-slash")
            }
        });
        const form = document.querySelector("form");
    </script>

</body>

</html>