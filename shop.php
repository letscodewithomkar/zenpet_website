<?php
ob_start(); // Start output buffering
session_start();
error_reporting(0);

$userstatus= $_SESSION['status'];
if (isset($_SESSION['personname'])) {
    $userprofile = $_SESSION['personname'];
} else {
    $userprofile = null; // Handle default case
}

// Your PHP logic here
if ($userstatus==0) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://fonts.cdnfonts.com/css/futura-md-bt" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
        .navbar-toggler-icon{
            background-image: url(
"data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(40, 189, 95, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }
        #responsive-nav{
            display: flex;
            color: #28B45F;
        }
        .navbar-toggler[aria-expanded="true"],#responsive-nav button{
            background-color: Transparent !important;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;    
        }
        .navbar-toggler:hover,.navbar-toggler:focus,.navbar-toggler:active, 
.navbar-toggler:active:focus:not(:disabled):not(.disabled),
.btn:focus, .btn:active, .btn:hover{
    box-shadow: none!important;
    outline: 0;
}
        body {
            overflow-x: hidden;
        }
        
        html,
        body {
            height: 100%;
            width: 100%;
        }
        #cartshopping{
            display: none;
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
        #mainpage{
            top:70px;
            position: relative;
        }
        
        #shopsection {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5;
            position: relative;
            overflow: hidden;
            flex-direction: column;
            padding-bottom: 20px;
            min-height: 90vh;
        }
        
        #shopsection-box {
            width: 65%;
        }
        
        #shop-name-filter {
            display: flex;
            justify-content: space-between;
            margin: 2em 0px;
            align-items: center;
        }
        
        #shop-name-filter h1 {
            font-size: 2.5rem;
            color: var(--primary-color);
        }
        
        #shop-name-filter span {
            font-size: 1.3rem;
            color: var(--primary-color);
            text-decoration: underline;
        }
        
        #shop-name-filter i {
            color: var(--primary-color);
        }
        
        .cards {
            display: grid;
            background-color: var(--card-background);
            border-radius: 8px;
            box-shadow: 0px 2px 0px 0px;
        }
        
        #shoecards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        
        .cards img {
            width: 100%;
            max-width: 400px;
            max-height: 300px;
        }
        .cardinfo {
            width: 100%;
            padding: 10px;
            display: flex;
    flex-direction: column;
        }
        
        .cardinfo h2 {
            color: var( --primary-color);
            font-size: 1.4vw;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }
  
      
        .cardinfo span {
            color: var( --text-color);
            font-size: 1.2vw;
        }
        
        .options-header {
            display: flex;
            justify-content: space-between;
            padding: 1px;
        }
        
        #shop-filter {
            width: 25%;
            position: absolute;
            display: none;
            border-radius: 0px 50px 50px 0px;
            right: 75%;
            background: var(--card-background);
            padding: 40px 0px;
        }
        #shop-filter[filterison="true"] + #shopsection-box {
  min-height: 120vh;
}
        .hidden {
            display: none;
        }
        .options-header h2 {
            color: var(--primary-color);
            font-size: 1.7em;
        }
        .options-header i {
            color: var(--primary-color);
            transition: all 0.2s ease;
        }
        
        .shop-box-item label {
            color: var(--text-color);
            font-size: 1em;
            margin-left: 10px;
        }
        #Brand .shop-box-item {
            margin: 1px 0px;
        }
        #Pedigree,#Purepet,#Chappi,#Canine-Creek,#Fofos,#Basil,#Bark-Out-Loud,label[for="Pedigree"],label[for="Purepet"],label[for="Chappi"],label[for="Canine-Creek"],label[for="Fofos"],label[for="Basil"],label[for="Bark-Out-Loud"]{
            opacity: .5;
        }
        #gender,
        #Price,
        #Brand,
        #brandCategory {
            width: 85%;
            margin: auto;
            margin-top: 0px;
        }
        #filter-box {
            cursor: pointer;
        }
        #applybtn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        #mybtn {
            font-size: 1em;
            padding: 9px 6px;
            border-radius: 10px;
            background: var(--primary-color);
        }
        #btn1 {
            font-size: 1em;
            padding: 12px;
            border-radius: 16px;
            display: none;
            background: var(--primary-color);
        }
        #btn1 {
            display: none;
        }
        #pagebuttondiv {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            color: white;
        }
        #pagebuttondiv button:first-child {
            margin-right: 10px;
        }
        #pagebuttondiv button {
            font-size: 1.2rem;
            padding: 5px;
            background-color: var(--primary-color);
            border: none;
            border-radius: 5px;
            color: white;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .filter-price {
            width: 220px;
            border: 0;
            padding: 0;
            margin: 0;
        }
        .price-title {
            position: relative;
            color: #fff;
            font-size: 14px;
            line-height: 1.2em;
            font-weight: 400;
            background: #d58e32;
            padding: 10px;
        }
        .price-container {
            display: flex;
            border: 1px solid #ccc;
            padding: 5px;
            margin-left: 57px;
            width: 115px;
        }
        .price-field {
            position: relative;
            width: 100%;
            height: 36px;
            box-sizing: border-box;
            padding-top: 15px;
            padding-left: 0px;
        }
        .price-field input[type=range] {
            position: absolute;
        }
        .price-field input[type=range] {
            width: 100%;
            height: 7px;
            border: 1px solid #000;
            outline: 0;
            box-sizing: border-box;
            border-radius: 5px;
            pointer-events: none;
            -webkit-appearance: none;
        }
        
        .price-field input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
        }
        
        .price-field input[type=range]:active,
        .price-field input[type=range]:focus {
            outline: 0;
        }
        
        .price-field input[type=range]::-ms-track {
            width: 188px;
            height: 2px;
            border: 0;
            outline: 0;
            box-sizing: border-box;
            border-radius: 5px;
            pointer-events: none;
            background: transparent;
            border-color: transparent;
            color: red;
            border-radius: 5px;
        }
        .price-field input[type=range]::-webkit-slider-thumb {
            position: relative;
            -webkit-appearance: none;
            margin: 0;
            border: 0;
            outline: 0;
            border-radius: 50%;
            height: 10px;
            width: 10px;
            margin-top: -4px;
            background-color: #fff;
            cursor: pointer;
            cursor: pointer;
            pointer-events: all;
            z-index: 100;
        }
        
        .price-field input[type=range]::-moz-range-thumb {
            position: relative;
            appearance: none;
            margin: 0;
            border: 0;
            outline: 0;
            border-radius: 50%;
            height: 10px;
            width: 10px;
            margin-top: -5px;
            background-color: #fff;
            cursor: pointer;
            cursor: pointer;
            pointer-events: all;
            z-index: 100;
        }
        
        .price-field input[type=range]::-ms-thumb {
            position: relative;
            appearance: none;
            margin: 0;
            border: 0;
            outline: 0;
            border-radius: 50%;
            height: 10px;
            width: 10px;
            margin-top: -5px;
            background-color: #242424;
            cursor: pointer;
            cursor: pointer;
            pointer-events: all;
            z-index: 100;
        }
        .price-field input[type=range]::-webkit-slider-runnable-track {
            width: 188px;
            height: 2px;
            cursor: pointer;
            background: #555;
            border-radius: 5px;
        }
        
        .price-field input[type=range]::-moz-range-track {
            width: 188px;
            height: 2px;
            cursor: pointer;
            background: #242424;
            border-radius: 5px;
        }
        
        .price-field input[type=range]::-ms-track {
            width: 188px;
            height: 2px;
            cursor: pointer;
            background: #242424;
            border-radius: 5px;
        }
        .price-wrap {
            display: flex;
            color: white;
            font-size: 14px;
            line-height: 1.2em;
            font-weight: 400;
            margin-bottom: 0px;
        }
        
        .price-wrap-1,
        .price-wrap-2 {
            display: flex;
            margin-left: -1px;
        }
        
        .price-title {
            margin-right: 5px;
        }
        
        .price-wrap_line {
            margin: 6px 0px 5px 5px;
        }
        
        .price-wrap #one {
            width: 30px;
            text-align: right;
            margin: 0;
            padding: 0;
            margin-right: 2px;
            background: 0;
            border: 0;
            outline: 0;
            color: white;
            font-family: 'Karla', 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.2em;
            font-weight: 400;
        }
        
        .price-wrap #two {
            width: 41px;
            text-align: left;
            margin: 0;
            padding: 0;
            margin-right: 2px;
            background: 0;
            border: 0;
            outline: 0;
            color: white;
            font-family: 'Karla', 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.2em;
            font-weight: 400;
        }
        
        .price-wrap label {
            text-align: right;
            margin-top: 6px;
            padding-left: 5px;
        }
        .price-field input[type=range]:hover::-webkit-slider-thumb {
            box-shadow: 0 0 0 0.5px #242424;
            transition-duration: 0.3s;
        }
        
        .price-field input[type=range]:active::-webkit-slider-thumb {
            box-shadow: 0 0 0 0.5px #242424;
            transition-duration: 0.3s;
        }
        
        #error-div {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        #error-div h1 {
            text-align: center;
        }
        
        .footer-color {
            background-color: #28B45F;
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
        @media screen and (min-width:1960px) {
            #shop-name-filter {
    width: 65%;
}
#shoecards{
    max-width: 1263px;
}
.cardinfo h2 {
    font-size: 1vw;
}
.cardinfo span {
    color: var(--text-color);
    font-size: 1vw;
}
#shopsection-box {
    place-items: center;
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
#search-icon{

    padding: 13px 5px;
}
#search-icon a{
        margin: 5px 5px 0px 5px;
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
        @media screen and (min-width: 250px) and (max-width: 400px) {
            #shop-name-filter i {
            color: var(--primary-color);
            font-size: 1.3rem;
         }
 
            #shop-name-filter span {
        font-size: 1.2rem;
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
        @media screen and (width < 401px) {
            #shop-box {
                margin-top: 47px;
                margin-top:2dvh;
            }
            .navbar-img img {
    width: 8rem;
}
#search-icon a{
        margin: 9px 5px;
    }
    #search-icon a{
        margin: 9px 5px;
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
            .navbar-nav .my-cart{
            display: none;
        }
            #cartshopping{
            display:block;
            margin-bottom: 8px;
        }
            .navbar-links {
                height: 93vh;
        text-align: center;
        display: flex;
        justify-content: center;
        justify-items: center;
        align-items: center;
          }
            .my-cart{
                padding-top: 20px;
                padding-bottom: 10px;
                margin: auto;
            }
            .navbar-nav a {
                padding: 0px;
        margin-bottom: 10px;
        }
