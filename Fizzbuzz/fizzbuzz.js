// Client-side code
/* jshint browser: true, jquery: true, curly: true, eqeqeq: true, forin: true, immed: true, indent: 4, latedef: true, newcap: true, nonew: true, quotmark: double, strict: true, undef: true, unused: true */
 
// Server-side code
/* jshint node: true, curly: true, eqeqeq: true, forin: true, immed: true, indent: 4, latedef: true, newcap: true, nonew: true, quotmark: double, strict: true, undef: true, unused: true */

var main = function(){
	"use strict";
	var i;
	
	function fizzbuzz_1(){
		$("body .one").append("<p>");
		for (i = 1; i <= 100; i++) {
			if ((i%3 === 0) && (i%5 !== 0)) {
				$("body .one").append("Fizz ");
			} else if ((i%5 === 0) && (i%3 !== 0)) {
				$("body .one").append("Buzz ");
			} else if ((i%3 ===0) && (i%5 === 0)) {
				$("body .one").append("FizzBuzz ");
			} else {
				$("body .one").append(i + " ");
			}
		}
		$("body .one").append("</p><br>");
	}
	
	function fizzbuzz_2(start, end) {
		$("body .two").append("<p>");
		for (i = start; i <= end; i++){
			if ((i%3 === 0) && (i%5 !== 0)) {
				$("body .two").append("Fizz ");
			} else if ((i%5 === 0) && (i%3 !== 0)) {
				$("body .two").append("Buzz ");
			} else if ((i%3 ===0) && (i%5 === 0)) {
				$("body .two").append("FizzBuzz ");
			} else {
				$("body .two").append(i + " ");
			}
		}
		$("body .two").append("</p><br>");
	}
	
	function fizzbuzz_3(arr) {
		$("body .three").append("<p>");
		for (i = 0; i < arr.length; i++){
			if ((arr[i]%3 === 0) && (arr[i]%5 !== 0)) {
				$("body .three").append("Fizz ");
			} else if ((arr[i]%5 === 0) && (arr[i]%3 !== 0)) {
				$("body .three").append("Buzz ");
			} else if ((arr[i]%3 ===0) && (arr[i]%5 === 0)) {
				$("body .three").append("FizzBuzz ");
			} else {
				$("body .three").append(arr[i] + " ");
			}
		}
		$("body .three").append("</p><br>");
	}
	
	function fizzbuzz_4(obj) {
		$("body .four").append("<p>");
		for (i = 1; i <= 100; i++) {
			if ((i%3 === 0) && (i%5 !== 0)) {
				$("body .four").append(obj.divisibleByThree + " ");
			} else if ((i%5 === 0) && (i%3 !== 0)) {
				$("body .four").append(obj.divisibleByFive + " ");
			} else if ((i%3 ===0) && (i%5 === 0)) {
				$("body .four").append(obj.divisibleByThree + obj.divisibleByFive + " ");
			} else {
				$("body .four").append(i + " ");
			}
		}
		$("body .four").append("</p><br>");
	}
	
	function fizzbuzz_5(arr, obj) {
		$("body .five").append("<p>");
		for (i = 0; i < arr.length; i++) {
			if ((arr[i]%3 === 0) && (arr[i]%5 !== 0)) {
				$("body .five").append(obj.divisibleByThree + " ");
			} else if ((arr[i]%5 === 0) && (arr[i]%3 !== 0)) {
				$("body .five").append(obj.divisibleByFive + " ");
			} else if ((arr[i]%3 ===0) && (arr[i]%5 === 0)) {
				$("body .five").append(obj.divisibleByThree + obj.divisibleByFive + " ");
			} else {
				$("body .five").append(arr[i] + " ");
			}
		}
		$("body .five").append("</p><br>");
	}
	
	$("body .one").append("<p>Function 1:</p>");
	fizzbuzz_1();
	$("body .two").append("<p>Function 2:</p>");
	fizzbuzz_2(200,300);
	$("body .three").append("<p>Function 3:</p>");
	fizzbuzz_3([101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115]);
	$("body .four").append("<p>Function 4:</p>");
	fizzbuzz_4({divisibleByThree: "foo", divisibleByFive: "bar"});
	$("body .five").append("<p>Function 5:</p>");
	fizzbuzz_5([101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115], {divisibleByThree: "foo", divisibleByFive: "bar"});
};

$(document).ready(main);
