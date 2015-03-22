//Run on command line with node server.js

"use strict";

var express = require("express"),
	http = require("http"),
	app = express(),
	gamestats = {
		"player": "",
		"computer": "",
		"outcome": "",
		"wins": 0,
		"losses": 0,
		"ties": 0};

app.use(express.static(__dirname + "/public"));
http.createServer(app).listen(3000);
console.log("Server listening on localhost:3000");

function compMakeMove() {
    var randomNum = Math.floor(Math.random() * 5);
	var computerPlays = "";
    if(randomNum === 0){
        computerPlays = "rock";
    } else if(randomNum === 1){
        computerPlays = "paper";
    } else if(randomNum === 2){
        computerPlays = "scissors";
    } else if(randomNum === 3){
        computerPlays = "lizard";
    } else if(randomNum === 4){
        computerPlays = "spock";
    }
	return computerPlays;
}

function playing(player, computer){
    if(player === computer){
    	gamestats.outcome = "TIE";
		gamestats.ties++;
    } else if(player === "rock"){
   		if(computer === "scissors" || computer === "lizard") {
    		gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "paper" || computer === "spock"){
    		gamestats.outcome = "LOSE";
			gamestats.losses++;
    	}
    } else if(player === "paper") {
    	if(computer === "rock" || computer === "spock") {
    		gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "scissors" || computer === "lizard"){
    		gamestats.outcome = "LOSE";
			gamestats.losses++;
    	}
    } else if(player === "scissors") {
    	if(computer === "paper" || computer === "lizard") {
    		gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "rock" || computer === "spock"){
    		gamestats.outcome = "LOSE";
			gamestats.losses++;
    	}
    } else if(player === "lizard") {
    	if(computer === "paper" || computer === "spock") {
    		gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "rock" || computer === "scissors"){
    		gamestats.outcome = "LOSE";
			gamestats.losses++;
		}
    } else if(player === "spock") {
    	if(computer === "rock" || computer === "scissors") {
    		gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "paper" || computer === "lizard"){
    		gamestats.outcome = "LOSE";
			gamestats.losses++;
    	}
    }
}

app.post("/play/rock", function (req, res) {
	gamestats.player = "rock";
	gamestats.computer = compMakeMove();
	playing(gamestats.player, gamestats.computer);
	res.json(gamestats);
});

app.post("/play/paper", function (req, res) {
	gamestats.player = "paper";
	gamestats.computer = compMakeMove();
	playing(gamestats.player, gamestats.computer);
	res.json(gamestats);
});

app.post("/play/scissors", function (req, res) {
	gamestats.player = "scissors";
	gamestats.computer = compMakeMove();
	playing(gamestats.player, gamestats.computer);
	res.json(gamestats);
});

app.post("/play/lizard", function (req, res) {
	gamestats.player = "lizard";
	gamestats.computer = compMakeMove();
	playing(gamestats.player, gamestats.computer);
	res.json(gamestats);
});

app.post("/play/spock", function (req, res) {
	gamestats.player = "spock";
	gamestats.computer = compMakeMove();
	playing(gamestats.player, gamestats.computer);
	res.json(gamestats);
});