const express = require('express');
const app = express();

app.use(express.static("public"));
app.set('view engine', 'ejs');

// app.get('/', (req, res) => {
//     res.render('index');
// })

// creating a news user
app.post('/', (req, res) => {
    res.send('Create User');
})

app.get('/', (req, res) => {
    res.render("")
})


app.listen(3000)