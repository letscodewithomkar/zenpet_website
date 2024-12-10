import {
    toyproduct,
    foodproduct
} from "./product.js";


let hearticon =document.getElementById("hearticon");

hearticon.addEventListener("click",()=>{
    if(hearticon.classList.contains("fa-regular") ) {
        hearticon.classList.add("fa-solid");
        hearticon.classList.remove("fa-regular");
    }else{
        hearticon.classList.add("fa-regular");
        hearticon.classList.remove("fa-solid");
    }
})
let categorymerge=[...toyproduct,...foodproduct];
let selectedproduct=[];
function fillterproduct() {
    let productlist=Object.values(categorymerge)
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const usersearchinput = urlParams.get('product');
    for (let i = 0; i < productlist.length; i++) {
        if (productlist[i].name.includes(usersearchinput)) {
            selectedproduct.push(categorymerge[i]);
        }        
    }
}
function loaddatatopage(params) {
    const imgpath="./webimg/productimgs/otherimgs/";
    const mainimgpath="./webimg/productimgs/otherimgs/";
    let productdiscription=document.getElementById("product-discription");
    let productdiscriptionspan=productdiscription.querySelector("span");
    let infosection=document.getElementById("infosection");
    let infosectionh2=infosection.querySelector("h2")
    let priceinfo=document.getElementById("price-info");
    let img=document.createElement('img');
    let productotherimg=document.getElementsByClassName("product-otherimg");
    let mainname=selectedproduct[0].name.replace('%20',"");
    for (let i = 1; i <= productotherimg.length; i++) {
        let img=document.createElement('img');  
        productotherimg[i-1].src=`${imgpath}${mainname} img${i+1}.jpg`;
    }
    let mainimgdiv=document.getElementById("mainimg");
    let mainimgtag=mainimgdiv.querySelector("img");
    infosectionh2.innerText=selectedproduct[0].name
    priceinfo.innerText=`₹ ${selectedproduct[0].price}`.toLocaleString();
    productdiscriptionspan.innerHTML=selectedproduct[0].description;
     mainimgtag.src=`${selectedproduct[0].img}`;
}

fillterproduct();
loaddatatopage();
let searchicon=document.getElementById("search-icon");
let searcharea=document.getElementById("search-area");

searchicon.addEventListener("click",()=>{
let searchareainput=searcharea.querySelector("input");
let currenturl= "shop.php";
let userinput=searchareainput.value
window.location.href=`${currenturl}?product=${userinput}`;
});

