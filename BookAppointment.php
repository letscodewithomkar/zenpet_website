<?php
ob_start();
session_start();
include("connection.php"); // Ensure you have the connection to your database
$userstatus = $_SESSION['status'];
$usersname = $_SESSION['personname'];
if (!$usersname) {
    header('Location: login.php');
    exit(); // Make sure to exit after the header redirect to stop further script execution
}

$data = json_decode(file_get_contents("php://input"), true);
$bookedDate = $data['date'] ?? null;
$bookedTime = $data['time'] ?? null;
$doctorName = $data['doctorname'] ?? null; // Safely get doctorname
$currentYear = date('Y');
if (!$doctorName) {
    error_log("Doctor name is missing or invalid!");
    
}
$deletePastBookingsQuery = "DELETE FROM bookings 
                            WHERE STR_TO_DATE(CONCAT(booking_date, '$currentYear'), '%d%b%Y') < CURDATE()";
$conn->query($deletePastBookingsQuery);
$query = "SELECT drname FROM bookings WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $usersname);
$stmt->execute();
$result = $stmt->get_result();
$bookedDoctors = [];
while ($row = $result->fetch_assoc()) {
    $bookedDoctors[] = $row['drname'];
}
$stmt->close();
if ($bookedDate && $bookedTime && $doctorName) {
    $sql = "INSERT INTO bookings (drname, username, booking_date, booking_time) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $doctorName, $usersname, $bookedDate, $bookedTime); // Correct bind parameters
    if ($stmt->execute()) {
    } else {
        error_log("Error saving booking: " . $stmt->error); // Use $stmt->error for the specific statement error
    }
    $stmt->close();
} else {
    error_log("Invalid input data.");
}
$conn->close();
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
            font-size: 16px;
        }
        html,
        body {
            height: 100%;
            width: 100%;
        }
        #popup{
            position: absolute;
            background: #174478;
            color: white;
            padding: 48px 10px;
        }
        #popup[mobileversion="false"][showslot="true"]{
            width :620px;
        }
        #calender_box[mobileversion="false"][showslot="true"]{
            width :50%;
        }
        #popup[mobileversion="false"][showslot="false"] {
  width: 400px;
}
#popup[mobileversion="false"][showslot="false"] .calendarbox {
  width: 100%;
}
        #popupdiv{
            display: flex;
            justify-content: center;//////////
        }
        #closeicon{
            float: right;
            transform: translate(-4px, -21px);
        }
        #calender_box,#slot_box{
