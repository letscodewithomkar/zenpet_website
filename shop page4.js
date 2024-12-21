import {
    toyproduct,
    foodproduct
} from "./product.js";


var lowerSlider = document.querySelector('#lower');
var upperSlider = document.querySelector('#upper');

document.querySelector('#two').value = upperSlider.value;
document.querySelector('#one').value = lowerSlider.value;

var lowerVal = parseInt(lowerSlider.value);
var upperVal = parseInt(upperSlider.value);
upperSlider.oninput = function () {

    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);


    if (upperVal < lowerVal + 4) {
        lowerSlider.value = upperVal - 4;
        if (lowerVal == lowerSlider.min) {
            upperSlider.value = 4;
        }
    }

    document.querySelector('#two').value = this.value

};

lowerSlider.oninput = function () {
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);
    if (upperVal <= lowerVal) {
        document.querySelector('#two').value = upperVal + 4;
    }
    if (lowerVal > upperVal - 4) {
        upperSlider.value = lowerVal + 4;
        if (upperVal == upperSlider.max) {
            lowerSlider.value = parseInt(upperSlider.max) - 4;
        }
    }
    document.querySelector('#one').value = this.value

};

let pricevalue, categoryvalue, brandvalue

let pricefoodfilter, categoryfoodfilter, categorytoyfilter, brandfoodfilter, brandtoyfilter
let allproducts = [];
let nextpagebotton = document.getElementById("nextpage")
let pevpagebotton = document.getElementById("prevpage");
nextpagebotton.setAttribute("nextbtnison", "false");
pevpagebotton.setAttribute("pevbtnison", "false");
var lowerVal = lowerSlider.value;
var upperVal = upperSlider.value;
let checkbrandoption = false
let checkcategoryoption = false
let checkpriceoption = false


function priceelement(params) {

    let pricemerge = [...foodproduct, ...toyproduct]
    pricefoodfilter = pricemerge.filter((x) => { return x.price >= lowerVal && x.price <= upperVal });
    if (pricefoodfilter != null || undefined || NaN && !pricefoodfilter.length < 0) {
        if (!allproducts.includes(pricefoodfilter)) {
            allproducts.push(pricefoodfilter)
        }
    }
}


function categoryelement(userhomeseletedcategory, selectedCategoryurl, usersearchinput, userselctedcardwishlist) {
    allproducts = [];
    let categoryischeck = 0;
    let category = document.getElementsByName("categories");
    let categorymerge = [...foodproduct, ...toyproduct];
    for (let i = 0; i < category.length; i++) {
        if (category[i].checked || userhomeseletedcategory == true) {
            categoryischeck++;
            categoryvalue = category[i].checked ? category[i].value : "" || selectedCategoryurl;
            let usersearchinputLowerCase = usersearchinput?.toLowerCase().trim() || "";
            if (checkbrandoption == false) {
                categoryfoodfilter = categorymerge.filter((elements) => {
                    let productnamelowercase = elements.name.toLowerCase().trim();
                    let checkmatch = categoryvalue !== undefined || null ? elements.category.includes(categoryvalue) : false;
                    if (checksearchison) {
                        return elements.price >= lowerVal && elements.price <= upperVal && elements.category.includes(`${categoryvalue}`) || productnamelowercase.includes(`${usersearchinputLowerCase}`);
                    } else {
                        return elements.price >= lowerVal && elements.price <= upperVal && elements.category.includes(`${categoryvalue}`);
                    }
                });
            }
            else {
                categoryfoodfilter = categorymerge.filter((elements) => {
                    let brandvaluelowercase = brandvalue.toLowerCase().trim();
                    let datanamevaluelowercase = elements.name.toLowerCase().trim();
                    return elements.price >= lowerVal && elements.price <= upperVal && datanamevaluelowercase.includes(brandvaluelowercase) || usersearchinputLowerCase && elements.category.includes(categoryvalue);
                })
            }
            if (categoryfoodfilter === null || categoryfoodfilter === undefined || !categoryfoodfilter.length <= 0) {
                allproducts.push(...categoryfoodfilter);
                break;
            }
        }
    }
}


