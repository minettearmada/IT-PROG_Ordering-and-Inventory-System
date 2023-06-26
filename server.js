const express = require('express');
const app = express();
const moment = require('moment'); // time
const products = require('./products')
const path = require('path');
const bodyParser = require('body-parser');
const router = require('./routes/router'); //add
//const env = require('dotenv');


app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));
app.use(express.static(path.join(__dirname, 'public'))); // set static folder
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.json());

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
      
      console.log(moment().format())
    if (req.body && req.body.checkout) {
         if(req.body.quantity != 0){
            const productList = Array.isArray(req.body.product)
            ? req.body.product
            : [req.body.product]; // Ensure productList is an array

            let total = req.body.total;
            let totalDiscounted = parseFloat(total[total.length - 1]); // Initialize with the total

            // Apply discounts based on product combinations
            const hasChicken = productList.includes('CHICKEN');
            const hasMashedPotato = productList.includes('MASHED POTATO');
            const hasIcedTea = productList.includes('ICED TEA');

            if (hasChicken && hasMashedPotato && hasIcedTea) {
                totalDiscounted -= totalDiscounted * 0.1;
                console.log("Discounted: ", totalDiscounted);
                console.log('Chicken Mash Tea Combo! 10% Discount is applied!');
            }

            const hasSteak = productList.includes('STEAK');
            const hasSteamedVegetables = productList.includes('STEAMED VEGETABLES');
            const hasRootBeer = productList.includes('ROOT BEER');

            if (hasSteak && hasSteamedVegetables && hasRootBeer) {
                totalDiscounted -= totalDiscounted * 0.15;
                console.log(totalDiscounted);
                console.log('Steak Veg Beer Combo! 15% Discount is applied!');
            }


            res.render('payment', {
                listQuantity : req.body.quantity,
                listPrice : req.body.price,
                listProduct: productList, // Use the productList array in the template
                totalDiscounted: totalDiscounted,
                total: req.body.total,
                products: products, // Pass the products array to the template
            })
         }
    } 



});

app.use('/api', router); //add






app.post('/receipt', (req, res) => {
    // From payment
    console.log("Customer", req.body.customer)
    console.log("Cash", req.body.cash)
    console.log("Total", req.body.total)
    //console.log("Total Discounted", req.body.totalDiscounted)
    res.render('receipt', {
        cash : req.body.cash,
        customer : req.body.name,
        total : req.body.final,
        totalDiscounted : req.body.totalDiscounted,
        productList: req.body.product,
        priceList: req.body.price,
        quantity : req.body.quantity
    });

    console.log("RECEIPT")
    console.log("Customer:", req.body.customer)
    console.log("Cash:", req.body.cash)
    console.log("Total:", req.body.total)
    console.log("Total Discounted:", req.body.totalDiscounted)
    console.log("Product List:", req.body.product)
    console.log("Price List:", req.body.price)
    console.log("Quantity List:", req.body.quantity)
});

app.listen(3000);

module.exports = app;