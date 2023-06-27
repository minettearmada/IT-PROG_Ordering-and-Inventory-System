let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

let products = [
    {
        id: 1,
        name: 'STEAK',
        image: 'm1.PNG',
        price: 900
    },
    {
        id: 2,
        name: 'SALMON',
        image: 'm2.PNG',
        price: 850
    },
    {
        id: 3,
        name: 'CHICKEN',
        image: 'm3.PNG',
        price: 300
    },
    {
        id: 4,
        name: 'BAKED POTATO',
        image: 's1.PNG',
        price: 80
    },
    {
        id: 5,
        name: 'MASHED POTATO',
        image: 's2.PNG',
        price: 75
    },
    {
        id: 6,
        name: 'STEAMED VEGETABLES',
        image: 's3.PNG',
        price: 50
    },
    {
        id: 7,
        name: 'ICED TEA',
        image: 'd1.PNG',
        price: 55
    },
    {
        id: 8,
        name: 'ROOT BEER',
        image: 'd2.PNG',
        price: 60
    },
    {
        id: 9,
        name: 'WATER',
        image: 'd3.PNG',
        price: 20
    }
];

let listCards  = [];


// Product Cards on Main Page
function initApp(){
    products.forEach((value, key) =>{

        // TODO: DEBUG 
        // Add division
        if (key === 3 || key === 6 || key === 0) {
            // Add title based on the key
            if (key === 0){
                currentTitle = 'Main Dishes';
                currentDesc = 'You can only choose 1 main dish.';
                list.appendChild(createCategoryDiv('main-dishes'));
            } else if (key === 3) {
                currentTitle = 'Side Dishes';
                currentDesc = 'You can only choose 1 main side.';
                list.appendChild(createCategoryDiv('side-dishes'));
            } else if (key === 6) {
                currentTitle = 'Drinks';
                currentDesc = 'You can only choose 1 drink.';
                list.appendChild(createCategoryDiv('drinks'));
            }
            let titleDiv = document.createElement('div');
            titleDiv.classList.add('title');
            titleDiv.innerText = currentTitle;
            list.appendChild(titleDiv);

            let descDiv = document.createElement('div');
            descDiv.classList.add('desc');
            descDiv.innerText = currentDesc;
            list.appendChild(descDiv);
        }

        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
      

        newDiv.innerHTML = `
            <img src="assets/${value.image}">
            <div class="title">${value.name}</div>
            <div class="price">₱${value.price.toLocaleString()}.00</div>
            <button id="${key}" onclick="addToCard(${key})">Add To Card</button>`;

        list.appendChild(newDiv);
    });
}

// Helper function to create category <div> with custom class
function createCategoryDiv(className) {
    let categoryDiv = document.createElement('div');
    categoryDiv.classList.add(className);
    return categoryDiv;
  }

initApp();

function addToCard(key){
    if(listCards[key] == null){
        // copy product form list to list card
        listCards[key] = JSON.parse(JSON.stringify(products[key]));
        listCards[key].quantity = 1;

        // Disable add to cart buttons of main, side, and drinks if either
        // Disable buttons with keys 0-2 if any one of them is selected
        if (key >= 0 && key <= 2) {
            const buttons = document.querySelectorAll('.item button');
            buttons.forEach((button, index) => {
                if (index >= 0 && index <= 2) {
                    button.disabled = true;
                }
            });
        }

        // Disable buttons with keys 3-5 if any one of them is selected
        if (key >= 3 && key <= 5) {
            const buttons = document.querySelectorAll('.item button');
            buttons.forEach((button, index) => {
                if (index >= 3 && index <= 5) {
                    button.disabled = true;
                }
            });
        }

         // Disable buttons with keys 6-9 if any one of them is selected
         if (key >= 6 && key <= 8) {
            const buttons = document.querySelectorAll('.item button');
            buttons.forEach((button, index) => {
                if (index >= 6 && index <= 8) {
                    button.disabled = true;
                }
            });
        }
    }
    reloadCard();
}

// Product List Purhased on Cart
function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    
    listCards.forEach((value, key)=>{
        const product = products[key];
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
        if(value != null){
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div><img src="assets/${product.image}"/></div>
                <div>${product.name}<input type="hidden" class="name-input" value="${product.name}" name="product" size="10" onchange="updateName(${key}, this)" readonly></div>
                <div>${product.price}<input type="hidden" class="price-input" value="${product.price}" name="price" style="width: 3em" onchange="updatePrice(${key}, this)" readonly></div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div>${value.quantity}</div>
                    <input type="hidden" class="count" id="quantity-${key}" value="${value.quantity}" name="quantity" style="width: 1.8em" min="1" readonly">
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>
                <input type="hidden" class="total" value="${totalPrice}" name="total" onchange="updateQuantity(${key}, this) readonly">
                </div>`;
                listCard.appendChild(newDiv);
        }
    }) 
    total.innerText = totalPrice.toLocaleString();
    quantity.innerText = count;
}


function changeQuantity(key, quantity){
    if(quantity == 0){
        delete listCards[key];

        // Enable the keys if the product is removed in the card
        if (key >= 0 && key <= 2) {
            const buttons = document.querySelectorAll('.item button');
            buttons.forEach((button, index) => {
                if (index >= 0 && index <= 2) {
                    button.disabled = false;
                }
            });
        }

        if (key >= 3 && key <= 5) {
            const buttons = document.querySelectorAll('.item button');
            buttons.forEach((button, index) => {
                if (index >= 3 && index <= 5) {
                    button.disabled = false;
                }
            });
        }
        
        if (key >= 6 && key <= 8) {
            const buttons = document.querySelectorAll('.item button');
            buttons.forEach((button, index) => {
                if (index >= 6 && index <= 8) {
                    button.disabled = false;
                }
            });
        }

    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();

    
}