function brandelement(params) {
    let brandischeck = 0;
    var brand = document.getElementsByName("brand");
    
    let brandmerge = [...foodproduct, ...toyproduct];
    brandfoodfilter = brandmerge.filter((elements) => {

        return elements.price >= lowerVal && elements.price <= upperVal && elements.name.includes(`${brandvalue}`)
    })
    if (brandfoodfilter != null || undefined || NaN && !brandfoodfilter.length < 0) {
        if (!allproducts.includes(brandfoodfilter)) {
            allproducts.push(brandfoodfilter);
        }
    }
}

let myproducts;
let shoecards = document.getElementById("shoecards");
let filterbotton = document.getElementById("mybtn");


let errormassage = document.getElementById("error-div");
let currentPage = 1;
const urlParts = window.location.href.split('/');
const pageNumber = urlParts[urlParts.length - 1];
if (pageNumber.includes("page")) {
    currentPage = pageNumber.slice(-1);
};
filterbotton.addEventListener("click", () => {
    allproducts.length = 0;
    const shopSectionBox = document.getElementById('shopsection-box');
    if (shopfilter.getAttribute('filterison') === 'true') {
        shopSectionBox.style.minHeight = '120vh';
    } else {
        shopSectionBox.style.minHeight = '';
    }
    let category = document.getElementsByName("categories");
    let price = document.getElementsByName("price");
    let brand = document.getElementsByName("brand");
    for (let i = 0; i < category.length; i++) {
        if (category[i].checked) {
            checkcategoryoption = true;
        }
    }
    for (let i = 0; i < brand.length; i++) {
        if (brand[i].checked) {
            brandvalue = brand[i].value;
            checkbrandoption = true;
        }
    }
    if (checkcategoryoption == false && checkbrandoption == false) {
        priceelement();
    }
    if (checkcategoryoption == false && checkbrandoption == true) {
        brandelement();
    }

    if (checkcategoryoption == true) {
        categoryelement();

    }
    if (currentPage > Math.ceil(allproducts.length / defaultCardCount)) {
        currentPage = Math.ceil(allproducts.length / defaultCardCount);
        if (currentPage == 0) {
            currentPage = 1;
        }
        window.location.hash = `/page${currentPage}`;
    }
    verifydata();
    shoecards.innerHTML = "";
    if (allproducts.length == 0 || categoryfoodfilter.length == 0) {
        currentPage = 1;
        errormassage.style.display = "flex"
    } else {
        errormassage.style.display = "none"
    }
    bydefaultcarddata();
    changefillbagicon();
})

let verifydata = () => {

    if (checkbrandoption && checkpriceoption && checkcategoryoption == false) {
        myproducts = foodproduct
    } else {
        myproducts = allproducts
    }
}
verifydata();