width: 50%;
        }
        #slot_box{
            display:none;
        }
        #date_box{
            display: grid;
    grid-template-columns: repeat(7, 1fr);
    place-content: center;
    place-items: center;
    gap: 4px;
    margin: 20px 0px;
        }
        .calendar_dates{
            display: flex;
            width: 30px;
    background: green;
    margin: 4px;
    text-align: center;
    align-items: center;
    align-content: center;
    justify-content: center; 
        }
        #date_box span{
            margin: 3px;
        }
        #time_box{
            display: grid;
    grid-template-columns: repeat(3, 1fr);
    place-items: center;
    margin-top: 15px;
        }
        .slot_available{
            width: 83%;
    background:#28B45F;
    padding: 6px;
    text-align: center;
    margin-top: 10px;
    font-size: .8rem;
        }
        #comfirm_time_date{
            display: flex;
    justify-content: space-around;
    margin-top: 18px;

        }
        #comfirm_time{
            display: flex;
    width: 130px;
    text-align: center;
    justify-items: center;
        }
        #time_text{
            background: white;
    padding: 5px 0px;
    color: black;
    text-align: center;
    width: 50%;
    align-content: center;
        }
        #time_text p,#bookedtime span,#date_text p ,#bookeddate span{
            place-items: center;
            margin: 0;
        }
        #bookedtime,#bookeddate {
            background: white;
    color: black;
    padding: 6px 0px;
    padding: 5px 0px;
    margin-left: 2px;
    width: 50%;
    text-align: center;
    font-size: 0.9rem;
        }
        #comfirm_date{
            display: flex;
    width: 130px;
    margin-left: 5px;
        }
        #date_text{
            background: white;
    padding: 5px 0px;
    color: black;
    width: 50%;
    text-align: center;
        }
        #comfirm_button{
    display: flex;
    justify-content: space-evenly;
    width: 100%;
    margin-top: 5px;
        }
        #comfirm_btn{
            width: 95%;
            display: block;
        }
        #decline_btn{
            display: none;
            margin-left: 14px;
            width: 130px;
        }
        .hidden{
            display: none !important;
        }
        #changecardbg{
            background:#28B45F;
            transition: background-color .5s ease-in-out;
        }
        #changeinfobg{
            background-color:#174478;
            transition: background-color .4s ease-in-out;
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
        a.nav-link[href="logout.php"] {
            margin:10px;
}
        .navbar-section button {
            border:none;
        }
        .navbar-section button:focus {
            box-shadow:none;
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
       
        #booking-section h1,h2{
            text-align: center;
        }
        #pet-category-section {
            display: flex;
            place-content: center;
            flex-wrap: wrap;
        }
        #category-appointment-section{
            display: flex;
    justify-content: center;
    flex-wrap: wrap;
        }
        .other-dr-name{
            display: flex;
        }
        .pet-category{
            display: none;
            width: 200px;
        }
        .category-servies img,#recommended-dr-box-info img ,.other-dr-name img{
            height: 260px;
            object-fit: cover;
        }
        #recommended-dr-box .category-servies{
            background-color: #FFDD57;
        }
        .category-servies,#recommended-dr-box-info,.other-dr-name{
            background-color: #174478;
    color: white;
    margin: 20px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    border-radius: 5px;
    width: 220px;
    flex-direction: column;
    max-width: 300px;
        }.category-servies-info-box{
            background-color: #28B45F;
            width: 100%;
            border-radius: 0px 0px 5px 5px;
        }
        .category-servies-info {     
    display: flex;
     flex-direction: column;
    width: 100%;
    justify-content: center;
    padding: 8px 5px;
    align-items: center;
        }
        .category-servies-info h3{
            font-size: 1.2em;
            text-align: center;
        }
        .other-dr-servies-info p{
margin: auto;
        }
        .other-dr{
            background-color: #174478;
    padding: 8px 15px;
    color: white;
    margin: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 5px;
        }
        .other-dr-name{
            display: flex;
    flex-direction: column;
        }
        .other-dr-name p{
            margin: 0;
            color: #52d39b;
        }
        #other-dr-box-info{
            display: grid;
    grid-template-columns: repeat(auto-fill, 180px);  
    column-gap: 100px;
    place-items: center;
    place-content: center;
    width: 70vw;
    margin: auto;
        }
        .other-dr{
            width: 250px;
        }
        .other-dr-recommended-button button{
            font-size: 11px;
    padding: 3px;
    background-color: #208D67;
    border: none;
    font-weight: 600;
    color: white;
    border-radius: 3px;
        }
        .addicon{
            color: #ffffff;
            translate: 5px 3px;
    margin-left: 6px;
        }
        .option-button{
            width: 100%;
    display: flex;
    justify-content: center;
        }
        .booking-dr{
            display: flex;
    flex-direction: column;
    /* place-content: center; */
    place-items: center;
        }
        .schedule_time_date{
            display: none;
        }
        .option-button button{
            width: 90%;
    background-color: #174478;
    border: none;
    padding: 5px;
    border-radius: 8px;
    color: white;
    margin-bottom: 10px;
        }
        .dr-category-type{
          display: none;
        }
        .dr-category-type img{
            width: 100%;
            object-fit:fill;
        }
        #recommended-dr-box{
    padding: 9px;
    display: flex;
    flex-direction: column;
    place-items: center;
        }
        #booking-section{
            top: 70px;
            position: relative;
        }
        #booking-section h1{
            padding-top: 31px;
        }
        #other-dr-info-parent{
            display: grid;
    grid-template-columns:repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
    place-content: center;
    place-items: center;
     width: 80%;
    margin: auto;
    align-content: center;
    align-items: center;
    justify-content: center;
        }
        #recommended-dr-section{
            display: none;
            margin: 8px 0px;
        }
        #other-dr-section{
            display: none;
        }
        #recommended-dr-box p{
            text-align: center;
            margin: 0;
        }
        #recommended-dr-box h1{
            font-size: 19px;
        }
        #recommended-name h2{
            color:white
        }
        #recommended-name p{
            margin: 0;
    text-align: left;
    color: #52d39b;
        }
        #recommended-dr-box-info{
            display: flex;
    justify-content: center;
    align-items: center;
    background-color: #174478;
    margin: auto;
    border-radius: 6px;
    max-width: 300px;
        }
        #recommended-name{
            display: flex;
    flex-direction: column;
    place-items: center;
    width: 100%;
        }
        #recommended-name img{
    display: flex;
    justify-content: center;
    place-content: center;
    align-items: center;
        }
        #recommended-button{
            margin-left: 20px;
        }
        #recommended-button button{
            font-size: 11px;
    padding: 3px;
    background-color: #208D67;
    border: none;
    font-weight: 600;
    color: white;
    border-radius: 3px;
        }
        .footer-color {
            background-color: #28B45F;
            top: 90px;
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
        };
        @media only screen and (min-width:991px) and (max-width:1115px) {
            .navbar-nav{
                font-size: 1.2vw;
            }
            #search-icon {
                padding: .5vw 0px;
            }
        }
        @media  only screen and (min-width:1050px) and (max-width:1470px) {
            #slot_box {
        /* width: 508px; */
        width: 52% !important;
    }
        }
        @media  only screen and (min-width:550px) and (max-width:1050px) {
            #slot_box {
        width: 508px; 
        
    }
    .calendar_dates {
        width: 43px;
        padding: 0px 0px 0px 0px;
        font-size: 4.4vw;
    }
}
        @media only screen and (max-width:1470px) {
            #popup{
                width: 100%;
    position: absolute;
    top: 0 ;
    padding: 8px 0px 10px 0px;
    height: 95vh !important;
            }
            #date_box{
                margin: 10px 0px;
                width: 77%;
        margin: 10px auto;
        max-width: 370px;
            }
            #calender_box{
                margin-top: 15px;
            }
            #closeicon {
                transform: translate(-26vw, 22px);
}
            .calendar_dates{
                width: 35px;
                padding: 2px 0px 2px 0px;
                font-size: .9rem;
            }
            #popupdiv {
    flex-direction: column;
    place-items: center;
        margin-left: 15px;
}
#calender_box h2{
    font-size: 1.2rem;
}
#time_box{
    margin-top: 8px;
    width: 74%;
    position: relative;
    margin: auto;
}
#slot_box h2{
    font-size: 1.2rem;
}
#comfirm_time_date {
    font-size: .9rem;
    width: 94%;
    justify-content: space-evenly;
    align-content: center;
    place-items: center;
    margin: auto;
    margin-top: 10px;
}
#comfirm_time {
    width: 25%;
    padding: 3px 0px;
}
#slot_box{
    width: 508px;
    max-width: 526px;
}
.slot_available {
    width: 59%;
    font-size: .8rem;
}
#bookedtime,#bookeddate {
    font-size: .8rem;
}
#comfirm_date {
    width: 25%;
    padding: 3px 0px;
}
#comfirm_btn {
    width: 68%;
    font-size: 0.9rem;
    padding: 6px 0px;
}
#comfirm_button{
    place-content: center;
    width: 94%;
  margin: auto;
  margin-top: 10px;
}
        }
        @media only screen and (min-width:1200px) and (max-width: 1309px){
            #other-dr-info-parent {
                width: 90% ;
            }
        }
        @media only screen and (min-width:1470px) and (max-width: 1200px){
#other-dr-info-parent {
    width: 100% ;
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
@media only screen and (max-width: 350px) {
    .category-servies {
        width: 80% !important;
    }
    #recommended-dr-box {
        width: 100% !important;
    }
    #recommended-dr-section{
        place-items: center;
    }
    #calender_box, #slot_box {
    width: 90% !important;
  }
  #date_box {
    width: 100% !important;
  }
  .calendar_dates {
    width: 95% !important;
    font-size: 4vw !important;
  }
  .slot_available {
    width: 90% !important;
    font-size: 3.5vw !important;
  }
}
@media only screen and (max-width: 767px) {
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
}
        @media only screen and (max-width: 665px) {
        #other-dr-info-parent{
     width: auto;
        }
    }
        @media only screen and (max-width: 500px) {
#popupdiv{
    width: 100%;
    height: 80vh;
    margin-left:0px;
}
.calendar_dates {
    width: 95%;
    max-width: 38px;
  }
  #comfirm_time_date {
    width: 100%;
}
#date_box {
    width: 100%;
}
#calender_box, #slot_box {
  width: 70%;
}
#time_box {
    width: 100%;
    left: 0px;
    margin: auto;
  }
  .slot_available {
    width: 90%;
    font-size: 3.5vw;
  }
  #comfirm_time {
    width: 47%;
  }
  #comfirm_button {
    width: 100%;
  }
  #comfirm_date {
    width: 45%;
  }
  #comfirm_btn{
    width: 95%;
  }
        }
