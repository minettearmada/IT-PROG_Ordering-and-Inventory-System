const mysql = require('mysql');
require('dotenv').config();

const conn = mysql.createConnection({
    host: process.env.host,
    user: process.env.root,
    database: process.env.database,
  });