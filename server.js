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
      console.log(req.body.product)
      console.log(req.body.price)
      console.log(req.body.quantity)

      console.log(moment().format())
    if (req.body && req.body.checkout) {
         if(req.body.quantity != 0){
            res.render('payment', {
                listQuantity : req.body.quantity,
                listPrice : req.body.price,
                listProduct : req.body.product,
                total: req.body.total
            })
         }
    } 

});

app.post('/receipt', (req, res) => {
    // From payment
    console.log("Customer", req.body.customer)
    console.log("Cash", req.body.cash)
    console.log("Total", req.body.total)
    console.log("Total Discount", req.body.totalDiscount)
    console.log("Product List", req.body.productList)
    res.render('receipt', {
        cash : req.body.cash,
        customer : req.body.customer,
        total : req.body.total,
        totalDiscount : req.body.totalDiscount,
        productList : req.body.productList,
        listProduct : req.body.product,
    });
});

app.listen(3000);