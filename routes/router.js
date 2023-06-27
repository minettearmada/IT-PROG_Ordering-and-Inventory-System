const express = require('express');
const router = express.Router();

const database = require('../database/Controller'); //add

router.post('/orders', database.createOrder); //add
router.get('/orders', database.getOrder); //add
//router.get()

module.exports = router;