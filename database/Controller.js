const db = require('./db');
const Order = require('../template/order');
const app = require('../server');


// GET /api/orders
/*
gets all the orders
*/
exports.getOrders = (req, res, next) => {
    db.query('SELECT * FROM orders', (err, results) => {
            if (err) {
            console.error('Error executing MySQL query:', err);
            res.status(500).send('Error executing query');
            }else{
            res.json(results);
            }
        });
}

// GET /api/orders/:id

exports.getOrder = (req, res, next) => {
    const id = req.params.id;
    db.query('SELECT * FROM orders WHERE orderID = ?', [id], (err, results) => {
            if (err) {
            console.error('Error executing MySQL query:', err);
            res.status(500).send('Error executing query');
            }else{
            res.json(results);
            }
        });
}

// POST /api/orders

exports.createOrder = (req, res, next) => {
    console.log("ETO YUNG LAMAN SA DBBBBBBBBB QUERY");
    console.log(req.body);
    const name = req.body.customer;
    const main = req.body.product0;
    const side = req.body.product1;
    const drink = req.body.product2;
    const m1 = req.body.quantity0;
    const s1 = req.body.quantity1;
    const d1 = req.body.quantity2;
    const final = req.body.total;

    /*
    const temp = {
        name : name,
        main : main,
        side : side,
        drink : drink,
        m1 : m1,
        s1 : s1,
        d1 : d1,
        CMT : CMT,
        SVB : SVB,
        final : final
    };
    */

    const order = new Order(name, main, side, drink, m1, s1, d1, final);

    db.query('INSERT INTO orders SET ?' , [order], (err, results) => {
            if (err) {
            console.error('Error executing MySQL query:', err);
            res.status(500).send('Error executing query');
            }else{
                //res.json(results);
                console.log("Order added successfully.");
                res.redirect('/');
                //window.location.href = '/views\index.ejs';
                //res.render('index');
            }
        });


}


/*
exports.createOrder = (req, res, next) => {
    const main = "STEAK";
    const side = "STEAMED VEGETABLES";
    const drink = "WATER";
    const m1 = 1;
    const s1 = 2;
    const d1 = 1;

    
    const main = req.body.main;
    const side = req.body.side;
    const drink = req.body.drink;
    const m1 = req.body.m1;
    const s1 = req.body.s1;
    const d1 = req.body.d1;

    
    const order = new Order(main, side, drink, m1, s1, d1);

    console.log(order);

    db.query('INSERT INTO practice SET ?', [order], (err, results) => {
            if (err) {
            console.error('Error executing MySQL query:', err);
            res.status(500).send('Error executing query');
            }else{
            res.json(results);
            }
        });
}

*/

// PUT /api/orders

exports.updateOrder = (req, res, next) => {
    const id = req.params.id;
    const name = req.body.name;
    const main = req.body.main;
    const side = req.body.side;
    const drink = req.body.drink;
    const m1 = req.body.m1;
    const s1 = req.body.s1;
    const d1 = req.body.d1;
    const price = req.body.price;
    const CMT = req.body.CMT;
    const SVB = req.body.SVB;
    const final = req.body.final;
    const date = req.body.date;

    const order = new Order(id, name, main, side, drink, m1, s1, d1, price, CMT, SVB, final, date);

    db.query('UPDATE orders SET ? WHERE orderID = ?', [order, id], (err, results) => {
            if (err) {
            console.error('Error executing MySQL query:', err);
            res.status(500).send('Error executing query');
            }else{
            res.json(results);
            }
        });
}


exports.deleteOrders = (req, res, next) => {
    const id = req.params.id;
    db.query('DELETE FROM orders WHERE orderID = ?', [id], (err, results) => {
            if (err) {
            console.error('Error executing MySQL query:', err);
            res.status(500).send('Error executing query');
            }else{
            res.json(results);
            }
        });
}