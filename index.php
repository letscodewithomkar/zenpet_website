<?php
error_reporting(0);
session_start();
$userstatus= $_SESSION['status'];
$value=$POST['value'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="webimg/favicon.png">
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
            padding: 0;
            margin: 0;
        }
        #dog-back-circle{
            clip-path: circle(45% at 60% 115%);
    width: 100%;
    height: 100%;
    background-color: green;
    position: absolute;
    z-index: -1;
        }

        #petcareimg:hover{
            box-shadow: 0px 0px 5px wheat;
        }
        #handwithpaw{
            translate: -65px 287px;
            animation: handwithpaw 2s ;
            animation-timing-function: linear;
            transition: all;
            display: none;

        }
       
        @keyframes handwithpaw {
            0%{
                translate: -65px 287px;
            }
            20%{
                translate: -168px 131px;
z-index: -2;
            }
            40%{
                translate: -218px 96px;
                z-index: -2;
            }
            60%{
                translate: -339px 182px;
                z-index: 2;
            }
            80%{
                translate: -202px 279px;
                z-index: -2;
            }
            100%{
                translate: -65px 287px;
            }

        }
        #petcareimg{
            position: absolute;
    height: 15%;
    z-index: 4;
        }
        #allcategory-section{
            background-color: #28B45F;
        }
        #allcategory-section ul{
    display: flex;
    font-weight: bold;
        }
        #allcategory-section ul li{
            margin: auto;
        }
        .planprice{
                margin-top: 10px;
    font-size: 20px;
    font-weight: 500;
    color: #174478
        }
        .planwarning{
               width: 80%;
    text-align: center;
    color: red;
    font-weight: 500;
    font-size: 12px;
    margin-top: 10px;
        }
       .card-price-box a{
                width: 100%;
    display: flex;
    justify-content: center;
        text-decoration: none;
        }
        #textbox p {
    width: 50%;
    font-size: 1.4vw;
}
.sectioname{
        font-size: 1.4vw;
}
#lefttext h1 {
    text-shadow: 10px 228px 50px #000000;
    font-size: 3vw;
}
 #textbox h1 span {
        font-size: 2rem;
            }
        #preloader {
            position: fixed;
            width: 100%;
            height: 100vh;
            background-color: #28B45F;
            display: flex;
            z-index: 410;
            display:none;
        }
        
        #preloader img {
            margin: auto;
            width: 83px;
        }
      
        .client-review-div h1{
            text-align: center;
            color: #174478;
    font-weight: 600;
            font-family: 'Futura Md BT', sans-serif;
        
        }
        .cards {
            display: grid;
    place-content: center;
    background-color: var(--primary-color);
    padding: 10px;
    margin-top: 15px;
    max-width: 290px;
    min-width: 250px;
    border-radius: 10px;
        }
       #card-box a{
           display: flex;
    justify-content: center;
       }
        #card-div-background{
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            max-width: 1120px;
    justify-content: center;
    margin: auto;
        }
        .cards img {
            width: 100%;
    height: 220px;
        }
        .cardinfo {
            width: 100%;
            margin-top: 10px;
        }
        
        .cardinfo h2 {
            color: var( --card-background);
            font-size: 1em;
            width: 100%;
    max-height: 40px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
        }
        
        .cardinfo span {
            color: var( --text-color);
            font-size: 1em;

        }
        #productpreviewsection{
            background-color: #174478;
    padding: 43px;
    display: flex;
    flex-direction: column;
        }
        #productpreviewsection .card{
            background-color: #28B45F;
            margin: 0px 10px 0px 10px;

        }
        #productpreviewsection h1{
            text-align: center;
            font-weight: 600;
            color: #28B45F;
            font-family: 'Futura Md BT', sans-serif;
        }
        #productpreview-text{
    display: flex;
    text-align: center;
    justify-content: flex-end;
    align-items: center;
        }
        #productpreview-text a{
            width: 100px;
    background-color: #28b45f;
    border-radius: 9px;
    text-decoration: none;
    font-weight: 500;
    color:white
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
    margin-left: 0px;
    margin-right: 0px;
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
    height: 77%;
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
     
        #lefttext {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-left: 8%;
        }
        
        #lefttext h1 {
            text-shadow: 10px 228px 50px #000000;
            font-size: 2.4rem;
            color: #02244a;
            font-weight: 600;
            color: #28B45F;
            font-family: 'Futura Md BT', sans-serif;
        }
        
        #rightimg {
            display: flex;
            justify-content: center;
        }
        
        #rightimg > img {
            width: 100%;
        }
        
        #textbox:first-child {
            color: #02244a;
            font-weight: 600;
            font-family: 'Futura Md BT', sans-serif;
        }
        
        #textbox p {
                color: white;
            width: 50%;
        }
        
        .sectioname {
            color: #109645;
        }
        
        .my-btn {
            background-color: #28B45F;
    color: #ffffff;
    border-radius: 8px;
        }
        .my-btn:hover {
            background-color: #131e6d;
    color: #28B45F;
    border-radius: 8px;
        }
        
        .bg-img {
            background: #134B6D;
            background: radial-gradient(circle farthest-side at top left, #134B6D 18%, #082C4C 83%);
            padding: 30px;
            position: relative;
    overflow: hidden;
        }
        
        .contanier {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .category-section{
        margin-top: 50px;
    margin-bottom: 50px;
       }
        #card-items img {
            width: 250px;
        }
        
        #card-items {
            background-color: #174478;
            height: 100%;
            margin-right: 10px;
            border-radius: 16px;
            overflow: hidden;
            transition: all .5s ease-in-out;
            position: relative;
        }
        
        #card-items:hover {
            background-color: #28B45F;
        }
        
        #card-title {
            visibility: hidden;
            transition: all 500ms ease-in-out;
            translate: 0px 80px;
            font-weight: 550;
            font-family: 'Futura Md BT', sans-serif;
            color: #174478;
        }
        
        #card-items:hover #card-title {
            visibility: visible;
            color: #28B45F;
            translate: 0px 0px;
        }
        
        #card-box {
            position: relative;
            justify-content: space-evenly;
        }
        
        .card-name {
            visibility: hidden;
            transition: all 500ms ease-in-out;
            translate: 0px 80px;
            position: absolute;
            bottom: 0%;
            padding-left: 20px;
            background-color: #174478;
            width: 250px;
            border-radius: 0px 2px 16px 16px;
            color: #28B45F;
        }
        
        #card-items:hover .card-name {
            visibility: visible;
            color: #174478;
            translate: 0px 0px;
        }
        
        .container h1 {
            text-align: center;
            margin: 20px 0px 30px 0px;
            font-weight: 600;
            font-family: 'Futura Md BT', sans-serif;
            color: #174478;
        }
        
        .container h1:hover {
            color: #28B45F;
        }
        
        .card-div {
            display: flex;
            flex-direction: row;
            border-radius: 27px;
    color: #28B45F;
    background-color: #174478;
        }
        
        .card-div img {
            border-radius: 161px;
            width: 70px;
            height: 70px;
        }
        
        .card-body p {
            max-width: 320px;
            color: white;
        }
        
        .card-body i {
            color: goldenrod;
        }
        
        .card-person-name {
            font-weight: 600;
            font-family: 'Futura Md BT', sans-serif;
        }
        
        .carditem {
            margin: 10px;
        }
        
        .bg-reviews {
            background-color: #28B45F;
            padding: 50px 0px 100px 0px;
        }
        
        #subscription-section {
            background-color: #174478;
            padding: 100px 0px 100px 0px;
        }
        
        #subscription-section h1 {
            text-align: center;
            color: #28B45F;
            font-weight: 600;
            font-family: 'Futura Md BT', sans-serif;
        }
        
        .card-price-main {
            margin: auto;
            width: 30%;
        }
        
        .card-price-box {
            width: 300px;
            background-color: #174478;
            margin: 15px 6px;
        }
        
        .card-price-img {
            width: 100%;
            position: absolute;
            z-index: 2;
            top: -1%;
        }
        .servieslist{
    display: flex;
    justify-content: space-around;
    align-items: center;
        }
        .servieslist img{
          display:none;
        }
        .card-body li {
            font-size: 1em;
    font-weight: 500;
    list-style: none;
    margin-bottom: 13px;
    margin-top: 15px;
    text-align: center;
    width: 80%;
            
        }

        .plansingoimgs{
            width:1% !important;
            height:2% !important;
        }

        .card-title {
            color: #28B45F;
    text-align: center;
    
    display: flex;
    justify-content: flex-start;
        }
        
        .card-title2 {
            color: #174478;
            text-align: center;
            translate: 0em 6em;
            z-index: 2;
        }
        
        .cars-price-item {
            background-color: #28B45F;
            height: 730px;
            border-radius: 20px;
            overflow: hidden;
        }
        
        .card-text li {
            list-style: auto;
        }
        
        .card-body-info {
            margin-top: 130px;
            z-index: 2;
            color: white;
                display: flex;
    flex-direction: column;
    align-items: center;
        }
 
        .footer-color {
            background-color: #28B45F
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
            .cards{
                min-width: 220px;
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
            .card-div {
                width: 70%;
                justify-content: center;
                margin-bottom: 20px;
                margin: auto;
                margin-bottom: 20px;
                margin-top: 0px;
            }
            .card-price-main {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }
        @media only screen and (max-width: 768px) {
            #allcategory-section ul{

           font-size: 2vw;
           };

            .card-name {
                width: 285px;
            }
            #rightimg img {
                width: 50%;
            }
            .bg-img {
        padding-top: 115px !important;
            }
            .sectioname{
                    font-size: 3.4vw;
            }
        
            #textbox h1 span {
        font-size: 1em;
            }
            #textbox p {
      font-size: .8em;
    width: 100%;
}
            #lefttext {
                justify-content: center;
                width: 69%;
                text-align: center;
                margin: auto;
            }
            #textbox div {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            #lefttext h1 {
                text-shadow: 0px 0px 0px #000000;
                    font-size: 2em;
            }
            #card-items {
                margin-bottom: 15px;
                width: 55%;
            }
            #card-box {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            #card-items img {
                width: 100%;
            }
            .carditem {
                justify-content: center;
                flex-direction: column;
                display: flex;
                text-align: center;
                padding: 10px;
            }
            .card-person-name {
                width: 100%;
        justify-content: center;
                font-size: 1.2rem;
            }
        }
        @media screen and (width < 250px) {
            #shop-name-filter span {
        font-size: 1rem;
        }
            #shop-name-filter i {
        font-size: 1rem;
        }
        #shop-name-filter h1 {
        font-size: 1.2rem;
         }
          .navbar-section {
         width: 100vw;

         }
        .price-field{
         width: 70vw;
         margin: auto;
        }
        .navbar-img img {
        width: 40vw;
    }
}
         @media only screen and (max-width: 520px) {
                 #rightimg img {
    width: 100%;
}
         }
         @media only screen and (max-width: 257px){
            .navbar-img img{
        width: 6rem !important;
    }
         }
         @media only screen and (max-width: 220px) {
            .servieslist {
    
    font-size: 5.5vw; 
  }
    .navbar-section {
                justify-content: space-evenly;
                width: 80vw;
                max-width: 1400px;
                justify-content: center !important
            }
        }
        @media only screen and (max-width: 320px) {

 .planwarning{

     margin-bottom: 20px;
 }
 .cards img{

     width: 100%;
        height: 220px;
        height: 180px;
 }
            .navbar-section {
                justify-content: space-evenly;
                width: 80vw;
                max-width: 1400px;
                justify-content: center !important
            }
            .cars-price-item {
                height: 100%;
            }
            .card-price-box {
                display: flex;
        place-content: center;
        width: auto;
            }
            .card-price-main {
        width: 85vw;
    }
            .card-title2 {
                translate: 0em 30.8vw;
                font-size: 6vw;
            }
            .servieslist {
    
          font-size: 4vw; 
        }
        }
        @media only screen and (width < 401px){
    .card-body{
padding: 0px;
    }
    .card-body i {
    font-size: 4vw;
    }
    .card-body p {
        font-size: 4vw;
    }
    .card-div img{
        width: 57px;
        height: 57px;
        min-width: 40px;
        max-width: 57px;
    }
    .card-person-name{
        font-size: 4vw;
        margin: 0px;
    }
    .navbar-img img {
    width: 8rem;
}
#productpreviewsection{
    padding: 0px;
}
.cards{
    max-width: 268px;
    min-width: 170px;
    width: 75vw;
    margin-bottom: 30px;
}
#productpreviewsection h1 {
    margin-top: 20px;
}
#search-icon{
    margin: 6px 0px;
}
    #search-icon a{
        margin: 9px 5px;
    }
    .navbar-links {
        height: 93vh;
        text-align: center;
        display: flex;
        justify-content: center;
        justify-items: center;
        align-items: center;
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
        #card-div-background{
            grid-template-columns: repeat(1, 1fr);
            margin: auto;
place-items: center;
        }
        }
        @media screen and (401px < width < 992px) {
            #card-div-background {
                place-items: center;
                grid-template-columns: repeat(2, 1fr);
            }
            .navbar-nav .my-cart{
            display: none;
        }
        #cartshopping{
            display:block;
        }
        .navbar-nav a {
        padding: 0px;
        margin-bottom: 5px;
    }
    #search-icon {
        padding: 16px 0px;
  }
    
    #searchicon{
        margin-bottom: 0px;
    }
    .my-cart{
                padding-top: 20px !important;
                padding-bottom: 10px !important;
            }
        }
        @media screen and (401px < width < 600px) {
            
            #card-div-background {
                grid-template-columns: repeat(1, 1fr) !important;
                margin: auto;
    place-items: center;
    width: 70%;
            }
        }
        @media screen and (600px > width < 910px){
            .cards {
    min-width: 253px;
    max-width: 80%;
}
        }
    </style>