const defaultCardCount = 6;
function bydefaultcarddata(userselctedcardwishlist) {  
    const startIndex = (currentPage - 1) * defaultCardCount;
    const endIndex = Math.min(startIndex + defaultCardCount, allproducts.length);
    if(allproducts.length-startIndex <=6 &&currentPage==1){ //look here
        if(checksearchison){
        nextpagebotton.style.display = "none";
        pevpagebotton.style.display = "none";
        
        }
        else{
        nextpagebotton.style.display = "none";
        }
      }else if(allproducts.length-startIndex <=6 &&currentPage>1){ //look here
        nextpagebotton.style.display = "none";
        
      }
      else if( endIndex>= allproducts.length){
        nextpagebotton.style.display = "none";
      }
      else if(startIndex==0){
        pevpagebotton.style.display = "none";
      }
      else{
        nextpagebotton.style.display = "block";
        pevpagebotton.style.display = "block";
      }

    for (let x = startIndex; x < endIndex; x++) {
    let parentcard = document.createElement("div");
    parentcard.setAttribute("class", `cards card${x + 1}`);
    let cardimg = document.createElement("img");
    cardimg.setAttribute("src", `${allproducts[x].img}`);
    let childcard = document.createElement("div");
    childcard.setAttribute("class", "cardinfo");
    let childheader = document.createElement("h2");
    childheader.innerHTML = `${allproducts[x].name}`;
    let divpriceicon=document.createElement("div");
    let childspan = document.createElement("span");
    childspan.innerHTML = `₹ ${allproducts[x].price}`;
    let wishlisticon=document.createElement("i");
    wishlisticon.classList.add("bx","bx-shopping-bag","bx-sm" ,"fillbag");
    wishlisticon.setAttribute("removefromcart","false");
    wishlisticon.style.color="#28B45F";
    wishlisticon.style.margin="0px 0px 0px 15px";
    wishlisticon.setAttribute("data-product-name",allproducts[x].name);
    childcard.append(childheader);
    childcard.append(divpriceicon);
    divpriceicon.append(childspan);
    divpriceicon.append(wishlisticon);
    parentcard.append(cardimg);
    parentcard.append(childcard);
    
    shoecards.append(parentcard);
    eventoncard(parentcard);
    
}
fillterbag();
}
function fillterbag(params) {
    let fillbag=document.querySelectorAll(".fillbag");
    let userselectedwishlist=[]; 
    let startIndexoflist = (currentPage - 1) * defaultCardCount;
    let endIndexoflist = Math.min(startIndexoflist + defaultCardCount, allproducts.length);
    let currentproduct=[];
    for (let x = startIndexoflist; x <endIndexoflist; x++) {
        currentproduct.push(allproducts[x]);
    }
    for (let i = 0; i < fillbag.length; i++) {
        if (!fillbag[i].hasAttribute("data-has-event")) {
            fillbag[i].setAttribute("data-has-event","true");
            fillbag[i].addEventListener("mouseover",(element)=>{
                document.body.style.cursor = "pointer";
            });
            fillbag[i].addEventListener("mouseout",(element)=>{
                document.body.style.cursor = "default";
            });
            fillbag[i].addEventListener("click",(element)=>{
                if (fillbag[i].classList.contains("bxs-shopping-bag")) {
                    fillbag[i].setAttribute("removefromcart", "true");
                }
            const hasClass = fillbag[i].classList.contains("bx-shopping-bag"); 
            element.stopPropagation();
            if (hasClass) {
                fillbag[i].classList.remove("bx-shopping-bag");
                fillbag[i].classList.add("bxs-shopping-bag");
                userselectedwishlist=[];
                userselectedwishlist.push(currentproduct[i]);
                userselectedwishlist[0].quantity=1;
                addwishlist(userselectedwishlist,element);
            } else {
            if (fillbag[i].getAttribute("removefromcart") === "true") {
                fillbag[i].classList.remove("bxs-shopping-bag");
                fillbag[i].classList.add("bx-shopping-bag");
                changetrashelement(element,userselectedwishlist)
            }
        }
        updateCart(retrievedcart);
    });
    }
    }
    }
    let categories = document.getElementsByName("categories");
    let currentoptionbotton;

function checkfillteroption(selectedCategory){
    
    let allRadioInputs=document.getElementsByName("brand");
    let brandscategory = {
        "food":['Pedigree','Purepet','Chappi','Canine-Creek'],
        "toy":['Fofos','Basil','Bark-Out-Loud']
    };
    let brandnameall=document.getElementsByName("brand");
            brandnameall.forEach(element => {
               let nextelementofbrand =element.nextElementSibling;
               element.disabled = true;
               element.style.opacity = 0.5;
               nextelementofbrand.style.opacity=0.5;

            });
    

   let filteredradioinput=[];
   for (let i = 0; i < allRadioInputs.length; i++) {
    if(brandscategory[selectedCategory].includes(allRadioInputs[i].id)){
        filteredradioinput.push(allRadioInputs[i]);
    }
    else{
    }
   }
   for(let i=0;i<1;i++){
   
    for(let i=0;i<brandscategory[selectedCategory].length;i++){
            let labelElement = document.querySelector(`label[for="${brandscategory[selectedCategory][i]}"]`);
            let brandnameall=document.getElementsByName("brand");  
                if (filteredradioinput[i].id == brandscategory[selectedCategory][i]) {
                    filteredradioinput[i].disabled = false;
                    filteredradioinput[i].style.opacity = 1;
                    labelElement.style.opacity=1
                } else {
                    filteredradioinput[i].disabled = true;
                    filteredradioinput[i].style.opacity = 0.5;
                    labelElement.style.opacity=0.5;
                }
         };               
    };   
};

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
})
 function handleRadioClick(event) {
    if (event.target.tagName !== "INPUT" || event.target.type !== "radio") {
      return;
    }
  
    const clickedRadio = event.target;
    checkfillteroption(clickedRadio.value);
  }