@media only screen and (width < 401px){
    #search-icon{
    margin: 6px 0px;
    padding: 0px;
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
#closeicon{
    transform: translate(-40px, 23px) !important;
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
#recommended-dr-box {
    padding: 0px;
}
#recommended-dr-box-info{
    width: 50vw;
        justify-content: space-around;
        padding: 8px 9px;
}
#recommended-name h2 {
    font-size: 4vw;
}
#recommended-name p {
    font-size: 3.5vw;
}
#other-dr-info-parent {
     gap: 0rem; 
}
.dr-category-type {
        height: 100%;
    }
.category-servies h3{
    font-size: 1rem;
    text-align: center;
}
.other-dr {
    width: 200px;
    margin: 10px;
}
.other-dr-name h2{
    font-size: 1rem;
}
.other-dr-name p{
    font-size: .8rem;
}
.dr-category-type img {
     margin-top: 20px; 
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
        padding: 15px 0px;
    }
    #searchicon{
        margin-bottom: 0px;
    }
    .my-cart{
                padding-top: 20px !important;
                padding-bottom: 10px !important;
            }
        }
      
         @media only screen and (max-width: 320px) {
            .scrollable::-webkit-scrollbar {
            width: .4em;
         }
         .navbar-img img {
          width: 40vw;
         }
        .category-servies{
         overflow:hidden;
          }
    #booking-section {
        top: 50px
    }

            .navbar-section {
                justify-content: space-evenly;
                width: 80vw;
                max-width: 1400px;
                justify-content: center !important
            }
            #booking-section h1 {
                margin: 10px;
        font-size: 1.4rem;
        }
        #booking-section h2 {
        font-size: 1rem;
    }
}
        @media only screen and (max-width: 257px){
            .navbar-img img{
        width: 6rem !important;
    }
         }
        @media screen and (width < 250px) {
#date_box {
    width: 100% !important;
    gap: 1vw;
    margin: 0px;
    padding: 0px;
  }
 .others-dr-container{
    width: 69% !important;
 }