</head> 

<body>
    <div id="preloader">
        <img src="./webimg/YouTube_loading_symbol_3_.gif" alt="">
    </div>
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
                                <a id="searchicon" class="nav-link anavbarlinks fa-solid fa-magnifying-glass fa-lg" ></a>
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
    <div class="container-fluid bg-img" style="padding: 30;">
      <div class="d-md-flex justify-content-around" style="margin-bottom: -30px;">
            <div id="lefttext">
                <div id="textbox">
                    <span class="sectioname">ZenPets Services</span>
                    <h1>We Provide <span class="auto-type"></span></h1>
                    <div>
                        <p>Zen Pets believes in holistic and compassionate pet care that promotes the well-being and happiness of pets.</p>
                        <a href="./shop.php"><button class="btn my-btn">Shop Products</button></a>
                    </div>
                </div>
            </div>
            <div id="rightimg">
                <img src="./webimg/dog and cat.png" alt="">
                <div id="dog-back-circle"></div>
                <div id="handwithpaw"><img id="petcareimg" src="./webimg/pet-care.png" alt=""></div>
          </div>
      </div>
    </div>
    <div>
        <div id="allcategory-section">
            <ul>
                <li>Pet Grooming</li>
                <li>Pet Nutrition</li>
                <li>Behavier Training</li>
                <li>Pet Boarding</li>
                <li>Pet Transportation</li>
            </ul>
        </div>
    </div>
    <section id="category-section">
    <div class="container category-section">
        <h1>Categories</h1>

        <a href="shop.php?category=food">
            <div id="card-box" class="d-md-flex">
                <div id="card-items">
                    <div class="card-name">
                        <h5 id="card-title">Pet Nutrition</h5>
                    </div>
                    <img src="./webimg/nutrationimg.png" class="card-img" alt="...">
                </div>
        </a>
        <a href="shop.php?category=toy">
            <div id="card-items">
                <div class="card-name">
                    <h5 id="card-title">Pet Accessories</h5>
                </div>
                <img src="./webimg/accessoriesimg.png" class="card-img" alt="...">
            </div>
        </a>
        </div>
    </div>
    </section>
    <section  id="productpreviewsection">
        <h1>Products</h1>
    <div id="productpreview-text">
            
            <a href="./shop.php">View More</a>
    </div>
    <div  id="card-div-background">
        
       <div class="cards">
      <img src="./webimg/productimgs/mainproductimg/Pedigree Puppy Dry Dog Food, Chicken & Milk, 3kg Pack img1.jpg" alt="">
                    <div class="cardinfo">
                        <h2>Pedigree Puppy Dry Dog Food, Chicken & Milk, 3kg Pack</h2>
                        <span>MRP : ₹ 722</span>
                    </div>
                </div> 
            <div class="cards">
                    <img src="./webimg/productimgs/mainproductimg/Pedigree Adult Dry Dog Food, Chicken & Vegetables Flavour, 10kg Pack img1.jpg" alt="">
                    <div class="cardinfo">
                        <h2>Pedigree Adult Dry Dog Food, Chicken & Vegetables Flavour, 10kg Pack</h2>
                        <span>MRP : ₹ 2,031</span>
                    </div>
                </div> 
             <div class="cards">
                    <img src="./webimg/productimgs/mainproductimg/Pedigree Puppy Dry Dog Food, Milk and Vegetables Flavour img1.jpg" alt="">
                    <div class="cardinfo">
                        <h2>Pedigree Puppy Dry Dog Food, Milk and Vegetables Flavour</h2>
                        <span>MRP : ₹ 425</span>
                    </div>
                </div> 
                <div class="cards">
                    <img src="./webimg/productimgs/mainproductimg/purepet chicken vegetable adult dog dry food img1.jpg" alt="">
                    <div class="cardinfo">
                        <h2>Purepet Chicken & Vegetable Adult Dog Dry Food</h2>
                        <span>MRP : ₹ 929</span>
                    </div>
                </div> 
            </div>
    </div>
    </section>
    <div id="carouselExampleControls" class="carousel carousel-dark client-review-div slide bg-reviews" data-bs-ride="carousel">
        <h1>Client Reviews</h1>
        <div class="carousel-inner " style="margin-top: 40px;">
            <div class="carousel-item active">
                <div class="card-wrapper container-sm d-lg-flex  justify-content-around">
                    <div class="card card-div ">
                        <div class="carditem d-md-flex align-items-center">
                            <img src="./webimg/person1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title card-person-name">Card title</h5>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <p>"The behavioral consultation at Zen Pets was a game-changer for my anxious dog. They provided effective techniques that made a noticeable difference!"</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-div">
                        <div class="carditem d-md-flex align-items-center">
                            <img src="./webimg/person2.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title card-person-name">Card title</h5>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <p>"I had peace of mind leaving my dog at Zen Pets' boarding facility. The staff took great care of him and provided regular updates."</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="carousel-item">
                <div class="card-wrapper container-sm d-lg-flex   justify-content-around">
                    <div class="card card-div">
                        <div class="carditem d-md-flex align-items-center">
                            <img src="./webimg/person4.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title card-person-name">Card title</h5>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <p>"My dog's coat has never looked better since switching to Zen Pets' premium pet food. He's healthier and more energetic than ever!"</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-div">
                        <div class="carditem d-md-flex align-items-center">
                            <img src="./webimg/person5.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title card-person-name">Card title</h5>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <p>"The nutritional supplements from Zen Pets have improved my cat's overall well-being. Highly recommended for pet owners!"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card-wrapper container-sm d-lg-flex  justify-content-around">
                    <div class="card card-div">
                        <div class="carditem d-md-flex align-items-center">
                            <img src="./webimg/person3.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title card-person-name">Card title</h5>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <p>"The veterinarians at Zen Pets are knowledgeable and caring. I trust them completely with my pet's health. Great service!"</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-div">
                        <div class="carditem d-md-flex align-items-center">
                            <img src="./webimg/person6.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title card-person-name">Card title</h5>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <p>"Zen Pets' grooming services are top-notch. My dog always looks and smells amazing after a visit!"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        </div>
    </div>
    <div id="subscription-section">
        <h1>Subscription Plan</h1>
     <div class="row-cols-1 row-cols-md-2 g-4 d-lg-flex justify-content-center align-items-center card-price-main">
            <div class="col card-price-box">
                <div class="card cars-price-item">
                    <img src="./webimg/bronze chain with bone4.png" class="card-price-img" alt="...">
                    <h5 class="card-title2">Bronze Plan</h5>
                    <div class="card-body card-body-info">
                        <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                            <li class="card-text">Monthly delivery of essential pet supplies </li>
                        </div>
                        <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Access to exclusive discounts and promotions on select products and services.</li>
                        </div>
                        <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Basic access to educational resources and tips for pet care.</li>
                        </div>
                        <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Priority customer support for subscription inquiries.</li>
                        </div>
                        <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Flexibility to pause or cancel the subscription with ease.</li>
                        </div>
                       <span class="planprice">₹ 300</span>
                       <button type="button" class="planbuybtn" value="bronze">Buy</button>
                       <span class="planwarning">Subscription model is not avilable now</span>
                    </div>
                 
                </div>
            </div>
            <div class="col card-price-box">
                <div class="card cars-price-item">
                    <img src="./webimg/gold chain with bone4.png" class="card-price-img" alt="...">
                    <h5 class="card-title2">Gold Plan</h5>
                    <div class="card-body card-body-info">
                    <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">All the benefits of the Bronze subcription plan.</li>
                    </div>
                    <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Enhanced monthly delivery with a wider selection of premium pet supplies.</li>
                    </div>
                    <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Increased discounts and special offers on a broader range.</li>
                    </div>
                    <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Priority access to limited-time promotions.</li>
                    </div>
                    <div class="servieslist">
                            <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Dedicated customer support with faster response times.</li>
                    </div>
                     <span class="planprice">₹ 500</span>
