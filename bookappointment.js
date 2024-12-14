import {
    petsdr,
    calender
} from "./doctor.js";
let addicon = document.querySelectorAll(".addicon");
addicon.forEach(element => {
    element.addEventListener("mouseover", () => {
        element.classList.add("fa-shake")

    })
    element.addEventListener("mouseout", () => {
        element.classList.remove("fa-shake")

    })

});

let categoryservies = document.querySelectorAll(".category-servies");
let recommendedname = document.querySelectorAll(".recommended-name");
let optionbuttondiv = document.querySelectorAll(".option-button");
let categoryserviesinfobox = document.querySelectorAll(".category-servies-info-box");
for (let i = 0; i < categoryservies.length; i++) {
    let optionbutton = optionbuttondiv[i].querySelector("button");

    categoryservies[i].addEventListener("mouseover", () => {
        optionbutton.style.background = "#28B45F";
        categoryserviesinfobox[i].setAttribute("id", "changeinfobg");
        categoryservies[i].setAttribute("id", "changecardbg");

    })

    categoryservies[i].addEventListener("mouseout", () => {
        categoryservies[i].setAttribute("id", "");
        categoryserviesinfobox[i].setAttribute("id", "");
        optionbutton.style.background = "#174478";
    })
}

let searchicon = document.getElementById("search-icon");
let searcharea = document.getElementById("search-area");

searchicon.addEventListener("click", () => {
    let searchareainput = searcharea.querySelector("input");
    let currenturl = "shop.php";
    let userinput = searchareainput.value
    window.location.href = `${currenturl}?product=${userinput}`;
});

let searchinput = searcharea.querySelector("input");
searchinput.addEventListener("keyup", (element) => {
    if (element.keyCode == 13) {
        let currenturl = "shop.php";
        let userinput = searchinput.value
        window.location.href = `${currenturl}?product=${userinput}`;
    }
});
function checktotallist(listparent) {
    let defaultlimt = 3;
    const wishlistsectionbox = document.querySelector(".wishlist-box");
    let wishlist_cards = document.querySelector(".wishlist-cards")
    if (window.screen.width <= 1000) {
        defaultlimt = 5;
    }
    if (window.screen.width <= 766 && window.screen.width >250) {
        wishlist_cards.style = "margin-top: 160px"
    }
    if (wishlistsectionbox.children.length > defaultlimt) {
        wishlistsectionbox.classList.add("scrollable");
    } else {
        wishlistsectionbox.classList.remove("scrollable");
    }

};
function adjustWishlistBox() {
    const wishlistBox = document.querySelector('.wishlist-box');
    const wishlistCards = document.querySelectorAll('.wishlist-cards');
    if (wishlistCards.length > 0) {
        const lastCard = wishlistCards[wishlistCards.length - 1];
        const lastCardRect = lastCard.getBoundingClientRect();
        const boxRect = wishlistBox.getBoundingClientRect();
        if (lastCardRect.bottom > boxRect.bottom) {
            wishlistBox.classList.add('scrollable');
        } else {
            wishlistBox.classList.remove('scrollable');
        }
    }
}

let wishlistclosearrow = document.getElementById("wishlist_close_arrow");
let wishlistsection = document.getElementById("wishlist-section");
let facartshopping = document.getElementsByClassName("fa-cart-shopping");
let totalproductincart = document.querySelector("#total_product_in_cart span");
facartshopping[0].addEventListener("click",()=>{
    if(facartshopping[0].getAttribute("cartison")=="true"){
        wishlistsection.style.display="none";
        facartshopping[0].setAttribute("cartison","false")
    }else{
        wishlistsection.style.display="flex";
        facartshopping[0].setAttribute("cartison","true")
        adjustWishlistBox();
    }
    wishlistclosearrow.addEventListener("click",()=>{
       wishlistsection.style.display="none";
       facartshopping[0].setAttribute("cartison","false")
    });
 });
 totalproductincart.addEventListener("click",()=>{
    if(facartshopping[0].getAttribute("cartison")=="true"){
        wishlistsection.style.display="none";
        facartshopping[0].setAttribute("cartison","false")
    }else{
        wishlistsection.style.display="flex";
        facartshopping[0].setAttribute("cartison","true")
        adjustWishlistBox();
    }
    wishlistclosearrow.addEventListener("click",()=>{
       wishlistsection.style.display="none";
       facartshopping[0].setAttribute("cartison","false")
    });
 });