.calendar_dates,.slot_available {
    font-size: 5vw !important;
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
            #totallistvalue {
    font-size: 7vw;
            }
 .navbar-img img {
        width: 40vw !important;
    }
    .navbar-section {
                justify-content: space-evenly;
                width: 80vw;
                max-width: 1400px;
                justify-content: center !important
            }
}
h2,h3{
    font-size: 20px;
    margin: 0;
}
    </style>
</head>

<body>
    
<script>
 document.addEventListener("DOMContentLoaded", function() {
    // Array of booked doctors passed from PHP
    console.log("DOM fully loaded and parsed");
    const bookedDoctors = <?php echo json_encode($bookedDoctors); ?>;

    // Loop through each doctor card and set `drisbooked` if the doctor is booked
    document.querySelectorAll('.other-dr-servies-box').forEach(card => {
        // Access the first child directly since you confirmed its structure
        const doctorInfoElement = card.children[0]; // This should be `div.category-servies-info.other-dr-servies-info`
        
        if (doctorInfoElement && doctorInfoElement.classList.contains('other-dr-servies-info')) {
            const doctorName = doctorInfoElement.querySelector('h2').innerText.trim();
            console.log("Doctor Name:", doctorName);
            console.log("Doctor booked:", bookedDoctors);
            // Check if this doctor is in the list of booked doctors
            if (bookedDoctors.includes(doctorName)) {
                card.setAttribute("drisbooked", "true");
                console.log(`Doctor ${doctorName} is booked.`);
            }
        } else {
            console.log("Doctor info element not found within card.");
        }
    });
});


