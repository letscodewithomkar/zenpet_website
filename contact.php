<?php
error_reporting(0);
session_start();
$userstatus= $_SESSION['status'] ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b18067c249.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://fonts.cdnfonts.com/css/futura-md-bt" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="cartlist.css">
    <script src="https://kit.fontawesome.com/b18067c249.js" crossorigin="anonymous"></script>
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
            
    box-shadow: 1px 2px 5px 4px;
        }
        .navbar{
            justify-content:center;
        }
        .navbar-section {
            justify-content: space-evenly;
            width: 80vw;
            max-width: 1400px;
            display: flex;
    flex-wrap: inherit;
    align-items: center;
    margin-left: 40px;
    margin-right: 40px;
    width: 100%;
    justify-content: space-between;
        }
        .navbar-section button {
            border:none;
        }
        .navbar-section button:focus {
            box-shadow:none;
        }
        a.nav-link[href="logout.php"] {
            margin:10px;
}
       .anavbarlinks{
      margin: 0px 5px;
      display: flex;
    place-items: center;
       }
       .navbar-nav{
            justify-content: flex-end;
        }
        .navbar-nav a {
            color: #28B45F;
        }
        
        .navbar-img img {
            width: 10rem;
        }
        
        .navbar-links {
            justify-content: flex-end;
        }
        #searchbar-section{
    display: flex;
    place-items: center;
    margin: 0px 5px;

        }
        #search-area{
        }
        #search-area input{
            padding: 5px;
    border: none;
    outline: none;
    height: 100%;
    width: 100%;
    border-radius: 5px 0px 0px 5px;
        }
        
        #search-icon{
            padding: 7px 0px;
    place-items: center;
    display: flex;
    background: black;
    border-radius: 0px 5px 5px 0px;
        }
        #search-icon a:hover{
       color:#174478;
        }
     
        #form-section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
        
        form label {
            color: #28B45F;
        }
        
        #form-box {
            width: 40%;
    min-width: 250px;
    max-width: 600px;
            background-color: #174478;
            padding: 23px;
            border-radius: 11px;
        }
        
        #form-box button {
            background-color: #28B45F;
        }
        
        #name {
            width: 100%;
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
        @media only screen and (min-width:991px) and (max-width: 1115px) {
.navbar-nav{
    font-size: 1.2vw;
}
#search-icon {
    padding: .5vw 0px;
}
}
@media only screen and (max-width: 991px) {
            #searchbar-section {
    padding: 0px 0px 22px 0px;
}
}
@media only screen and (max-width: 1000px) {
.navbar-brand {
    margin: 0;
    border: none;
}
.navbar-nav {
    align-items: center;
    text-align: center;
}
.navbar{
    display: flex;
    justify-content: center;
}
.navbar-section {

     margin-left: 0px; 
     margin-right: 0px;
}
.navbar-nav:nth-child(1){
            padding: 10px 0px 7px 0px;
        }
        .navbar-nav:nth-child(2), .navbar-nav:nth-child(3){
            padding: 0px 0px 7px 0px;
        }
        .navbar-nav:nth-child(4){
            padding: 0px 0px 8px 0px;
        }
        .navbar-nav:nth-child(6), .navbar-nav:nth-child(8){
            padding: 0px 0px 15px 0px;
        }
        .navbar-nav:nth-child(7){
            padding: 0px 0px 6px 0px;
        }
}
@media only screen and (max-width: 767px) {
#form-box {
    width: 60%;
}
        }
@media only screen and (max-width: 500px) {
    #form-box {
    width: 75vw;
    min-width: 250px;
    background-color: #174478;
    padding: 23px;
    border-radius: 11px;
}
}
@media only screen and (width < 401px){
    #search-icon a{
        margin: 9px 5px;
    }
    .navbar-links {
                height: 100vh;
        text-align: center;
        display: flex;
        justify-content: center;
          }
          .navbar-collapse {
  transition: none;
}
.navbar-collapse .show , .navbar-collapse{
    transition: none;
}
    .scrollable::-webkit-scrollbar {
            width: .4em;
        }
        .navbar-collapse{
            max-height: 100vh;
        }
        
        .navbar-nav a {
            padding: 0px;
        }
}
         @media only screen and (max-width: 320px) {
            .navbar-section {
                justify-content: space-evenly;
                width: 80vw;
                max-width: 1400px;
                justify-content: center !important
            }
     
}
@media only screen and (max-width: 250px) {
    .form-label{
        font-size: 5vw;
    }
    #form-box {
         min-width: auto;
         width: 85vw;
    }
    .navbar-section {
         width: 100vw;

    }
    .navbar-img img {
        width: 40vw;
    } 

}

@media only screen and (max-width: 220px) {
.navbar-section {
                justify-content: space-evenly;
                width: 80vw;
                max-width: 1400px;
                justify-content: center !important
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
                    <a class="nav-link anavbarlinks"  aria-current="page" href="./index.php">Home</a>
                    <a class="nav-link anavbarlinks"  href="./shop.php">Shop</a>
                    <a class="nav-link anavbarlinks"  href="./BookAppointment.php">Book Appointment</a>
                    <a class="nav-link anavbarlinks"  href="./contact.php">Contact us</a>
                    <div id="searchbar-section">
                        <div id="search-area">
                            <input type="text" placeholder="Search">
                        </div>
                        <div id="search-icon">
                                <a class="nav-link anavbarlinks fa-solid fa-magnifying-glass fa-lg" ></a>
                        </div>
                    </div>
                    <div id="total_product_in_cart">
                    <span></span>
                    <a class="nav-link anavbarlinks fa-solid fa-cart-shopping fa-lg"></a>
                    </div>
                    <a class="nav-link anavbarlinks" href="./login.php"<?php echo ($userstatus == 1) ? 'style="display:none;"' : '' ?> >Log In</a>
                    <a class="nav-link anavbarlinks" href="./singup.php"<?php echo ($userstatus == 1) ? 'style="display:none;"' : '' ?> >Sing In</a>
                    <a class="nav-link anavbarlinks" href="logout.php" <?php echo ($userstatus == 0) ? 'style="display:none;"' : '' ?>>Logout</a>
    
                </div>
            </div>
        </div>
    </nav>
 <div id="wishlist-section">
    <div id="header_whishlist">

        <h2>Cartlist</h2>
        <div id="wishlist_close_arrow">
        <i class="fa-solid fa-xmark fa-lg"></i>
        </div>
    </div>
    <div class="wishlist-box">
    </div>
    <div id="total-section">
        <h2 id="totallistvalue">Total Amount :₹ 0</h2>
        <button class="planbuybtn">BUY</button>
    </div>
 </div>
    <section id="form-section">
        <div id="form-box">
            <form action="./mail.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label"><strong>Name</strong></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><strong>Email address</strong></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Mail">
                </div>
                <div class="mb-3">
                    <label for="massage" class="form-label"><strong>Textarea</strong></label>
                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn mb-3">Submit</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script type="module" src="./contact.js"></script>
</body>

</html>