function changeaddnumber(plusicon, quantityInput, retrievedcart) {
    let grandparent;
    plusicon.addEventListener('click', (event) => {
        const parentElement = event.currentTarget.parentNode;
        grandparent = parentElement.parentElement;
        for (let i = 0; i < retrievedcart.length; i++) {
            if (grandparent.innerText == retrievedcart[i].name) {
                retrievedcart[i].quantity += 1;
                quantityInput.value = retrievedcart[i].quantity
                checktotalprice(retrievedcart);
            }
        }
    })
}

function checktotalprice(retrievedcart) {
    let Totalamountofproduct = 0;
    const Totalamount = document.getElementById("totallistvalue");
    for (let i = 0; i < retrievedcart.length; i++) {
        Totalamountofproduct += retrievedcart[i].price * parseFloat(retrievedcart[i].quantity);
        Totalamount.innerHTML = `Total Amount : ${Totalamountofproduct.toLocaleString()}`;
    }
    localStorage.setItem('cartlist', JSON.stringify(retrievedcart));
}
function changeminusnumber(miunsIcon, quantityInput, retrievedcart, userselectedwishlist, trashIcon) {
    let grandparent;
    miunsIcon.addEventListener('click', (event) => {
        const parentElement = event.currentTarget.parentNode;
        grandparent = parentElement.parentElement;
        for (let i = 0; i < retrievedcart.length; i++) {
            if (grandparent.innerText == retrievedcart[i].name) {
                if (retrievedcart[i].quantity == 1) {
                    userselectedwishlist = [];
                    userselectedwishlist.push(retrievedcart[i]);
                    munisicondeleteelement = true;
                    changetrashelement(event, userselectedwishlist);
                    return
                }
                retrievedcart[i].quantity -= 1;
                quantityInput.value = retrievedcart[i].quantity
                checktotalprice(retrievedcart);
            }
        }
    })
}
let elementdeleted = false;
let munisicondeleteelement = false;
function attachTrashEvent(userselectedwishlist, trashIcon) {
    trashIcon.addEventListener('click', (event) => {
        changetrashelement(event, userselectedwishlist);
    });
}
function changetrashelement(event, userselectedwishlist) {
    let grandparent;
    let fillbag = document.querySelectorAll(".fillbag");
    const parentElement = event.currentTarget.parentNode;
    grandparent = parentElement.parentElement;
    const h2Element = grandparent.querySelector('h2');
    for (let i = 0; i < retrievedcart.length; i++) {
        if (!munisicondeleteelement) {
            if (h2Element.innerText == retrievedcart[i].name) {
                userselectedwishlist = [];
                userselectedwishlist.push(retrievedcart[i]);
                retrievedcart.splice(i, 1);
                elementdeleted = true;
                addwishlist(userselectedwishlist);
            }
        } else {
            if (userselectedwishlist[0].name == retrievedcart[i].name) {
                retrievedcart.splice(i, 1);
                elementdeleted = true;
                addwishlist(userselectedwishlist);
                munisicondeleteelement = false;
                elementdeleted = false;
            }
        }
        localStorage.setItem('cartlist', JSON.stringify(retrievedcart));
    }
    elementdeleted = false;
}