document.addEventListener("DOMContentLoaded", function() {
    console.log("DOM fully loaded and parsed2");
    const cardbox = document.querySelectorAll('.booking-dr');
    // First Observer: Watch for card clicks to display date and time options
    cardbox.forEach((card, i) => {
        card.addEventListener("click", () => {
            console.log("Card clicked:", i);

            // Create a MutationObserver to watch for date selection
            const dateObserver = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    const dateOption = document.getElementById('popup'); // Update selector to match date options
                    if (dateOption && dateOption.style.display !== "none") {
                        console.log("Date options are now visible");

                        // Now observe time slot visibility
                        observeTimeSlot();
                        dateObserver.disconnect(); // Stop observing for date options once confirmed
                    }
                });
            });

            // Observe for date option visibility after card is clicked
            dateObserver.observe(document.body, { childList: true, subtree: true });
        });
    });

    function observeTimeSlot() {
        let timeOptionsVisible = false; // Flag to check if time options are visible
        const timeBox = document.getElementById('time_box');
        
        // Initial check for time options visibility
        if (timeBox && timeBox.style.display !== "none" && !timeOptionsVisible) {
            console.log("Time options are now visible");
            timeOptionsVisible = true;

            // Set up second observer to watch for the confirm button
            observeConfirmButton();
        }

        // MutationObserver to handle time options visibility changes
        const timeObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (timeBox && timeBox.style.display !== "none" && !timeOptionsVisible) {
                    console.log("Time options are now visible");
                    timeOptionsVisible = true;

                    // Set up second observer to watch for the confirm button
                    observeConfirmButton();
                    timeObserver.disconnect(); // Stop observing for time options once confirmed
                }
            });
        });

        // Observe changes in the document to detect visibility of the time options
        timeObserver.observe(document.body, { childList: true, subtree: true });
    }

    function observeConfirmButton() {
        let comfirmvisiable=false;
        const confirmObserver = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                const confirmBtn = document.getElementById("comfirm_btn");
                if (confirmBtn && confirmBtn.style.display !== "none" && !comfirmvisiable) {
                    console.log("Confirm button is now visible");
                    comfirmvisiable=true;
                    confirmBtn.addEventListener("click", sendBookingData);
                    confirmObserver.disconnect(); // Stop observing once the button is set up
                }
            });
        });

        // Observe changes in the document for the confirm button
        confirmObserver.observe(document.body, { childList: true, subtree: true });
    }
});

function sendBookingData() {
    console.log("sendBookingData called");

    const bookedTimeElement = document.getElementById("bookedtime");
    const bookeddateelement = document.getElementById("bookeddate");
    const cardbox = document.querySelectorAll('.other-dr-servies-info');

    let bookedDr = "";
    console.log("bookedTimeElement",bookedTimeElement);
    console.log(cardbox);
    for (let i = 0; i < cardbox.length; i++) {
        console.log("this current card",cardbox[i]);
        if (cardbox[i].getAttribute("cardisselected") === "true") {
            const h2Element = cardbox[i].querySelector('h2');
            console.log(h2Element);
            if (h2Element) {
                bookedDr = h2Element.innerText;
                console.log("Doctor Name Selected:", bookedDr);
                break;
            }
        }
    }

    if (!bookedDr) {
        console.log(bookeddr)
        error_log("No doctor selected. Please select a doctor.");
        alert("No doctor selected. Please select a doctor.");
        return;
    }

    if (bookedTimeElement && bookedTimeElement.innerText !== "") {
        const bookedDate = bookeddateelement ? bookeddateelement.innerText : "";
        const bookedTime = bookedTimeElement ? bookedTimeElement.innerText : "";

        console.log("Booking Info:", bookedDate, bookedTime, bookedDr);

        // AJAX request to send data to bookappointment.php
        console.log("Doctor Name Selected:", bookedDr);

        fetch('https://zenpet.onrender.com/BookAppointment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ date: bookedDate, time: bookedTime, doctorname:bookedDr })
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            error_log('Error:', error);
        });
    } else {
        alert("Please select a booking time.");
    }
}