<button  type="button" class="planbuybtn"  value="gold">Buy</button>
                         <span class="planwarning">Subscription model is not avilable now</span>
                    </div>
                </div>
            </div>
            <div class="col card-price-box">
                <div class="card cars-price-item">

                    <img src="./webimg/platinum chain with bone4.png" class="card-price-img" alt="...">
                    <h5 class="card-title2">Platinum Plan</h5>
                    <div class="card-body card-body-info">
                    <div class="servieslist">
                    <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">All the benefits of the Gold subcription plan.</li>
                    </div>
                    <div class="servieslist">
                        <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Monthly delivery of a deluxe selection of top-tier pet supplies and exclusive items.</li>
                    </div>
                    <div class="servieslist">
                        <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Higher discounts and VIP access to exclusive events.</li>
                    </div>
                    <div class="servieslist">
                        <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Extensive educational resources, including expert advice.</li>
                    </div>
                    <div class="servieslist">
                        <i class="fa-solid fa-check fa-xl plansingoimgs"></i>
                        <li class="card-text">Priority access to new product launches.</li>
                    </div>
                    <span class="planprice">₹ 1000</span>
                    <button type="button" class="planbuybtn" value="platinum">Buy</button>
                        <span class="planwarning">Subscription model is not avilable now</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
   
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="./index.js"></script>
</body>

</html>