let retrievedcart = [];
let currentcartlist;
let listfromlocalstorage = false;
function getwishlist(params) {
    if (JSON.parse(localStorage.getItem('cartlist')) != null) {
        let userselectedwishlist = [];
        listfromlocalstorage = true;
        retrievedcart = JSON.parse(localStorage.getItem('cartlist'));
        addwishlist(userselectedwishlist);
    }
}
function addwishlist(userselectedwishlist) {
    const wishlistsectionbox = document.querySelector(".wishlist-box");

    wishlistsectionbox.innerHTML = "";

    if (userselectedwishlist.length != 0) {
        let existsInCart = false;

        for (let i = 0; i < retrievedcart.length; i++) {
            if (retrievedcart !== null && retrievedcart.length !== 0) {
                if (userselectedwishlist[0].name == retrievedcart[i].name) {
                    existsInCart = true;
                    return
                }
            }
        }
        if (existsInCart != true && !elementdeleted) {

            retrievedcart.push(userselectedwishlist[0]);
        }
        localStorage.setItem('cartlist', JSON.stringify(retrievedcart));


    }
    if (retrievedcart != null && retrievedcart.length > 0) {
        for (let i = 0; i < retrievedcart.length; i++) {
            const listparent = document.createElement("div");
            const imgandnamediv = document.createElement("div");
            imgandnamediv.setAttribute("class", `imgandnamediv`);
            const wishlistinfodiv = document.createElement("div");
            wishlistinfodiv.setAttribute("class", `parentcontanier`);
            listparent.setAttribute("class", `wishlist-cards`);
            const listname = document.createElement("h2");
            listname.innerText = retrievedcart[i].name;
            const liststorediv = document.createElement("div");
            liststorediv.setAttribute("class", `quantity`);
            const imgelement = document.createElement("img");
            imgelement.src = retrievedcart[i].img;
            const plusicon = document.createElement("i");
            plusicon.classList.add('fa-solid', 'fa-plus', 'fa-lg', 'plusicon');
            const quantityInput = document.createElement('input');
            quantityInput.type = 'text';
            quantityInput.inputmode = 'numeric';
            quantityInput.name = 'numberholder';
            quantityInput.value = retrievedcart[i].quantity;
            const miunsIcon = document.createElement('i');
            miunsIcon.classList.add('fa-solid', 'fa-minus', 'fa-lg', 'minusicon');
            const trashIcon = document.createElement('i');
            trashIcon.classList.add('fa-solid', 'fa-trash', 'fa-lg', 'trashicon');
            if (window.screen.width < "500px") {
                plusicon.classList.add('fa-solid', 'fa-plus', 'fa-sm', 'plusicon');
                miunsIcon.classList.add('fa-solid', 'fa-minus', 'fa-sm', 'minusicon')
                trashIcon.classList.add('fa-solid', 'fa-trash', 'fa-sm', 'trashicon');
            }
            liststorediv.append(plusicon, quantityInput, miunsIcon, trashIcon);
            imgandnamediv.append(imgelement, listname);
            wishlistinfodiv.append(imgandnamediv, liststorediv);
            listparent.append(wishlistinfodiv);
            wishlistsectionbox.append(listparent);
            changeaddnumber(plusicon, quantityInput, retrievedcart);
            changeminusnumber(miunsIcon, quantityInput, retrievedcart, userselectedwishlist, trashIcon);
            attachTrashEvent(userselectedwishlist, trashIcon);
            checktotalprice(retrievedcart);
        }
    }
    let cartlisttotalnumber=document.querySelector("#total_product_in_cart span");
cartlisttotalnumber.innerText=retrievedcart.length;
}
function whishlistresponzie(params) {
    const plusicon = document.querySelectorAll('.plusicon'); // Replace '.fa-icon' with your actual class selector
    const minusicon = document.querySelectorAll('.minusicon');
    const trashelementIcon = document.querySelectorAll(".trashicon");
    let wishlist_cards = document.querySelector(".wishlist-cards");
    if(wishlist_cards!=null){
        if (window.screen.width <= 766 && window.screen.width >250) {
            wishlist_cards.style = "margin-top: 160px"
        }
    }
    if (window.innerWidth < 500) {
        plusicon.forEach(function (plusicon) {
            plusicon.classList.add('fa-sm');
        });
        minusicon.forEach(function (minusicon) {
            minusicon.classList.add('fa-sm');
        })
        trashelementIcon.forEach(function (trashelementIcon) {
            trashelementIcon.classList.add('fa-sm');
        })

    }
    else if (window.innerWidth < 767 && window.innerWidth > 500) {
        plusicon.forEach(function (plusicon) {
            plusicon.classList.remove('fa-lg');

        });

        minusicon.forEach(function (minusicon) {
            minusicon.classList.remove('fa-lg');

        });
        trashelementIcon.forEach(function (trashelementIcon) {
            trashelementIcon.classList.remove('fa-lg');
        });
    }
    else {
        plusicon.forEach(function (plusicon) {
            plusicon.classList.add('fa-lg');
        });
        minusicon.forEach(function (minusicon) {
            minusicon.classList.add('fa-lg');
        })
        trashelementIcon.forEach(function (trashelementIcon) {
            trashelementIcon.classList.add('fa-lg');
        })
    }
    getwishlist();
}
window.addEventListener('resize', whishlistresponzie);
window.addEventListener('load', whishlistresponzie);