</script>

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
    <section id="booking-section">
        <h1>Book Appointment</h1>
        <h2>Free Expert Advice</h2>
        <div id="pet-category-section">
            <div class="category-servies pet-category">
                <img src="./webimg/productimgs/bookingsectionimg/dogimg.png" alt="">
                <div class="category-servies-info-box">

                    <div class="category-servies-info">
                        <h3>Dog</h3>
                    </div>
                    <div class="option-button">
                                <button class="category-button">Select</button>
                            </div>
                </div>
            </div>
            <div class="category-servies pet-category">
            <img src="./webimg/productimgs/bookingsectionimg/catimg.png" alt="">
           
            <div class="category-servies-info-box">
                        <div class="category-servies-info">
                        <h3>Cat</h3>
                        </div>
                        <div class="option-button">
                            <button class="category-button">Select</button>
                        </div>
                    </div>
            </div>
        </div>
        <div id="category-appointment-section">
            <div class="category-servies dr-category-type">
            <img src="./webimg/productimgs/bookingsectionimg/newedit/Pet_Grooming_img.png" alt="">
             <div class="category-servies-info-box">

                    <div class="category-servies-info">
                        <h3>Pet Grooming</h3>
                    </div>
                    <div class="option-button">
                                <button class="category-button">Select</button>
                            </div>
             </div>
            </div>
            <div class="category-servies dr-category-type">
            <img src="./webimg/productimgs/bookingsectionimg/newedit/Pet_Nutrition_img.png" alt="">
              <div class="category-servies-info-box">

                    <div class="category-servies-info">
                        <h3>Pet Nutrition</h3>
                    </div>
                    <div class="option-button">
                                <button class="category-button">Select</button>
                            </div>
               </div>
            </div>
            <div class="category-servies dr-category-type">
            <img src="./webimg/productimgs/bookingsectionimg/newedit/Behavier_Training_img.png" alt="">
            <div class="category-servies-info-box">

                    <div class="category-servies-info">
                        <h3>Behavier Training</h3>
                    </div>
                    <div class="option-button">
                                <button class="category-button">Select</button>
                            </div>
               </div>
            </div>
        </div>
        <div id="recommended-dr-section">
            <div id="recommended-dr-box">
                <h1>Recommended Nutrition For Your Pet</h1>
                    <div id="" class="category-servies drcard">
                    <img src="./webimg/productimgs/bookingsectionimg/newedit/dr5.png" alt="">
                    <div class="category-servies-info-box other-dr-servies-box">
                        <div class="category-servies-info other-dr-servies-info">
                            <h2>DR Random</h2>
                            <p>Nutrition</p>
                        </div>
                        <div class="option-button booking-dr">
                            <button>Schedule</button>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
        <div id="other-dr-section">
        <h1>Other Nutrition For Your Pet</h1>
        <div id="other-dr-info-parent">
        </div>
        </div>
        <div id="popup" class="hidden">
            <i class="fa-solid fa-xmark fa-lg" id="closeicon"></i>
            <div id="popupdiv">
            <div id="calender_box">
                <h2>DATE</h2>
                <div id="date_box">
                </div>
            </div>
            <div id="slot_box">
                <h2> Available Slot TIME</h2>
                <div id="time_box">
                </div>
                <div id="comfirm_time_date">
                    <div id="comfirm_time">
                        <div id="time_text">
                            <p>Time</p>
                        </div>
                        <div id="bookedtime">
                            <span></span>
                        </div>
                    </div>
                    <div id="comfirm_date">
                        <div id="date_text">
                            <p>Date</p>
                        </div>
                        <div id="bookeddate">
                            <span></span>
                        </div>
                    </div>
                </div>
                <div id="comfirm_button">
                <button id="comfirm_btn" >Confirm Booking</button>
                    <button id="decline_btn">Decline</button>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
   
    <script type="module" src="bookappointment.js"></script>
</body>
</html>