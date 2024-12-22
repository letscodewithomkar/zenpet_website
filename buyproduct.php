<?php
error_reporting(0);
session_start();

$userprofile= $_SESSION['personname'];
$userstatus= $_SESSION['status'] ;
if($userprofile != true){
    ?>
    <meta http-equiv ='refresh' content ='0; url= login.php'/>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="webimg/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="cartlist.css">
    <script src="https://kit.fontawesome.com/b18067c249.js" crossorigin="anonymous"></script>
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
            --primary-color: color: #28B45F;
            ;
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
            position: fixed !important;
            width: 100%;
            top: 0;
            
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
    /* height: 10%; */
    place-items: center;
    display: flex;
    background: black;
    border-radius: 0px 5px 5px 0px;
        }
        #search-icon a:hover{
       color:#174478;
        }
        #mainpage{
            top:70px;
            position: relative;
        }
        #productsection{
            display: flex;
            justify-content: center;
        }
        #productaction-box{
            display: flex;
            width: 80%;
    align-items: start;
    margin-top: 30px;
        }
        #imgsection{
            position: sticky;
            top: 70px;
            margin-top: 55px;
            width: 50%;
    justify-content: center;
    align-items: center;
    display: flex;
    flex-direction: column;
        }
        #imgsection,#infosection{
            width: 50%;
        }
        #mainimg{
            display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
        }
        #mainimg img {
            width: 98%;
            max-width: 340px;

    height: auto;
    margin-bottom: 10px;
}
        #otherimgs{
            display: flex;
    align-content: center;
    justify-content: center;
        }
        #otherimgs img{
            width: 18%;
            max-width: 70px;
            margin: 5px;
            object-fit: cover;
        }
        #infosection{
            margin-top: 40px;
            width: 50%;
            max-width: 600px;
        }
        #infosection h2{
           
            color: #28B45F;
        }
        #price-info{
            font-size: 1.5rem;
        }
        #hearticon{
            color: #28B45F;
            margin-left: 9px;
        }
        #product-action{
            width: 60%;
    display: flex;
    place-items: center;
    margin-top: .5rem;
        }
        #product-action button{
            padding: 5px 20px;
    border-radius: 8px;
    background: #28B45F;
    border: none;
    color: white;
        }
        #product-discription-section{
            background: #F0F0F0;
            width: 95%;
    border-radius: 10px;
    padding: 30px;
    margin-top: 20px;
    max-height: 540px;
        }
        #product-discription{
            overflow-y: auto;
    max-height: 450px;
    padding-right: 20px;
    font-size: 1rem;
        }
        #product-discription::-webkit-scrollbar-thumb {
            background:#28B45F;
            
        }
        #product-discription::-webkit-scrollbar-track {
            background: #174478;
        }
        #product-discription-section h2{
        font-size: 1.7rem;
    }
        .footer-color {
            background-color: #28B45F;
            top: 40px;
            position: relative;
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
        @media only screen and  (max-width: 1999px) {
            #infosection h2{
            font-size: 1.4rem;
            }
            #price-info {
    font-size: 1.3rem;
}
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
#searchbar-section {
  
    padding: 0px 0px 22px 0px;
}
}
@media only screen and (max-width: 767px) {

#imgsection{
    width: 100%;
    position: static;
}
#productsection{
    flex-direction: column;
    align-items: center;
}
#productaction-box{
    flex-direction: column;
    justify-content: center;
    justify-items: center;
    align-items: center;
}
#productaction-section{
    align-items: center;
    /* align-content: center; */
    justify-items: center;
    display: flex;
    width: 100%;
    justify-content: center;
}
#product-action{
    width: auto;
    margin-left: 20px;
    justify-content: flex-start;
}
#product-discription-section{
    padding: 16px;
}
#mainimg img {

    height: auto;
    margin-bottom: 10px;
}
#infosection{
    width: 80%;
    text-align: center;
    margin-left: 30px;
}
}
@media only screen and (max-width: 520px) {
#infosection {
    width: 100% !important;
    margin-left: 0px;
}   
#infosection h2 {
        font-size: 1.2rem;
    }
    #price-info {
        font-size: 6vw;
    }
    #product-action button {
        font-size: 4.5vw;
    }
}
@media only screen and (width < 350px){
    #infosection h2 {
        font-size: 1.2rem;
    }
    #product-discription-section {
    width: 100%;
    }
}
@media only screen and (width < 220px){
    #infosection h2 {
        font-size: .9rem;
    }
    #product-discription {
    font-size: .8rem;
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
        @media only screen and (max-width: 220px) {
    .navbar-section {
                justify-content: space-evenly;
                width: 80vw;
                max-width: 1400px;
                justify-content: center !important
            }
        }
        @media (min-width: 1200px) {
    .h2, h2 {
        font-size: 1.5rem;
    }
}
        </style>
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
                    <a class="nav-link anavbarlinks"  href="./bookdoctor.php">Book Appointment</a>
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
                    <span <?php echo ($userstatus == 0) ? 'style="display:none;"' : '' ?>></span>
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

        <h2>Wishlist</h2>
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
    <section id="mainpage">
        <section id="productsection">
        <div id="productaction-box">
            <div id="imgsection">
                <div id="mainimg">
                    <img src="" alt="">
                </div>
                <div id="otherimgs">
                    <img class="product-otherimg" src="" alt="">
                    <img class="product-otherimg" src="" alt="">
                    <img class="product-otherimg" src="" alt="">
                    <img class="product-otherimg" src="" alt="">
                </div>
            </div>
            <div id="infosection">
                <h2>Canine Creek Starter Ultra Premium Dry Dog Food 1.5Kg Pack</h2>
                <div id="productaction-section">
                <strong> <span id="price-info">₹ 2000</span></strong>
                 <div id="product-action">
                  <button>BUY NOW</button>
                  <i class="fa-solid fa-bag-shopping" id="hearticon"></i>
                  </div>
                </div>
                <div id="product-discription-section">
                    <h2>Discription</h2>
                    <div id="product-discription">
                        <span>Canine Creek Starter dog dry food Ultra Premium made to ensure your dog's all over good health. It is a unique formula that helps your dog to develop healthy muscles, better immunity, stronger dental health and live a longer life.
    
    <br> feature:-</span><br>
    <br>Promotes healthy muscle growth</br>
    <br>Maintains healthy skin and coat</br>
    <br>Promotes healthy immune system</br>
    <br>Improves bone and joint health</br>
    <br>Promotes dental health</br>
    
    <br>Country of Origin: India</br></span>
                    </div>
                </divid>
            </div>
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
    </section> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script type="module" src="./buyproduct.js"></script>
        </body>