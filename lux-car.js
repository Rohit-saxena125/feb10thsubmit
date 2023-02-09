const { application } = require("express");
const express=require("express");
const bodyParser=require("body-parser");
const mongoose=require("mongoose");
const { urlencoded } = require("body-parser");
const { reduce } = require("lodash");

const site=express();

site.use(bodyParser.urlencoded({extended: true}));
site.use(express.static("public"));

mongoose.connect("mongodb://localhost:27017/buyCarDB", {useNewUrlParser:true});

const buySchema={
    title:String,
    condition:String,
    price:Number,
    Company:String,
    model:String,
    year:Number,
    fueltype:String,
    color:String,
    description:String
}

const buyCar=mongoose.model("buyCar", buySchema);

// const harshal=new buyCar({
//     title:"ferrai",
//     condition:"New",
//     price:3500000,
//     Company:"Ferrai",
//     model:"Formula1",
//     year:2022,
//     fueltype:"Petrol",
//     color:"red",
//     description: "hii"
// });

// const praduman=new buyCar({
//     title:"Mercedes",
//     condition:"New",
//     price:3500000,
//     Company:"Ferrai",
//     model:"c200",
//     year:2022,
//     fueltype:"Petrol",
//     color:"red",
//     description: "hii"
// });


// const mandeepSir=new buyCar({
//     title:"",
//     condition:"New",
//     price:4500000,
//     Company:"Lamborghini",
//     model:"Urus",
//     year:2022,
//     fueltype:"Petrol",
//     color:"orange",
//     description: "mamdeepSir car"
// });

// const bhoomi=new buyCar({
//     title:"Audi",
//     condition:"New",
//     price:4000000,
//     Company:"Audi",
//     model:"c200",
//     year:2022,
//     fueltype:"Petrol",
//     color:"black",
//     description: "hello"
// });

// const defaultItems=[ bhoomi, mandeepSir];


// buyCar.insertMany(defaultItems, function(err){
//     if(err)
//     {
//         console.log(err);
//     }
//     else
//     {
//         console.log("Successfully inserted data ");
//     }
// });





site.get("/", function(req, res){
    res.sendFile(__dirname + "/index.html");
});

site.listen(3000, function(){
    console.log("Server started at  port 3000");
})