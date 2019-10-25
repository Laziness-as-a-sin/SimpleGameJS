var canvas = document.getElementById('Canvas');
var ctx = canvas.getContext('2d');
document.addEventListener("keydown", keyDownHandler, false);

var live = 1;
var letters = [];
var brickRowCount = 3;
var brickColumnCount = 1;
var TimeCreate = 100;
var TimeBeforeCreate = 0;
var queueFall = [];
var checkBoom = false;
var xBoom = 100;
var yBoom = 100;
var nScene = 0;
var score = 0;
var lvl = 1;
var stop = false;
var die = false;

var ImgBoom = new Image();
ImgBoom.src = 'pictures/boom.png';

var AuMiss = new Audio; 
AuMiss.src = "sounds/miss.wav"; // назначение звукового файла

var AuHit = new Audio;
AuHit.src = "sounds/correct.wav";

function drowStop(){
	ctx.font = "40px Arial";
	ctx.fillStyle = "#0095DD";
    ctx.fillText("Pause", canvas.width/2, canvas.height/2);
}


function createLetters(length) {
	for(var i = 0; i < length; i++) {
	    letters[i] = {x: i*15, y: -60, status: 0, code: 0};
	}
}
createLetters(36);

for(var i = 0; i < 10; i++){letters[i].code = i + 48}
for(var i = 10; i < 36; i++){letters[i].code = i + 55} 

function drawScore() {
  	ctx.font = "32px sans-serif";
  	ctx.fillStyle = "#0095DD";
  	ctx.fillText("Score: " + score /*+ "  LVL: " + lvl */+ "  LIVE: " + live, 10, 40);
}

function drawFinalScore(){
	ctx.font = "40px Arial";
	ctx.fillStyle = "#0095DD";
    ctx.fillText("Total Score: " + score, canvas.width/2-90, canvas.height/2);
}

function drawLetters(length, Vfall) {
	for(var i = 0; i < length; i++) {
	    if(letters[i].status == 1) {
	        letters[i].y += Vfall;
		    if(letters[i].y == 640){
		    	letters[i].y = -60;
		    	letters[i].status = 0;
		    	queueFall.shift();
		    	live -= 1;
		    	if(live == 0){    		
					die = true;
		    	}
		    }

		    var img = new Image();
			img.src = 'pictures/' + i + '.png';
	        ctx.beginPath();
	        ctx.drawImage(img, letters[i].x, letters[i].y, 100, 100);
	        ctx.closePath();
	     }
  	}

  	TimeBeforeCreate += 1;
  	if(TimeBeforeCreate == TimeCreate){
  		TimeBeforeCreate = 0;
  		var check = true;
  		while(check){
	  		var k = Math.floor(Math.random() * (35 - 0)) + 0;
	  		if(letters[k].status == 0){
	  			letters[k].x = Math.floor(Math.random() * (1220 - 0)) + 0;
	  			letters[k].status = 1;	  			
	  			queueFall.push(k);
	  			check = false;
	  		}
	  	}
  	}

  	if(checkBoom){
  		
	  	ctx.drawImage(ImgBoom, nScene, 0, 100, 100, xBoom, yBoom, 100, 100);
	  	if(TimeBeforeCreate % 3 == 0){nScene += 100}
	  	if(nScene == 600){
	  		nScene = 0;
	  		checkBoom = false;
	  	}	
  	}
  	console.log(queueFall[0]);
}


function draw() {
  	ctx.clearRect(0, 0, canvas.width, canvas.height);
  	if(!die){
  		drawLetters(36, 1);
  		drawScore();
  	}
  	else{
  		drawScore();
  		drawFinalScore();
  	}
  	
}
var drawI = setInterval(draw, 10);

function keyDownHandler(a) {
  	if(a.keyCode == letters[queueFall[0]].code) {
  		checkBoom = true;
  		yBoom = letters[queueFall[0]].y;
  		xBoom = letters[queueFall[0]].x;
  		letters[queueFall[0]].y = -60;
		letters[queueFall[0]].status = 0;
		queueFall.shift();	
		score += 10;
    AuHit.play();
  	}
    else{
    	if(a.keyCode == 27) {
    		if(!stop){
    			clearInterval(drawI);
    			//drowStop();
    			stop = true;
    		}
    		else{
    			drawI = setInterval(draw, 10);
    			stop = false;
    		}
    	}
      else{
        AuMiss.play();
      }
    }
}

