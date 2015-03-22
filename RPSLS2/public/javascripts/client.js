var main = function(){
	"use strict";
	
	//Initialize the results portion of the page.
	function initializeResults(){
		$(".results").append($("<p>").addClass("player"));
		$(".results").append($("<p>").addClass("computer"));
		$(".results").append($("<p>").addClass("outcome"));
		$(".results").append($("<p>").addClass("wins"));
		$(".results").append($("<p>").addClass("losses"));
		$(".results").append($("<p>").addClass("ties"));
	}

	//Update the results portion of the page after each round of the game.
	function updateResults(results){
		$(".player").text("Player: " + results.player);
		$(".computer").text("Computer: " + results.computer);
		$(".outcome").text("Outcome: " + results.outcome);
		$(".wins").text("Wins: " + results.wins);
		$(".losses").text("Losses: " + results.losses);
		$(".ties").text("Ties: " + results.ties);
	}

	//Create variable names for the five buttons.
	var $rock = $("<button>Rock</button>"),
		$paper = $("<button>Paper</button>"),
		$scissors = $("<button>Scissors</button>"),
		$lizard = $("<button>Lizard</button>"),
		$spock = $("<button>Spock</button>");

	//Append the five buttons to the html page.
	$(".choices").append($rock);
	$(".choices").append($paper);
	$(".choices").append($scissors);
	$(".choices").append($lizard);
	$(".choices").append($spock);
	
	initializeResults();

	//Create button handlers for the five buttons.
	$rock.on("click", function(){
		//Post to the server the player's choice.
		$.post("/play/rock", function(res){
			updateResults(res);
		});
	});

	$paper.on("click", function(){
		$.post("/play/paper", function(res){
			updateResults(res);
		});
	});

	$scissors.on("click", function(){
		$.post("/play/scissors", function(res){
			updateResults(res);
		});
	});

	$lizard.on("click", function(){
		$.post("/play/lizard", function(res){
			updateResults(res);
		});
	});

	$spock.on("click", function(){
		$.post("play/spock", function(res){
			updateResults(res);
		});
	});

};

$(document).ready(main);