function setinfoincard(petservicescardselected) {
    let drcardparent = document.getElementById("other-dr-info-parent");
    const result = petsdr.filter((petdr) => petdr.specialist==petservicescardselected);
    result.forEach(element => {
        if(result[result.length-1].name!=element.name){
        let drcontainer = document.createElement("div");
        drcontainer.setAttribute("class", "category-servies others-dr-container drcard");
        let drimg = document.createElement("img");
        let drserivesinfodiv = document.createElement("div");
        drserivesinfodiv.setAttribute("class", "category-servies-info-box other-dr-servies-box");
        drcontainer.addEventListener("mouseover", () => {
            drcontainer.setAttribute("id", "changecardbg");
            drserivesinfodiv.setAttribute("id", "changeinfobg");
            drbookbutton.style.background="#28B45F";
        })
        drcontainer.addEventListener("mouseout", () => {
            drcontainer.setAttribute("id", "");
            drserivesinfodiv.setAttribute("id", "");
            drbookbutton.style.background="";
        })
        let drinfo = document.createElement("div");
        drinfo.setAttribute("class", "category-servies-info other-dr-servies-info");
        drinfo.setAttribute("cardisselected","false");
        let drinfoh2 = document.createElement("h2");
        let drinfop = document.createElement("p");
        let drbookingoption = document.createElement("div");
        drbookingoption.setAttribute("class", "option-button booking-dr");
        let drbookbutton = document.createElement("button");
        drbookbutton.innerText = "Schedule";
        drserivesinfodiv.setAttribute("drisbooked", "false");
        drbookingoption.append(drbookbutton);
        drinfo.append(drinfoh2, drinfop);
        drserivesinfodiv.append(drinfo, drbookingoption);
        drcontainer.append(drimg, drserivesinfodiv);
        drcardparent.append(drcontainer);
    }
    });
    otherdrcardload(result);
}