let searchinput=searcharea.querySelector("input");
searchinput.addEventListener("keyup",(element)=>{
     if(element.keyCode==13){
    let currenturl= "shop.php";
    let userinput=searchinput.value
     window.location.href=`${currenturl}?product=${userinput}`;
     }
});


    function checktotallist(listparent){
        let defaultlimt=3;
        const wishlistsectionbox=document.querySelector(".wishlist-box");
        let wishlist_cards=document.querySelector(".wishlist-cards")
        if(window.screen.width <= 1000){
            defaultlimt=5;
        }
        if (window.screen.width <= 766 && window.screen.width >250) {
            wishlist_cards.style = "margin-top: 160px"
        }
     if(wishlistsectionbox.children.length>defaultlimt){
        wishlistsectionbox.classList.add("scrollable");
     }else{
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
 let wishlistclosearrow=document.getElementById("wishlist_close_arrow");
 let wishlistsection=document.getElementById("wishlist-section");
 let facartshopping=document.getElementsByClassName("fa-cart-shopping");
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
function changeaddnumber(plusicon,quantityInput,retrievedcart){
    let grandparent;
        plusicon.addEventListener('click', (event) => {
            const parentElement = event.currentTarget.parentNode;
            grandparent = parentElement.parentElement;
            for (let i = 0; i < retrievedcart.length; i++) {
                if(grandparent.innerText==retrievedcart[i].name){
                    retrievedcart[i].quantity+=1;
                    quantityInput.value= retrievedcart[i].quantity
                    checktotalprice(retrievedcart);
                } 
            }
        })
        
    }

    function checktotalprice(retrievedcart) {
        let Totalamountofproduct=0;
        const Totalamount=document.getElementById("totallistvalue");
        for (let i = 0; i < retrievedcart.length; i++) {
            Totalamountofproduct+= retrievedcart[i].price * parseFloat(retrievedcart[i].quantity);
            Totalamount.innerHTML=`Total Amount : ${Totalamountofproduct.toLocaleString()}`;
    }
    localStorage.setItem('cartlist', JSON.stringify(retrievedcart));
    }
    function changeminusnumber(miunsIcon,quantityInput,retrievedcart,userselectedwishlist,trashIcon){
        let grandparent;
        miunsIcon.addEventListener('click', (event) => {
            const parentElement = event.currentTarget.parentNode;
            grandparent = parentElement.parentElement;
            for (let i = 0; i < retrievedcart.length; i++) {
                if(grandparent.innerText==retrievedcart[i].name){
                    if(retrievedcart[i].quantity==1){
                        userselectedwishlist=[];
                        userselectedwishlist.push(retrievedcart[i]);
                        munisicondeleteelement=true;
                        changetrashelement(event,userselectedwishlist);   
                      return
                    }
                    retrievedcart[i].quantity-=1;
                    quantityInput.value= retrievedcart[i].quantity
                    checktotalprice(retrievedcart);
                }
            }
        })
    }
    let elementdeleted=false;
let munisicondeleteelement=false;
function attachTrashEvent( userselectedwishlist,trashIcon) {
   trashIcon.addEventListener('click', (event) => {
       changetrashelement(event, userselectedwishlist);
   });
}
function changetrashelement(event,userselectedwishlist) {
    let grandparent;
    let fillbag=document.querySelectorAll(".fillbag");
            const parentElement = event.currentTarget.parentNode;
            grandparent = parentElement.parentElement;
            const h2Element = grandparent.querySelector('h2');
            for (let i = 0; i < retrievedcart.length; i++) {
            if(!munisicondeleteelement){

            if(h2Element.innerText==retrievedcart[i].name){
                userselectedwishlist=[];
                userselectedwishlist.push(retrievedcart[i]);
                retrievedcart.splice(i, 1);
                elementdeleted=true;
                addwishlist(userselectedwishlist);
            }
        }else{
            if(userselectedwishlist[0].name==retrievedcart[i].name){
                retrievedcart.splice(i, 1);
                elementdeleted=true;
                addwishlist(userselectedwishlist);
                munisicondeleteelement=false;
                elementdeleted=false;
        }
     }
     localStorage.setItem('cartlist', JSON.stringify(retrievedcart));
    }

    elementdeleted=false;
}

let retrievedcart=[];
let currentcartlist;
let listfromlocalstorage=false;
function getwishlist(params) {

    if(JSON.parse(localStorage.getItem('cartlist'))!=null){
        let userselectedwishlist=[]; 
        listfromlocalstorage=true;
        retrievedcart = JSON.parse(localStorage.getItem('cartlist'));
        addwishlist(userselectedwishlist);
    }
}
function addwishlist(userselectedwishlist) {
    const wishlistsectionbox=document.querySelector(".wishlist-box");
    wishlistsectionbox.innerHTML="";
    if(userselectedwishlist.length!=0){
        let existsInCart=false;
                        for (let i = 0; i < retrievedcart.length; i++) {
                             if(retrievedcart !== null && retrievedcart.length!== 0){
                                 if(userselectedwishlist[0].name==retrievedcart[i].name){
                                  existsInCart = true;
                                  return
                             }
                             }
                    }
                    if(existsInCart!=true && !elementdeleted){
                        
                       retrievedcart.push(userselectedwishlist[0]);
                    }
            localStorage.setItem('cartlist', JSON.stringify(retrievedcart));
    

    }
    if (retrievedcart != null && retrievedcart.length>0){
        for (let i = 0; i < retrievedcart.length; i++) {
   const listparent=document.createElement("div"); 
   const imgandnamediv=document.createElement("div");
   imgandnamediv.setAttribute("class",`imgandnamediv`);
   const wishlistinfodiv=document.createElement("div");
   wishlistinfodiv.setAttribute("class",`parentcontanier`);
   listparent.setAttribute("class", `wishlist-cards`);
   const listname=document.createElement("h2");
   listname.innerText=retrievedcart[i].name;
   const liststorediv=document.createElement("div");
   liststorediv.setAttribute("class", `quantity`);
   const imgelement=document.createElement("img");
   imgelement.src=retrievedcart[i].img;
   const plusicon=document.createElement("i");
   plusicon.classList.add('fa-solid', 'fa-plus', 'fa-lg','plusicon');
   const quantityInput = document.createElement('input');
    quantityInput.type = 'text';
    quantityInput.inputmode = 'numeric';
    quantityInput.name = 'numberholder';
    quantityInput.value=retrievedcart[i].quantity;
const miunsIcon = document.createElement('i');
miunsIcon.classList.add('fa-solid', 'fa-minus', 'fa-lg','minusicon');
const trashIcon = document.createElement('i');
trashIcon.classList.add('fa-solid', 'fa-trash', 'fa-lg','trashicon');
if(window.screen.width<"500px"){
    plusicon.classList.add('fa-solid', 'fa-plus', 'fa-sm','plusicon');
    miunsIcon.classList.add('fa-solid', 'fa-minus', 'fa-sm','minusicon')
    trashIcon.classList.add('fa-solid', 'fa-trash', 'fa-sm','trashicon');
}
liststorediv.append(plusicon,quantityInput,miunsIcon,trashIcon);
imgandnamediv.append(imgelement,listname);
wishlistinfodiv.append(imgandnamediv,liststorediv);
listparent.append(wishlistinfodiv); 
wishlistsectionbox.append(listparent);
changeaddnumber(plusicon,quantityInput,retrievedcart);
changeminusnumber(miunsIcon,quantityInput,retrievedcart,userselectedwishlist,trashIcon);
attachTrashEvent(userselectedwishlist,trashIcon);
checktotalprice(retrievedcart);
    }
}
let cartlisttotalnumber=document.querySelector("#total_product_in_cart span");
cartlisttotalnumber.innerText=retrievedcart.length;
}
function whishlistresponzie(params) {
    const plusicon= document.querySelectorAll('.plusicon'); // Replace '.fa-icon' with your actual class selector
    const minusicon= document.querySelectorAll('.minusicon');
    const trashelementIcon = document.querySelectorAll(".trashicon");
    let wishlist_cards = document.querySelector(".wishlist-cards");
    if(wishlist_cards!=null){
        if (window.screen.width <= 766 && window.screen.width >250) {
            wishlist_cards.style = "margin-top: 160px"
        }
    }
    if (window.innerWidth < 500) {
        plusicon.forEach(function(plusicon) {
        
        plusicon.classList.add('fa-sm');
    });
    minusicon.forEach(function(minusicon) {
        minusicon.classList.add('fa-sm');
    })
    trashelementIcon.forEach(function(trashelementIcon) {
        trashelementIcon.classList.add('fa-sm');
    })
    } 
    else if(window.innerWidth < 767 && window.innerWidth > 500 ) {
        plusicon.forEach(function(plusicon) {
        plusicon.classList.remove('fa-lg'); 
    });
   
    minusicon.forEach(function(minusicon) {
        minusicon.classList.remove('fa-lg'); 
    });
    trashelementIcon.forEach(function(trashelementIcon) {
        trashelementIcon.classList.remove('fa-lg'); 
    });
}
else{
    plusicon.forEach(function(plusicon) {
        plusicon.classList.add('fa-lg');
    });
    minusicon.forEach(function(minusicon) {
        minusicon.classList.add('fa-lg');
    })
    trashelementIcon.forEach(function(trashelementIcon) {
        trashelementIcon.classList.add('fa-lg');
    })
}
getwishlist();
 }
 window.addEventListener('resize', whishlistresponzie);
 window.addEventListener('load', whishlistresponzie);