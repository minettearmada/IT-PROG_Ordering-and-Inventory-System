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
app.use('/api', router);

// Get ALL products
app.get('/api/products', (req, res) => res.json(products));

app.get('/', (req, res) => {
    res.render('index');
});

const axios = require('axios');

        let combo = [];

        async function fetchComboData() {
            try {
                console.log('TRYING TO FETCH DATA');

                const response = await axios.get('http://localhost:3000/api/combo'); // Replace with your API URL
                const comboData = response.data;

                combo = comboData;

                console.log('Fetched combo data:', comboData);

                return comboData;
            } catch (error) {
                console.error('Error fetching combo:', error);
            }
        }

app.post('/payment', async (req, res) => {
      // Check if the request came from the checkout button
      console.log("PAYMENT")
      console.log("Products:", req.body.product)
      console.log("Food Code:", req.body.foodCode)
      console.log("Price:",req.body.price)
      console.log("Quantity:",req.body.quantity)
      
      console.log(moment().format())

    if (req.body && req.body.checkout) {
         if(req.body.quantity != 0){
            const productList = Array.isArray(req.body.product)
            ? req.body.product
            : [req.body.product]; // Ensure productList is an array

            const priceList = Array.isArray(req.body.price)
            ? req.body.price
            : [req.body.price]; // Ensure priceList is an array

            // Get the total quantity ordered
            const quantityList = Array.isArray(req.body.quantity)
                ? req.body.quantity
                : [req.body.quantity]; // Ensure quantityList is an array

            // const totalList = Array.isArray(req.body.total)
            // ? req.body.total
            // : [req.body.total]; // Ensure totalList is an array

    
            let quantity = req.body.quantity; 
            let totalDiscounted = 0;

            // Calculate the total price by summing up all the prices multiplied by the quantity
let total = 0;
for (let i = 0; i < priceList.length; i++) {
    total += parseFloat(priceList[i]) * parseInt(quantityList[i]);
}
console.log("total:", total); // This will log the calculated total as a single numeric value


           
             
        console.log("CHECK IF COMBO");
             // Fetch combo data and wait for the response
             await fetchComboData();

        
        // Assuming the foodCode is in req.body.foodCode
        const foodCode = req.body.foodCode;
        var hasCombo = false;
        let discountPrice = 0;

        console.log("foodCode:", foodCode);
        console.log("foodCode[0]:", foodCode[0]);

   

        console.log("Printing comboData one by one:");
        
        combo.forEach((comboItem, index) => {
            console.log(`Combo ${index + 1}:`);
            console.log("Combo Code:", comboItem.comboID);
            console.log("Main Code:", comboItem.mainCode);
            console.log("Side Code:", comboItem.sideCode);
            console.log("drink Code:", comboItem.drinkCode);
            console.log("Discounted Price:", comboItem.discountPrice);
            // Add other properties of comboItem as needed
            
            // Compare foodCode with mainCode, sideCode, and drinkCode
            console.log("Food Code:", foodCode[0]);
            console.log("Food Code:", foodCode[1]);
            console.log("Food Code:", foodCode[2]);
        if (comboItem.mainCode == foodCode[0] && comboItem.sideCode == foodCode[1] && comboItem.drinkCode == foodCode[2]) {
            console.log(`Food Code ${foodCode} exists in Combo ${index + 1}`);
            console.log('Food Code exists in comboData');

            hasCombo = true;
            comboName = comboItem.comboName; // Store the combo name
            discountPrice = comboItem.discountPrice;
            totalDiscounted = total - comboItem.discountPrice; // apply the discount
            console.log("Total", total);

        }else{
            console.log('Food Code does not exist in comboData');
        }
        });

        if(hasCombo){
            console.log('HELLOOO COMBO IN')
        }


            res.render('payment', {
                listQuantity : req.body.quantity,
                listPrice : priceList,
                listProduct: productList, // Use the productList array in the template
                totalDiscounted: totalDiscounted,
                total: total,
                products: products, // Pass the products array to the template
                hasCombo: hasCombo,
                discountPrice: discountPrice
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

            // const totalList = Array.isArray(req.body.total)
            // ? req.body.total
            // : [req.body.total]; // Ensure totalList is an array

            // const totalDiscountedList = Array.isArray(req.body.totalDiscounted)
            // ? req.body.totalDiscounted
            // : [req.body.totalDiscounted]; // Ensure totalList is an array

            let total = req.body.total;
            let totalDiscounted = 0; // Initialize with the total

            let quantity = req.body.quantity;

            // if (quantity == 1) { // if only 1 item id ordered
            //     totalDiscounted = parseFloat(totalList); // Initialize with the total
            // }else{
            //     totalDiscounted = parseFloat(total[total.length - 1]); // Initialize with the total
            // }


            let change = 0;
            let hasCombo = req.body.hasCombo;
            console.log("HAS COMBO?", hasCombo);

            // if (hasCombo) { // If combo is applied
            //     change = req.body.cash - req.body.totalDiscounted;
            //     console.log("with combo", req.body.cash, "-", req.body.totalDiscounted);
            // } else { // If no combo is applied
            //     change = req.body.cash - total[total.length - 1];
            //     console.log("NO COMBO", req.body.cash, "-", total[total.length - 1]);
            // }

            if (hasCombo == 'true') {
                change = req.body.cash - req.body.totalDiscounted; // Use totalDiscounted instead of total[total.length - 1]
                console.log("with combo", req.body.cash, "-", req.body.totalDiscounted);
                totalDiscounted = req.body.totalDiscounted;
            } else {
                change = req.body.cash - total[total.length - 1]; // For the non-combo case, the change calculation is the same
                console.log("NO COMBO", req.body.cash, "-", total[total.length - 1]);
                totalDiscounted = 0;
            }


    // From payment
    res.render('receipt', {
        cash : req.body.cash,
        customer : req.body.customer,
        total : total[total.length - 1] ,
        totalDiscounted: totalDiscounted,
        productList: req.body.product,
        priceList: req.body.price,
        quantity : req.body.quantity,
        listQuantity : req.body.quantity,
        listPrice : priceList,
        listProduct: productList, // Use the productList array in the template
        products: products, // Pass the products array to the template
        change: change,
        hasCombo: hasCombo
    });

    console.log("RECEIPT")
    console.log("Customer:", req.body.customer)
    console.log("Cash:", req.body.cash)
    console.log("Total:", total[total.length - 1] )
    console.log("Total Discounted:", totalDiscounted)
    console.log("Product List:", req.body.product)
    console.log("Price List:", req.body.price)
    console.log("Quantity List:", req.body.quantity)
    console.log("Change:", change)
    console.log("Combo:", req.body.hasCombo)
});

app.listen(3000);

module.exports = app;