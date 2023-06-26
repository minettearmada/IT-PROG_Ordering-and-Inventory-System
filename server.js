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

// Get ALL products
app.get('/api/products', (req, res) => res.json(products));

app.get('/', (req, res) => {
    res.render('index');
});

app.post('/payment', (req, res) => {
      // Check if the request came from the checkout button
      console.log(req.body.quantity)
      console.log(req.body.product)
      console.log(req.body.price)
      console.log(moment().format())
    if (req.body && req.body.checkout) {
         if(req.body.quantity != 0){
            res.render('payment', {
                quantity : req.body.quantity,
                price : req.body.price,
                product : req.body.product
            })
         }
    } 



});

app.use('/api', router); //add






app.listen(3000);