let filteroptions2=document.getElementById("filter-options2"); 
    filteroptions2.addEventListener("click",handleRadioClick);
nextpagebotton.addEventListener('click',function() {
    if (currentPage < Math.ceil(allproducts.length / defaultCardCount)) {
        nextpagebotton.setAttribute("nextbtnison","true");
      currentPage++;
      shoecards.innerHTML="";
      window.location.hash = `/page${currentPage}`;
      bydefaultcarddata();
      changefillbagicon();
      
    }

  });
pevpagebotton.addEventListener('click',function() {
    if (currentPage > 1) {
        pevpagebotton.setAttribute("pevbtnison","true");
      currentPage--;
      shoecards.innerHTML="";
      window.location.hash = `/page${currentPage}`;
      bydefaultcarddata();
      changefillbagicon();
    }
  });

let filterbox = document.getElementById("filter-box")
let fliterboxspam = document.getElementById("filter-box-text")
let shopfilter = document.getElementById("shop-filter")
let shopnamefilter = document.getElementById("shop-name-filter")
let shopsectionbox = document.getElementById("shopsection-box")
let btn1 = document.getElementById("btn1")
let optionsitem = document.querySelectorAll(".options-items")
let arrow = document.querySelectorAll(".arrow")
let filteroptions1 = document.getElementById("filter-options1")

let filteroptions3 = document.getElementById("filter-options3")
let arrow1 = document.getElementById("arrow1")
let arrow2 = document.getElementById("arrow2")
let arrow3 = document.getElementById("arrow3")

