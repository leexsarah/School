#!/usr/bin/env node

//By Sarah Lee & Mario Andrade, CPSC 473 [Section 1]
//Altered code from https://gist.github.com/ProfAvery/3358aafcebcb57258f03 
//Install node, run by typing "node HW5.js" in the terminal

"use strict";

var gamestats = {
	"outcome": "",
	"wins": 0,
	"losses": 0,
	"ties": 0
}

function beginPage(res) {
    res.write("<!DOCTYPE html>\n");
    res.write("<html lang='en'>\n");
    res.write("<head>\n");
    res.write("<title>Rock, Paper, Scissors, Lizard, Spock</title>\n");
    res.write("</head>\n");
    res.write("<body>\n");
}

function endPage(res) {
	res.write("</body>\n");
    res.write("</html>\n");
    res.end();
}

function play(player, computer, res) {
	beginPage(res);
	res.write("<p>You chose " + player + "!</p>\n");
	res.write("<p>Computer chose " + computer + "!</p>\n");
}

function error(res) {
	beginPage(res);
	res.write("<h2>Welcome!</h2>\n");
	res.write("<p>Please enter click on one of the following:</p>\n");
	res.write("<form method='POST' action='/play/rock'>\n");
	res.write("<input type='submit' value='Rock'>\n");
	res.write("</form><br>\n");
	res.write("<form method='POST' action='/play/paper'>\n");
	res.write("<input type='submit' value='Paper'>\n");
	res.write("</form><br>\n");
	res.write("<form method='POST' action='/play/scissors'>\n");
	res.write("<input type='submit' value='Scissors'>\n");
	res.write("</form><br>\n");
	res.write("<form method='POST' action='/play/lizard'>\n");
	res.write("<input type='submit' value='Lizard'>\n");
	res.write("</form><br>\n");
	res.write("<form method='POST' action='/play/spock'>\n");
	res.write("<input type='submit' value='Spock'>\n");
	res.write("</form><br>\n");
	endPage(res);
}

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

function playing(player, computer, gamestats, res){
    if(player === computer){
    	res.write("<h2>TIE</h2>\n");
		gamestats.outcome = "TIE";
		gamestats.ties++;
    } else if(player === "rock"){
   		if(computer === "scissors" || computer === "lizard") {
    		res.write("<h2>WIN</h2>\n");
			gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "paper" || computer === "spock"){
    		res.write("<h2>LOSE</h2>\n");
			gamestats.outcome = "LOSE";
			gamestats.losses++;
    	}
    } else if(player === "paper") {
    	if(computer === "rock" || computer === "spock") {
    		res.write("<h2>WIN</h2>\n");
			gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "scissors" || computer === "lizard"){
    		res.write("<h2>LOSE</h2>\n");
			gamestats.outcome = "LOSE";
			gamestats.losses++;
    	}
    } else if(player === "scissors") {
    	if(computer === "paper" || computer === "lizard") {
    		res.write("<h2>WIN</h2>\n");
			gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "rock" || computer === "spock"){
    		res.write("<h2>LOSE</h2>\n");
			gamestats.outcome = "LOSE";
			gamestats.losses++;
    	}
    } else if(player === "lizard") {
    	if(computer === "paper" || computer === "spock") {
    		res.write("<h2>WIN</h2>\n");
			gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "rock" || computer === "scissors"){
    		res.write("<h2>LOSE</h2>\n");
			gamestats.outcome = "LOSE";
			gamestats.losses++;
		}
    } else if(player === "spock") {
    	if(computer === "rock" || computer === "scissors") {
    		res.write("<h2>WIN</h2>\n");
			gamestats.outcome = "WIN";
			gamestats.wins++;
    	}
    	else if(computer === "paper" || computer === "lizard"){
    		res.write("<h2>LOSE</h2>\n");
			gamestats.outcome = "LOSE";
			gamestats.losses++;
    	}
    }
	printStats(gamestats, res);
}

function printStats(gamestats, res) {
	res.write("<p>Outcome: " + gamestats.outcome + "</p>\n");
	res.write("<p>Wins: " + gamestats.wins + "</p>\n");
	res.write("<p>Losses: " + gamestats.losses + "</p>\n");
	res.write("<p>Ties: " + gamestats.ties + "</p>\n");
}

function frontPage(req, res) {
    res.writeHead(200, {
        "Content-Type": "text/html"
    });
	
	var player = "";
	var computer = "";
	
	if (req.method === "POST" && req.url === "/play/rock") {
		player = "rock";
		computer = compMakeMove();
		play(player, computer, res);
		playing(player, computer, gamestats, res);
		endPage(res);
    } else if (req.method === "POST" && req.url === "/play/paper") {
		player = "paper";
		computer = compMakeMove();
		play(player, computer, res);
		playing(player, computer, gamestats, res);
		endPage(res);
	} else if (req.method === "POST" && req.url === "/play/scissors") {
		player = "scissors";
		computer = compMakeMove();
		play(player, computer, res);
		playing(player, computer, gamestats, res);
		endPage(res);
	} else if (req.method === "POST" && req.url === "/play/lizard") {
		player = "lizard";
		computer = compMakeMove();
		play(player, computer, res);
		playing(player, computer, gamestats, res);
		endPage(res);
	} else if (req.method === "POST" && req.url === "/play/spock") {
		player = "spock";
		computer = compMakeMove();
		play(player, computer, res);
		playing(player, computer, gamestats, res);
		endPage(res);
	} else {
        error(res);
    }
}

var http = require("http");	
var server = http.createServer(frontPage);
server.listen(3000);
var address = server.address();
console.log("Server running on port 3000");