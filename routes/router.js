const express = require('express');
const router = express.Router();

const database = require('../database/Controller'); //add

// // Get ALL products
router.get('/api/food', (req, res) => {
    db.query('SELECT * FROM food', (err, foodData) => {
        if (err) {
            console.error('Error executing MySQL query:', err);
            res.status(500).send('Error executing query');
        } else {
            console.log(foodData);
            res.render('index', { foodData: foodData }); // Pass 'results' to the 'index' view as 'foodData' variable
        }
    });
});

router.post('/orders', database.createOrder); //add
router.get('/orders', database.getOrder); //add
//router.get()

module.exports = router;