filterbox.addEventListener("click", () => {
    if (shopnamefilter.getAttribute("data-hidden") == "false") {
        shopfilter.style.display = "block";
        fliterboxspam.innerText = "Hide Filter";

        shopnamefilter.setAttribute("data-hidden", "true");
        shopsectionbox.setAttribute("data-hidden", "true");
        if (screen.width < 920) {
            document.body.style.overflow = "hidden";
        }
        if (screen.width > 920) {
            shopsectionbox.style.translate = "15% 0px";
        }
    } else {
        shopfilter.style.display = "none";
        shopsectionbox.style.translate = "0% 0px";

        fliterboxspam.innerText = "Show Filter"
        shopnamefilter.setAttribute("data-hidden", "false");
        shopsectionbox.setAttribute("data-hidden", "false");
    }
})
function checktotallist(listparent){
    let defaultlimt=3;
    const wishlistBox = document.querySelector('.wishlist-box');
    let wishlist_cards=document.querySelector(".wishlist-cards")
    if(window.screen.width <= 1000){
        defaultlimt=5;
    }
    if (wishlist_cards.length > 0) {
        const lastCard = wishlist_cards[wishlist_cards.length - 1];
        const lastCardBottom = lastCard.offsetTop + lastCard.offsetHeight;
        const boxBottom = wishlistsectionbox.offsetTop + wishlistsectionbox.offsetHeight;

        if (lastCardBottom > boxBottom) {
            wishlistsectionbox.classList.add('scrollable');
        } else {
            wishlistsectionbox.classList.remove('scrollable');
        }
    }
 };
 
 let wishlistclosearrow=document.getElementById("wishlist_close_arrow");
 let wishlistsection=document.getElementById("wishlist-section");
 let facartshopping=document.getElementsByClassName("fa-cart-shopping");
 let totalproductincart = document.querySelector("#total_product_in_cart span");
 facartshopping[0].addEventListener("click",()=>{
    if(facartshopping[0].getAttribute("cartison")=="true"){
        wishlistsection.style.display="none";
        facartshopping[0].setAttribute("cartison","false");
    }else{
        wishlistsection.style.display="flex";
        facartshopping[0].setAttribute("cartison","true");
        adjustWishlistBox();
    }
    wishlistclosearrow.addEventListener("click",()=>{
       wishlistsection.style.display="none";
       facartshopping[0].setAttribute("cartison","false");
    });
 });
 totalproductincart.addEventListener("click",()=>{
    if(facartshopping[0].getAttribute("cartison")=="true"){
        wishlistsection.style.display="none";
        facartshopping[0].setAttribute("cartison","false");
    }else{
        wishlistsection.style.display="flex";
        facartshopping[0].setAttribute("cartison","true");
        adjustWishlistBox();
    }
    wishlistclosearrow.addEventListener("click",()=>{
       wishlistsection.style.display="none";
       facartshopping[0].setAttribute("cartison","false");
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
            if(retrievedcart!=null || []){
                localStorage.setItem('cartlist', JSON.stringify(retrievedcart));
              updateCart(retrievedcart);
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
if(retrievedcart!=null || []){
    localStorage.setItem('cartlist', JSON.stringify(retrievedcart));
}
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
        if(retrievedcart!=null || []){
            localStorage.setItem('cartlist', JSON.stringify(retrievedcart))
           updateCart(retrievedcart);
  
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
      updateCart(retrievedcart);
    }

    elementdeleted=false;
}
function changefillbagicon(h2Element = 0) {
    let fillbagProductName;
    let fillbag = document.querySelectorAll(".fillbag");
    if (!changefillicon) {
    if (!listfromlocalstorage) {
        // Case 1: h2Element is provided and listfromlocalstorage is false
        if (h2Element) {
            for (let i = 0; i < retrievedcart.length; i++) {
                if (h2Element.innerText.trim() === retrievedcart[i].name.trim()) {
                    for (let j = 0; j < fillbag.length; j++) {
                        fillbagProductName = fillbag[j].getAttribute('data-product-name');
                        if (fillbagProductName === retrievedcart[i].name){
                            // Toggle the icon based on the current state
                            if (fillbag[j].classList.contains('bxs-shopping-bag')){
                                fillbag[j].classList.remove('bxs-shopping-bag');
                                fillbag[j].classList.add('bx-shopping-bag');
                            } else {
                                fillbag[j].classList.remove('bx-shopping-bag');
                                fillbag[j].classList.add('bxs-shopping-bag');
                            }
                            return; // Exit after updating the correct icon
                        }
                    }
                }
            }
        }
    } else {
        // Case 2: listfromlocalstorage is true
        for (let j = 0; j < fillbag.length; j++) {
            fillbagProductName = fillbag[j].getAttribute('data-product-name');
            let productNames =retrievedcart.map(product => product.name.trim());
            if (productNames.includes(fillbagProductName.trim())) {
                if (fillbag[j].classList.contains('bx-shopping-bag')) {
                    fillbag[j].classList.remove('bx-shopping-bag');
                    fillbag[j].classList.add('bxs-shopping-bag');
                } 
              else {
                    fillbag[j].classList.remove('bxs-shopping-bag');
                    fillbag[j].classList.add('bx-shopping-bag');
                }
            }
        }
    }
}
    if (!changefillicon) {
        updateCart(retrievedcart)
        
    }
}

let retrievedcart=[];
let currentcartlist;
let listfromlocalstorage=false;
function getwishlist(params) {
    const storedCart = localStorage.getItem("cartlist");
    if (!storedCart) throw new Error("No cartlist found in localStorage");
    try {
        if (!storedCart) throw new Error("No cartlist found in localStorage");
        // Parse the cartlist and update the global variable
        retrievedcart = JSON.parse(storedCart);
        listfromlocalstorage=true;
        // Ensure retrievedcart is an array
        if (!Array.isArray(retrievedcart)) {
            console.error("Cartlist is not an array. Resetting to empty array.");
            retrievedcart = [];
        }
    } catch (error) {
        console.error("Error in getwishlist:", error);
    }
    addwishlist();
    changefillbagicon();
}
const getUsername = async () => {
    try {
        const response = await fetch("https://zenpet.onrender.com/get_username.php");
        const data = await response.json();
        return data.username; // Return the username for use in other functions
    } catch (error) {
        console.error("Error fetching username:", error);
        return null;
    }
};


const fetchCart = async () => {
        try {
            // Fetch username
            const username = await getUsername();
            if (!username) throw new Error("Username is missing or invalid");
            const response = await fetch(`https://zenpet.onrender.com/fetch_cart.php?username=${username}`);
            if (!response.ok) throw new Error(`Failed to fetch cart: ${response.status}`);
            const data = await response.json();
            // Check if the cart exists for the user
            if (!data.exists) {
                return;
            }
            // Update the global retrievedcart
            retrievedcart = data.cartlist;
    
            // Handle double-encoded JSON if needed
            if (typeof retrievedcart === "string") {
                retrievedcart = JSON.parse(retrievedcart);
            }
            // Save the cartlist to localStorage
            localStorage.setItem("cartlist", JSON.stringify(retrievedcart));
            // Call getwishlist to process cartlist
            getwishlist();
        } catch (error) {
            console.error("Error fetching cart:", error);
        }
    };
    
fetchCart();
const updateCart =async (cartlist) => {
    
    const username = await getUsername();
    if (!username) throw new Error("Username is missing or invalid");

    const dataToSend = {
        username: username,
        cartlist: JSON.stringify(cartlist) || [], // Default to an empty array if undefined/null
      };
      
      fetch('update_cart.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(dataToSend), // Convert to JSON string, even if cartlist is empty
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.message) {
          } else if (data.error) {
            console.error('Error updating cart:', data.error);
          }
        })
        .catch((error) => {
          console.error('Fetch Error:', error);
        });
      //  const data = await response.json();
};
if(retrievedcart==null ||retrievedcart==""){
let totalproductincart = document.querySelector("#total_product_in_cart span");
totalproductincart.innerText="0";
}

let changefillicon=false;
function addwishlist(userselectedwishlist=[],clickfillicon=null) {
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


changefillicon=true;

    }
}
changefillicon=false;
if(nextpagebotton.getAttribute("nextbtnison")!="true" &&pevpagebotton.getAttribute("pevbtnison")!="true"){
    nextpagebotton.setAttribute("nextbtnison","false");
    pevpagebotton.setAttribute("pevbtnison","false");
}
let cartlisttotalnumber=document.querySelector("#total_product_in_cart span");
cartlisttotalnumber.innerText=retrievedcart.length;
}
function whishlistresponzie(params) {
    const plusicon= document.querySelectorAll('.plusicon'); // Replace '.fa-icon' with your actual class selector
    const minusicon= document.querySelectorAll('.minusicon');
    const trashelementIcon = document.querySelectorAll(".trashicon");
    const wishlistsectionbox=document.querySelector(".wishlist-box");
    let wishlist_cards = document.querySelectorAll(".wishlist-cards");
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
 }
 window.addEventListener('resize', whishlistresponzie);
 window.addEventListener('load', whishlistresponzie);