function otherdrcardload(result) {
    let bookingsdrcard = document.querySelectorAll(".others-dr-container");
    let recommendedcard = document.getElementById("recommended-dr-box");
    const recommendeddrimg = recommendedcard.querySelector("img");
    const recommendeddoctorName = recommendedcard.querySelector("h2");
    const recommendeddrspecialty = recommendedcard.querySelector("p");
    let cardbox = recommendedcard.querySelector('.other-dr-servies-info');
    let cardselected=recommendedcard.querySelector(".other-dr-servies-box");
    for (let i = 0; i < 1; i++) {
        cardbox.setAttribute("cardisselected","false");
        cardselected.setAttribute("drisbooked", "false");
        recommendeddrimg.src = result[i].img;
        recommendeddoctorName.innerText = result[i].name;
        recommendeddrspecialty.innerText = result[i].specialist;
    }
    for (let i = 0; i < bookingsdrcard.length; i++) {
        const img = bookingsdrcard[i].querySelector('img');
        const doctorName = bookingsdrcard[i].querySelector('h2');
        const specialty = bookingsdrcard[i].querySelector('p');
        for (let j = 0; j < result.length; j++){
            img.src = result[i+1].img;
            doctorName.innerText = result[i+1].name;
            specialty.innerText = result[i+1].specialist;
        };
    }
    addclicktodrcard();
};
function popupposition(card) {
    const popup = document.getElementById('popup');
    if (popup.getAttribute("mobileversion") == 'false') {
        const cardRect = card.getBoundingClientRect();
        const topPosition = cardRect.top + window.pageYOffset;
        if (cardRect.right > window.innerWidth / 2) {
            popup.style.left = (cardRect.left - popup.offsetWidth) + 'px';
        } else {
            popup.style.left = (cardRect.right) + 'px';
        }
    }
}
function popupbooking(card) {
    const popup = document.getElementById('popup');
    const cardRect = card.getBoundingClientRect();

    const topPosition = cardRect.top + window.pageYOffset
    popup.classList.remove('hidden');
    const infoBox = card.querySelector('.category-servies-info-box.other-dr-servies-box');
    const cardbutton = card.querySelector(".option-button.booking-dr button");
    if(card.querySelector(".other-dr-servies-info").getAttribute('cardisselected')=="true"){
        if (infoBox) {
            infoBox.style.backgroundColor = '#DAA520';  // Replace this with your desired color
        }
        cardbutton.innerText = "Scheduling";
    }
    popupposition(card);

    let comfirmbtn = document.getElementById("comfirm_btn");
    
    comfirmbtn.addEventListener("click", () => {
        let slotbox = document.getElementById('slot_box');
        if (popup.getAttribute("selecteddata") == "true") {
            cardbutton.innerText = "Scheduled";
            popup.setAttribute("popupison","false");
            popup.setAttribute("showslot","false");
            infoBox.setAttribute("drisbooked", "true");
            slotbox.style.display = 'none';
            document.body.style.overflow = 'auto';
            popup.style.zIndex=0;
            popup.classList.add("hidden");

        }
    });
    if (popup.getAttribute("mobileversion") == 'false') {
        console.log(savedScrollPosition);
        popup.style.top = (topPosition - 47) + 'px';
    }
    rendercalenderandtime(card);
}

