const express = require('express');
const app = express();
const moment = require('moment'); // time
const products = require('./products')
const path = require('path');
const bodyParser = require('body-parser');


app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));
app.use(express.static(path.join(__dirname, 'public'))); // set static folder
app.use(bodyParser.urlencoded({ extended: true }));

// Get ALL products
app.get('/api/products', (req, res) => res.json(products));

app.get('/', (req, res) => {
    res.render('index');
});

app.post('/payment', (req, res) => {
      // Check if the request came from the checkout button
      console.log("PAYMENT")
      console.log("Products:", req.body.product)
      console.log("Price:",req.body.price)
      console.log("Quantity:",req.body.quantity)

      console.log("Current Date:", moment().format())
    if (req.body && req.body.checkout) {
         if(req.body.quantity != 0){
            const productList = Array.isArray(req.body.product)
            ? req.body.product
            : [req.body.product]; // Ensure productList is an array

            const priceList = Array.isArray(req.body.price)
            ? req.body.price
            : [req.body.price]; // Ensure priceList is an array

            const totalList = Array.isArray(req.body.total)
            ? req.body.total
            : [req.body.total]; // Ensure totalList is an array

            let total = req.body.total;
            let quantity = req.body.quantity; 
            let totalDiscounted = 0;

            if (quantity == 1) { // if only 1 item id ordered
                totalDiscounted = parseFloat(totalList); // Initialize with the total
            }else{
                totalDiscounted = parseFloat(total[total.length - 1]); // Initialize with the total
            }
             
             

            steak = 900;
            salmon = 850;
            chicken = 300;
            baked = 80;
            mashed = 75;
            steamed = 50;
            iced = 55;
            root = 60;
            water = 20;

            comboTotal = 0;
            comboDiscount = 0;

            mquan = quantity[0];
            squan = quantity[1];
            dquan = quantity[2];

            // Apply discounts based on product combinations
            const hasChicken = productList.includes('CHICKEN');
            const hasMashedPotato = productList.includes('MASHED POTATO');
            const hasIcedTea = productList.includes('ICED TEA');

            if (hasChicken && hasMashedPotato && hasIcedTea) {
                while (mquan > 0 && squan > 0 && dquan > 0) {
                    // Add price for combo meals ONLY
                    comboTotal = chicken + mashed + iced;
                
                    // Discount for the combo ONLY
                    comboDiscount += (comboTotal * 0.10);
                    
                    // Decrement the quantity of each item to find how many combos in order
                    mquan--;
                    squan--;
                    dquan--;
                }
                totalDiscounted -= comboDiscount;
    
                console.log("Chicken Discounted: ", totalDiscounted);
                console.log('Chicken Mash Tea Combo! 10% Discount is applied!');
            }

            const hasSteak = productList.includes('STEAK');
            const hasSteamedVegetables = productList.includes('STEAMED VEGETABLES');
            const hasRootBeer = productList.includes('ROOT BEER');

            if (hasSteak && hasSteamedVegetables && hasRootBeer) {
                while (mquan > 0 && squan > 0 && dquan > 0) {
                    // Add price for combo meals ONLY
                    comboTotal = steak + steamed + root;
                
                    // Discount for the combo ONLY
                    comboDiscount += (comboTotal * 0.15);
                    
                    // Decrement the quantity of each item to find how many combos in order
                    mquan--;
                    squan--;
                    dquan--;
                }
                totalDiscounted -= comboDiscount;
    
                console.log("Steak Discount: ", totalDiscounted);
                console.log('Steak Veg Beer Combo! 15% Discount is applied!');
            }

            res.render('payment', {
                listQuantity : req.body.quantity,
                listPrice : priceList,
                listProduct: productList, // Use the productList array in the template
                totalDiscounted: totalDiscounted,
                total: totalList,
                products: products, // Pass the products array to the template
            })
         }
    } 

});

