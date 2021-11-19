var express = require("express");
var app = express();
const axios = require('axios')
app.listen(3000, () => {
    console.log("Server running on port 3000");
});

app.get("/getAllContractsDetailByPinV6", (req, res, next) => {

    
    const headers = {
        headers: {
            "Access-Control-Allow-Origin": "*",
            'Content-Type': 'application/json',
            'RequestKey': '38WVc6l7pKAixlQYNqMByFHhFOIZ67',
            'RequestClientIP': '172.16.248.27'
        }
    }

    const data = {
        'search_pin': '6HUG118'
    }

    axios
        .post(`http://mlspp.integration.services/api/v1/procedures/labcontract/getAllContractsDetailByPinV6`, data,  headers )
        .then(resss => {
            res.json(resss.data);
        })
        .catch(error => {
            res.json(error);
        })
    
});