function slotdisplay(userselecteddate) {

    document.querySelectorAll('.drcard').forEach((card) => {
        const drname = card.querySelector('.category-servies-info.other-dr-servies-info h2');
        const timebox = document.getElementById("time_box");
        let userDate = new Date();
        timebox.innerHTML = "";
        const monthNames = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];
        let usermonth = monthNames[new Date().getMonth()];
        for (let i = 0; i < petsdr.length; i++) {
            if (drname.innerText == petsdr[i].name) {
                for (let j = 0; j < petsdr[i].slots.length; j++) {
                    const now = new Date();
                    const currentHour = now.getHours();
                    const currentMinutes = now.getMinutes();
                    const [start, end] = petsdr[i].slots[j].split("-");
                    const endTime = convertTo24Hour(end);
                    let popupdiv = document.getElementById("popup");

                    popupdiv.setAttribute("showslot", true);
                    let timediv = document.createElement("div");
                    timediv.setAttribute("class", "slot_available");
                    let timespan = document.createElement("span");
                    timediv.append(timespan);
                    timebox.append(timediv);
                    timespan.innerText = petsdr[i].slots[j];
                    if (isPastTime(currentHour + 1, currentMinutes, endTime) && new Date().getMonth() === userDate.getMonth() && Number(userselecteddate) === new Date().getDate()) {
                        timediv.style.background = "red"; // Change color if slot time has passed
                    }
                    popupdiv.setAttribute("selecteddata", "false");
                    timediv.addEventListener('click', () => {
                        if (timediv.style.background != "red") {
                            let bookeddate = document.getElementById("bookeddate");
                            let bookedtime = document.getElementById("bookedtime");
                            bookeddate.innerText = `${userselecteddate}${usermonth}`;
                           bookedtime.innerText = petsdr[i].slots[j];
                            popupdiv.setAttribute("selecteddata", "true");
                        }
                    })
                }
            }
        }
    });
}
function convertTo24Hour(time) {
    const match = time.match(/\d+|\D+/g); // Split into digits and non-digits
    if (!match || match.length < 2) {
        return null; // Return null or handle error accordingly
    }
    let [hour, period] = time.match(/\d+|\D+/g); // Splits time (e.g., "9am" to ["9", "am"])
    hour = parseInt(hour, 10);
    if (period.toLowerCase() === "pm" && hour !== 12) hour += 12;
    if (period.toLowerCase() === "am" && hour === 12) hour = 0;
    return hour;
}
function isPastTime(currentHour, currentMinutes, endHour) {
    return currentHour > endHour || (currentHour === endHour && currentMinutes > 0);
}
function addclicktodrcard() {
    document.querySelectorAll('.drcard').forEach((card) => {
        const infoBox = card.querySelector('.other-dr-servies-box');
        if (infoBox.getAttribute('drisbooked') != 'true'){
            card.addEventListener('click', () => {cardclickfun(card) });
        };
    })

}
function cardclickfun(card) {
    let popupdiv = document.getElementById("popup");
    let slotbox = document.getElementById("slot_box");
    let cardbox = card.querySelector('.other-dr-servies-info');
    let footer=document.querySelector('footer');
    popupdiv.setAttribute("mobileversion", 'false');
    popupdiv.setAttribute("popupison", "true");
    cardbox.setAttribute("cardisselected","true");
    if(window.innerWidth <= '1470') {
        popupdiv.style = "";
        popupdiv.setAttribute("mobileversion", 'true');
        let savedScrollPosition = Math.abs(window.scrollY);
        popupdiv.style.top = `${savedScrollPosition}px`;
        if(window.innerWidth < '401' && window.innerWidth > "320" ) {
            console.log(savedScrollPosition);
            popupdiv.style.top = `${savedScrollPosition-7}px`;
        }
        if(popupdiv.getAttribute("mobileversion") == "true" && popupdiv.getAttribute("popupison") == "true") {
            document.body.style.overflow = 'hidden';
            popupdiv.style.zIndex=200;
        }
        closeicon.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
    }
    checkcardisselected();
    slotbox.style.display = 'none';
    popupdiv.setAttribute("showslot", false);
    popupbooking(card);
    window.addEventListener('resize', () => {
        if (window.innerWidth <= '1470'){
            popupdiv.style="";
            popupdiv.setAttribute("mobileversion", 'true');
            let savedScrollPosition = Math.abs(window.scrollY);
            popupdiv.style.top = `${savedScrollPosition}px`;
            if (window.innerWidth < '401' && window.innerWidth > "320") {
                console.log(savedScrollPosition);
                popupdiv.style.top = `${savedScrollPosition-7}px`;
            }
            if (popupdiv.getAttribute("mobileversion") == "true" && popupdiv.getAttribute("popupison") == "true") {
                document.body.style.overflow = 'hidden';
                popupdiv.style.zIndex=200;
            }
            closeicon.setAttribute('class', 'fa-solid fa-xmark fa-2xl');
        }
        else {
            popupdiv.setAttribute("mobileversion", 'false');
            document.body.style.overflow = 'auto';
            popupdiv.style.zIndex=0;
            if( popupdiv.getAttribute("showslot")=="true"){
                popupbooking(card);
            }
        }
        if (popupdiv.getAttribute("popupison")=="true") {
            popupbooking(card);
        }
    });
}
function checkcardisselected() {
    let otherdrserviesbox = document.querySelectorAll('.other-dr-servies-box');
    otherdrserviesbox.forEach((element) => {
        if (element.getAttribute('drisbooked') != 'true') {
            element.style.backgroundColor = '#28B45F';
            element.querySelector(".booking-dr button").innerText = "Schedule";
        }
    })
}
function rendercalenderandtime(card) {
    let timebox = document.getElementById("time_box");
    let datebox = document.getElementById("date_box");
    datebox.innerHTML = "";
    let user_date = new Date();
    const monthNames = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];
    let usermonth = monthNames[user_date.getMonth()]

    if (user_date.getDate() == Number(calender[0][usermonth][calender[0][usermonth].length - 1])) {
        user_date.setMonth(user_date.getMonth() + 1);
        usermonth = monthNames[user_date.getMonth()]
    }

    for (let i = 0; i < calender[0][usermonth].length; i++) {
        let calendardatediv = document.createElement("div");
        calendardatediv.setAttribute("class", "calendar_dates");
        let calendardatespan = document.createElement("span");
        calendardatediv.append(calendardatespan);
        datebox.append(calendardatediv);
        calendardatespan.innerText = calender[0][usermonth][i];
        if (Number(calendardatespan.innerText) < user_date.getDate() && user_date.getMonth() === new Date().getMonth()) {
            calendardatediv.style.background = "red";
        }
        calendardatediv.addEventListener("click", () => { calendarsdateclickfun(calendardatediv,card) })
    }
}
function calendarsdateclickfun(calendardatediv,card) {
    if (calendardatediv == undefined) {
        return
    }
    let calendarbox = document.getElementById('calender_box');
    let popup = document.getElementById('popup');
    let slotbox = document.getElementById('slot_box');
    if (calendardatediv.style.background != "red") {
        const selectedDate = calendardatediv.querySelector('span').innerText;
        popup.setAttribute('showslot', true);
        slotdisplay(selectedDate);
        popupposition(card);
        slotbox.style.display = 'Block';
        popup.setAttribute('showslot', 'true');
    }
}