app.post('/receipt', (req, res) => {

    const productList = Array.isArray(req.body.product)
            ? req.body.product
            : [req.body.product]; // Ensure productList is an array

            const priceList = Array.isArray(req.body.price)
            ? req.body.price
            : [req.body.price]; // Ensure priceList is an array

            const totalList = Array.isArray(req.body.total)
            ? req.body.total
            : [req.body.total]; // Ensure totalList is an array

            const totalDiscountedList = Array.isArray(req.body.totalDiscounted)
            ? req.body.totalDiscounted
            : [req.body.totalDiscounted]; // Ensure totalList is an array

            let total = req.body.total;
            let totalDiscounted = 0; // Initialize with the total

            let quantity = req.body.quantity;

            if (quantity == 1) { // if only 1 item id ordered
                totalDiscounted = parseFloat(totalList); // Initialize with the total
            }else{
                totalDiscounted = parseFloat(total[total.length - 1]); // Initialize with the total
            }

            steak = 900;
            salmon = 850;
            chicken = 300;
            baked = 80;
            mashed = 75;
            steamed = 50;
            iced = 55;
            root = 60;
            water = 20;

            comboTotal = 0;
            comboDiscount = 0;

            mquan = quantity[0];
            squan = quantity[1];
            dquan = quantity[2];

            // Apply discounts based on product combinations
            const hasChicken = productList.includes('CHICKEN');
            const hasMashedPotato = productList.includes('MASHED POTATO');
            const hasIcedTea = productList.includes('ICED TEA');

            if (hasChicken && hasMashedPotato && hasIcedTea) {
                while (mquan > 0 && squan > 0 && dquan > 0) {
                    // Add price for combo meals ONLY
                    comboTotal = chicken + mashed + iced;
                
                    // Discount for the combo ONLY
                    comboDiscount += (comboTotal * 0.10);
                    
                    // Decrement the quantity of each item to find how many combos in order
                    mquan--;
                    squan--;
                    dquan--;
                }
                totalDiscounted -= comboDiscount;
    
                console.log("Chicken Discounted: ", totalDiscounted);
                console.log('Chicken Mash Tea Combo! 10% Discount is applied!');
            }

            const hasSteak = productList.includes('STEAK');
            const hasSteamedVegetables = productList.includes('STEAMED VEGETABLES');
            const hasRootBeer = productList.includes('ROOT BEER');

            if (hasSteak && hasSteamedVegetables && hasRootBeer) {
                while (mquan > 0 && squan > 0 && dquan > 0) {
                    // Add price for combo meals ONLY
                    comboTotal = steak + steamed + root;
                
                    // Discount for the combo ONLY
                    comboDiscount += (comboTotal * 0.15);
                    
                    // Decrement the quantity of each item to find how many combos in order
                    mquan--;
                    squan--;
                    dquan--;
                }
                totalDiscounted -= comboDiscount;
    
                console.log("Steak Discount: ", totalDiscounted);
                console.log('Steak Veg Beer Combo! 15% Discount is applied!');
            }


            let change = req.body.cash - totalDiscountedList;



    // From payment
    res.render('receipt', {
        cash : req.body.cash,
        customer : req.body.customer,
        total : req.body.total,
        totalDiscounted : totalDiscountedList,
        productList: req.body.product,
        priceList: req.body.price,
        quantity : req.body.quantity,
        listQuantity : req.body.quantity,
        listPrice : priceList,
        listProduct: productList, // Use the productList array in the template
        total: totalList,
        products: products, // Pass the products array to the template
        change: change
    });

    console.log("RECEIPT")
    console.log("Customer:", req.body.customer)
    console.log("Cash:", req.body.cash)
    console.log("Total:", req.body.total)
    console.log("Total Discounted:", totalDiscountedList)
    console.log("Product List:", req.body.product)
    console.log("Price List:", req.body.price)
    console.log("Quantity List:", req.body.quantity)
    console.log("Change:", change)
});

app.listen(3000);