let mycart=document.querySelectorAll(".my-cart")
let wishlistcontainer=document.getElementById("wishlist-section");
for(let i=0;i<mycart.length;i++){
mycart[i].addEventListener("click",()=>{
    let crossmark=document.querySelector(".crossmark");
    wishlistcontainer.style.display="block";
    crossmark.addEventListener("click",()=>{
        wishlistcontainer.style.display="none";
    });
})
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

window.addEventListener('resize', adjustWishlistBox);

function eventoncard(cards) {
    const cardElements = document.getElementsByClassName('cards');
    let productName;
    let currenturl= "buyproduct.php";
    for (const cardElement of cardElements) {
      cardElement.addEventListener("click", () => {
        productName = cardElement.querySelector('h2').textContent;
        window.location.href=`${currenturl}?product=${productName}`;
      });
  
    }
}
let checksearchison=false;
window.addEventListener("load", () => {
    const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const selectedCategoryurl = urlParams.get('category');
        const usersearchinput = urlParams.get('product');
        if(usersearchinput!=null||""||undefined){
            checksearchison=true;
        }
        let userhomeseletedcategory= false; 
        allproducts=[...foodproduct, ...toyproduct];
        function checkforerror() {
            if (allproducts.length == 0 || categoryfoodfilter.length==0) {
                currentPage=1;
                errormassage.style.display = "flex"
            } else {
                errormassage.style.display = "none"
            }
        }
        if(allproducts.length < 6){
            nextpagebotton.style.display = "none";
            pevpagebotton.style.display = "none";
          }
     if (selectedCategoryurl !== null||usersearchinput!==null) {
        userhomeseletedcategory=true;
        
        categoryelement(userhomeseletedcategory,selectedCategoryurl,usersearchinput);
        if (allproducts.length == 0 || categoryfoodfilter.length==0) {
            currentPage=1;
            errormassage.style.display = "flex"
        } else {
            errormassage.style.display = "none"
        }
        bydefaultcarddata();
      } else {
      
        bydefaultcarddata();
  
        
      }
   
})
hovercards();
function hovercards(fillbags) {
    let cards= document.querySelectorAll(".cards");
        for (let i = 0; i < cards.length; i++) {
            cards[i].addEventListener("mouseover", () => {
                cards[i].style.backgroundColor = "#28B45F";  // Change card background color on hover
                cards[i].querySelector(".cardinfo h2").style.color = "#174478"; // Change cardinfo background color on hover
                fillbags[i].style.color="#174478";
              });
              cards[i].addEventListener("mouseout", () => {
                cards[i].style.backgroundColor = "#174478";  // Reset card background color on mouseout (assuming initial color)
                cards[i].querySelector(".cardinfo h2").style.color = "#28B45F";  // Reset cardinfo background color on mouseout (assuming initial color)
                fillbags[i].style.color="#28B45F";
              });
        }
    }
window.addEventListener("resize", () => {
    if(screen.width < 920 && shopfilter.getAttribute('filterison')=="true"){
        window.scroll(0, 0);
    }
    if (screen.width < 920 && shopnamefilter.getAttribute("data-hidden") == "true") {
        shopsectionbox.style.translate = "0% 0px";
        document.body.style.overflow = "hidden";

    } else if (screen.width < 920 && shopnamefilter.getAttribute("data-hidden") == "false") {
        document.body.style.overflow = "visible"
    } else if (screen.width > 920 && shopnamefilter.getAttribute("data-hidden") == "true") {
        shopsectionbox.style.translate = "15% 0px"
    }
    if (screen.width > 920) {
        document.body.style.overflow = "visible"
    }

    if (screen.width < 920 && shopfilter.getAttribute('filterison')=="true") {
        btn1.style.display = "block"
    }
})
btn1.addEventListener("click", () => {
    if (btn1.getAttribute("data-clickbutton") == "false") {
        shopfilter.style.display = "none"
        fliterboxspam.innerText = "Show Filter"
        btn1.setAttribute("data-clickbutton", "false")
        shopnamefilter.setAttribute("data-hidden", "false")
        if (screen.width < 920) {
            document.body.style.overflow = "visible"
        }

    } else {
        shopfilter.style.display = "block"
        fliterboxspam.innerText = "Hide Filter"
        btn1.setAttribute("data-clickbutton", "true")
        shopnamefilter.setAttribute("data-hidden", "true")
    }
})
arrow1.addEventListener("click", () => {
    arrow1.classList.toggle("changerotation")
    filteroptions1.classList.toggle("hidden")

});
arrow2.addEventListener("click", () => {
    arrow2.classList.toggle("changerotation")
    filteroptions2.classList.toggle("hidden")

});
arrow3.addEventListener("click", () => {
    arrow3.classList.toggle("changerotation")
    filteroptions3.classList.toggle("hidden")

});