let closeicon = document.getElementById("closeicon");
let popup = document.getElementById('popup');
let slotbox1 = document.getElementById("slot_box");
let footer=document.querySelector('footer');
closeicon.addEventListener("click", () => {
    let cardbox = document.querySelectorAll('.other-dr-servies-info');
    for (let index = 0; index < cardbox.length; index++) {
        if(cardbox[index].getAttribute("cardisselected")=="true"){
           cardbox[index].setAttribute("cardisselected","false");
        }
    }
    slotbox1.style.display = 'none';
    document.body.style.overflow = 'auto';
    popup.style.zIndex=0;
    popup.classList.add("hidden");
    popup.setAttribute("popupison", "false");
    checkcardisselected();
})


if(!document.getElementById("bookedtime").querySelector('span')==""){

    document.getElementById("comfirm_btn").addEventListener("click", function() {
        let bookedDate = document.getElementById("bookeddate").innerText;
        let bookedTime = document.getElementById("bookedtime").innerText;
        fetch("https://zenpet.onrender.com/BookAppointment.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ date: bookedDate, time: bookedTime })
        })
        .then(response => response.text())
        .then(data => {
            alert("Booking confirmed!");
        })
        .catch(error => console.error("Error:", error));
    });
    fetch('https://zenpet.onrender.com/BookAppointment.php', { /*...*/ })
    .then(response => response.text())
    .then(data => {
    });
}
window.addEventListener('load',()=>{
    const infoBox = document.querySelectorAll('.category-servies-info-box.other-dr-servies-box');
    infoBox.forEach(element => {
        const cardbutton = element.querySelector(".option-button.booking-dr button");
       
        if (element.getAttribute('drisbooked') == 'true') {
            cardbutton.innerText = "Scheduled";
            element.style.backgroundColor="rgb(218, 165, 32)";
        }
    });
    let petcategorybox=document.querySelectorAll(".pet-category");
    let drcategorytype=document.querySelectorAll(".dr-category-type");
    let recommendeddrsection=document.getElementById("recommended-dr-section");
    let otherdrsection=document.getElementById("other-dr-section");
    let drcardparent = document.getElementById("other-dr-info-parent");
   let petservicescardselected;
    for (let i = 0; i < petcategorybox.length; i++) {
     petcategorybox[i].addEventListener('click',()=>{
        petservicescardselected =petcategorybox[i]
        petcategorybox[i].querySelector(".category-button").innerText="Selected";
        for (let j = 0; j < drcategorytype.length; j++) {
            drcategorytype[j].style.display="block";

        }
    })
    }
    
    for (let i = 0; i < drcategorytype.length; i++) {
        drcategorytype[i].addEventListener('click',()=>{
            drcardparent.innerHTML="";
            petservicescardselected =drcategorytype[i].querySelector(".category-servies-info-box").querySelector(".category-servies-info").outerText;
            drcategorytype[i].querySelector(".category-button").innertext="Selected";
            recommendeddrsection.style.display="block";
            otherdrsection.style.display="block";
            setinfoincard(petservicescardselected);
        })
    }
});