#search-icon {
        padding: 6px 3px;
    }
            #shop-filter {
                width: 100vw;
                position: absolute;
                left: 0%;
                right: 0%;
                height: 100vh;
                border-radius: 0px;
                top: 0;
                padding: 5px;
            }
            hr {
                margin: .5rem 0;
            }
            .navbar-img img {
                width: 30vw;
            }
            #shop-name-filter h1 {
                font-size: 7vw;
            }
            #filter-box {
                text-align: center;
            }
            .shop-box-item label {
                font-size: 1rem;
            }
            .options-header h2 {
                font-size: 1.5rem;
            }
            #mybtn {
                font-size: 1rem;
            }
            #shoecards {
                grid-template-columns: repeat(1, 1fr);
            }
            #shopsection-box {
                width: 90%;
            }
            #shopsection-box[data-hidden="true"] {
                translate: 0% 0px !important;
            }
            #shopsection-box[data-hidden="false"] {
                translate: 0% 0px !important;
            }
            .cardinfo h2 {
                font-size: clamp(1rem, 1rem + .5vw, 2rem);
            }
            .cardinfo span {
                font-size: clamp(1rem, .7rem + 1vw, 2rem);
            }
            #btn1 {
                display: block;
                font-size: 1rem;
                padding: 0em 1.2em;
                margin-right: 20px;
            }
            #error-div img {
                width: 80vw;
            }
            #mainpage {
                top: 55px;
            }
        }
        @media screen and (401px < width < 991px) {
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
            .my-cart{
                padding-top: 20px !important;
                padding-bottom: 10px !important;
            }
        }
        @media screen and (401px < width < 921px) {
            #shoecards {
                grid-template-columns: repeat(2, 1fr);
            }
            .cardinfo h2 {
                font-size: clamp(1rem, 1rem + .5vw, 2rem);
            }
            .cardinfo span {
                font-size: clamp(1rem, 1rem + .5vw, 2rem);
            }
            #btn1 {
                display: block;
            }
            #shop-filter {
                display: none;
            }
            #shopsection-box {
                width: 80%;
            }
            #shop-filter {
                width: 100vw;
                position: absolute;
                top: 0%;
                height: 100vh;
                right: 0%;
                border-radius: 0px;
                padding: 5px;
            }
            #applybtn{
                margin-block: 20px;
            }
            #shop-box {
                margin-top: 3dvh;
            }
           #shop-filter hr{
                margin: .2rem 0;
            }
            #shopsection-box {
                translate: 0% 0px;
            }
            .shop-box-item label {
                font-size: 1rem;
            }
            .options-header h2 {
                font-size: 1.5rem;
            }
            #mybtn {
                font-size: 1rem;
            }
            #btn1 {
                display: block;
                font-size: 1rem;
                margin-right: 20px;
            }

        }
        @media only screen and (max-height:585px){
    #shop-filter[filterison="true"] #shop-box{
        position: fixed; /* Take it out of the document flow */
        top: 12vh;
    left: 0;
    right: 0;
    bottom: 0;
    overflow-y: auto;
        max-height: 100vh;
    }
}
        @media screen and (401px < width < 600px) {
            #shopsection-box {
                width: 90%;
            }
            #shop-filter {
                height: 100vh;
            }
        }
        
        @media screen and (400px < width < 750px) {
            #support h2 {
                text-align: center;
                font-size: clamp(1rem, 1.3rem + 1vw, 2rem);
            }
            #support-box,
            #offer-box {
                width: 100%;
            }
            #footer {
                flex-direction: column;
            }
            #support-items1,
            #support-item2,
            #offer-items1,
            #offer-items2 {
                width: 100%;
                align-items: center;
            }
            #support-items1 span,
            #support-item2 span,
            #offer-items1 span,
            #offer-items2 span {
                font-size: clamp(1rem, 1rem + .2vw, 2rem);
                text-align: center
            }
            #offer-items2:nth-child(3) {
                width: 55px;
            }
            #footer-info {
                width: 90%;
                margin: auto;
                margin-top: auto;
                margin-top: 20px;
            }
        }
        
        .changerotation {
            rotate: 180deg;
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
    <section id="mainpage">
     <section id="shopsection">
        <div id="shopsection-box" data-hidden="false">

            <div id="shop-name-filter" data-hidden="false">
                <div>
                    <h1>Shop</h1>
                </div>
                <div id="filter-box">
                    <span id="filter-box-text">Show Filter</span>
                    <i class="fa-solid fa-filter fa-xl"></i>
                </div>
            </div>
            <div id="error-div">
                <h1>Sorry Product Is <strong>Not Avilable</strong></h1>
                <img src="./webimg/error img2.png" alt="">
            </div>
            <div id="shoecards">
            </div>
        </div>
        <div id="pagebuttondiv">
            <button id="prevpage">Prev Page</button>
            <button id="nextpage">Next Page</button>
        </div>
        <div id="shop-filter" filterison="true">
            <div id="shop-box">
                <div id="Price">
                    <div class="options-box">
                        <div class="options-header">
                            <h2>Price</h2>
                            <i class="fa-solid fa-angle-down fa-2x arrow" id="arrow1"></i>
                        </div>
                        <div class="options-items" id="filter-options1">

                            <div class="wrapper">
                                <fieldset class="filter-price">

                                    <div class="price-field">
                                        <input type="range" min="100" max="10000" value="135" id="lower">
                                        <input type="range" min="100" max="10000" value="500" id="upper">
                                    </div>
                                    <div class="price-wrap">
                                        <div class="price-container">
                                            <div class="price-wrap-1">

                                                <label for="one">₹</label>
                                                <input readonly id="one">
                                            </div>
                                            <div class="price-wrap_line">-</div>
                                            <div class="price-wrap-2">
                                                <label for="two">₹</label>
                                                <input readonly id="two">

                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="brandCategory">
                    <div class="options-box">
                        <div class="options-header">
                            <h2>Categories</h2>
                            <i class="fa-solid fa-angle-down fa-2x arrow" id="arrow2"></i>
                        </div>
                        <div class="options-items" id="filter-options2">
                            <div class="shop-box-item">
                                <input type="radio" id="Pet Nutrition" name="categories" value="food" >
                                <label for="Pet Nutrition">Pet Nutrition</label>
                            </div>
                            <div class="shop-box-item">
                                <input type="radio" id="Pet Accessories" name="categories" value="toy">
                                <label for="Pet Accessories">Pet Accessories</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="Brand">
                    <div class="options-box">
                        <div class="options-header">
                            <h2>Brand</h2>
                            <i class="fa-solid fa-angle-down fa-2x arrow" id="arrow3"></i>
                        </div>
                        <div class="options-items" id="filter-options3">
                            <div class="shop-box-item">
                                <input type="radio" id="Pedigree" name="brand" value="Pedigree" >
                                <label  for="Pedigree">Pedigree</label>
                            </div>
                            <div class="shop-box-item">
                                <input type="radio" id="Purepet" name="brand" value="Purepet" >
                                <label for="Purepet">Purepet</label>
                            </div>
                            <div class="shop-box-item">
                                <input type="radio" id="Chappi" name="brand" value="Chappi" >
                                <label for="Chappi">Chappi</label>
                            </div>
                            <div class="shop-box-item">
                                <input type="radio" id="Canine-Creek" name="brand" value="Canine Creek" >
                                <label for="Canine-Creek">Canine Creek</label>
                            </div>
                            <div class="shop-box-item">
                                <input type="radio" id="Fofos" name="brand" value="Fofos" >
                                <label for="Fofos">Fofos</label>
                            </div>
                            <div class="shop-box-item">
                                <input type="radio" id="Basil" name="brand" value="Basil" >
                                <label for="Basil">Basil</label>
                            </div>
                            <div class="shop-box-item">
                                <input type="radio" id="Bark-Out-Loud" name="brand" value="Bark Out Loud" >
                                <label for="Bark-Out-Loud">Bark Out Loud</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="applybtn">
                    <button id="btn1" data-clickbutton="false">Back</button>
                    <button id="mybtn">Apply Filter</button>
                </div>
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
    <script type="module" defer src="./shop page4.js"></script>

</body>

</html>