//Help with code from source: https://codepen.io/jamesbarnett/pen/kiGsl
//Set Difficulty
function easy(){
  var slice=8;
  var time=121;
  setArr(slice,time);
}
function med(){
  var slice=10;
  var time=151;
  setArr(slice,time);
}
function hard(){
  var slice=12;
  var time=181;
  setArr(slice,time);
}

//Sets array size
function setArr(slice,time){
  //makes timer shown
  document.getElementById("time").style.visibility = "visible";
  document.getElementById("countdown").style.visibility = "visible";
  //remove Difficulty selectors
  document.getElementById("d").remove();
  //initalizes array
  var images = ["1.png","2.png","3.png","4.png",
  "5.png","6.png","7.png","8.png",
  "9.png","10.png","11.png","12.png",];
  //Randomly pick images, base on Difficulty size
  randomize(images);
  images = images.slice(0,slice);
  images = images.concat(images);
  //Randomizes again
  randomize(images);
  //start game
  go(images, slice,time);
}

//main game
function go(images, slice,time){

  var go = false;

  //Timer
  var seconds = time;
  var countdown = setInterval(function() {
    seconds--;
    //get from html and updates
    document.getElementById("countdown").textContent = seconds;
    //clears text
    if (seconds <= 0)
      clearInterval(countdown);

    //When timmer is 0, and all matches not made
    if(seconds==0 && match < slice){
      //clear timer
      clearInterval(countdown);
      document.getElementById("countdown").textContent = "";
      // shows lose text
      document.getElementById("time").textContent = "you lost...";
      document.getElementById("v").style.visibility = "visible";
      //play lose music
      playM(new Audio("lose.mp3"), goSound);
      pauseAudio();
      // can't play
      go = false;
    }

    // Show images until reaches certain time, the hide
    if (seconds == time-(slice/2)){
      $("img").hide();
      go = true;
    }
  }, 1000);


  // Outputs Table
  var output = "<table>";
  var index=0;
  for (var i = 0; i < 4; i++) {
    output += "<tr>";
    for (var j = 0; j < slice/2; j++) {
      output += "<td>";
      output += "<span>"+(index+1)+"</span>";
      output += "<img src = '" + images[index] + "'/>";
      output += "</td>";
      index++;
    }
    output += "</tr>";
  }
  output += "</table>";
  document.getElementById("container").innerHTML = output;



  // when Click a table elements
  var guess1 = "";
  var guess2 = "";
  var count = 0;
  var match = 0;
  $("td").click(function() {
    //Only go when < 2 clicks and this img is not faced up, go is when lose
    if ((count < 2) &&  ($(this).children("img").hasClass("face-up")) === false && go) {
      //plays the specific pokemon cry
      pokeSound($(this).children("img").attr("src"), goSound)

      // increment guess count, show image, mark it as face up
      count++;
      $(this).children("img").show();
      $(this).children("img").addClass("face-up");

      //guess #1
      if (count === 1 ) {
        guess1 = $(this).children("img").attr("src");
      }

      //guess #2
      else {
        guess2 = $(this).children("img").attr("src");

        // since it's the 2nd guess check for match
        if (guess1 === guess2) {
          $("td").children("img[src='" + guess2 + "']").addClass("match");
          count = 0;
          // Matches equal total matches, then win
          match++;
          if(match>=slice){
            clearInterval(countdown);
            document.getElementById("countdown").textContent = "";
            document.getElementById("time").textContent = "YOU WIN!";
            document.getElementById("v").style.visibility = "visible";
            // play win music after delay, and stop main music
            setTimeout(function() {
              playM(new Audio("win.mp3"), goSound);
              pauseAudio();
            }, 500);
          }
          //plays match sound effect, ding
          playM(new Audio("yes.wav"),  goSound);
        }

        // else it's a miss
        else {
          setTimeout(function() {
            $("img").not(".match").hide();
            $("img").not(".match").removeClass("face-up");
            count = 0;
          }, 900);
          playM(new Audio("no.wav"),  goSound);
        }
      }
    }
  });
}


function pokeSound(sound, goSound){
  if(goSound){
    var audio;

    switch(sound){
      case "1.png":
      audio = new Audio("charizard.mp3");
      break;

      case "2.png":
      audio = new Audio("venusaur.mp3");
      break;

      case "3.png":
      audio = new Audio("blastoise.mp3");
      break;

      case "4.png":
      audio = new Audio("meganium.mp3");
      break;

      case "5.png":
      audio = new Audio("typhlosion.mp3");
      break;

      case "6.png":
      audio = new Audio("feraligatr.mp3");
      break;

      case "7.png":
      audio = new Audio("sceptile.mp3");
      break;

      case "8.png":
      audio = new Audio("blaziken.mp3");
      break;

      case "9.png":
      audio = new Audio("swampert.mp3");
      break;

      case "10.png":
      audio = new Audio("torterra.mp3");
      break;

      case "11.png":
      audio = new Audio("infernape.mp3");
      break;

      case "12.png":
      audio = new Audio("empoleon.mp3");
      break;
      default:
    }
    audio.volume = .35;
    audio.play(sound);
  }
}

// Plays and stops main audio
var goSound= false;
var mus = document.getElementById("myAudio");
mus.volume = 0.25;
function playAudio() {
  mus.play();
  goSound= true;
}
function pauseAudio() {
  mus.pause();
  goSound= false;
}

//Fisher–Yates shuffle algorithm
function randomize(array){
  var currentIndex = array.length;
  var temporaryValue, randomIndex;

  while (0 !== currentIndex) {

    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }
  return array;
};

function playM(mus, go){
  if(go)
  mus.play();
}
