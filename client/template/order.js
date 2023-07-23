const moment = require('moment');
let now = moment();

class order{
    constructor(name, main, side, drink, m1, s1, d1, final){
    this.name = name;
    this.main = main;
    this.side = side;
    this.drink = drink;
    this.m1 = m1;
    this.s1 = s1;
    this.d1 = d1;
    this.final = final;
    this.date = now.format("YYYY-MM-DD") + " " + now.format("HH:mm:ss");
    }
    

    /*
    constructor (main, side, drink, m1, s1, d1){
    this.main = main;
    this.side = side;
    this.drink = drink;
    this.m1 = m1;
    this.s1 = s1;
    this.d1 = d1;
        }

        */
}

module.exports = order;