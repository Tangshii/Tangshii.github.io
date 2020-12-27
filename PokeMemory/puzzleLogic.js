/*
Extra Features:
1.) End of game notification
2.) Animations/transitions
3.) Game time and music
4.) Multiple Backgrounds
*/

//set inital moves
var moves=0;
/* TIMER */
// set timmer start to 0
var seconds = 0;
var timer = setInterval(function() {
  // increment timer
  if(seconds!=-1){
    seconds++;
    // update timer in html
    document.getElementById("timer").textContent = "timer:"+seconds;
  }
}, 1000);


// when tile clicked call this method
function slide(row,column, w) {

  var cur = document.getElementById(row+ "-" +column).innerHTML;
  // Checking if clicked tiles is not the empty tile
  if (cur != "") {

    // id of tile clicked
    var curId = row + "-" + column;

    // get all the postions of tiles next to click title
    var right = row + "-" + (column+1);
    var left = row + "-" + (column-1);
    var up = (row-1) + "-" + column;
    var down = (row+1) + "-" + column;

    //Checking if white tile on the right
    checkSlide(curId, right, w)
    //Checking if white tile on the left
    checkSlide(curId, left , w)
    //Checking if white tile is above
    checkSlide(curId, up , w)
    //Checking if white tile is below
    checkSlide(curId, down , w)
  }
  // find the empty tile and set the background to empty.
  set();
}


//*Checks if empty tile is next to the clicked tile
function checkSlide(curTile, position , w){

  // checks if not out of bounds, > 4 or < 1
  if(position[0] >= 1 && position[0] <= 4
    && position[2] >= 1 && position[2] <= 4){
      //Checks if white tile is left, right, up or down
      if ( document.getElementById(position).innerHTML=="") {
        //*Adds animation
        document.getElementById(position).style.animation = "pop .5s";
        // swaps clicked tile and empty tile
        swapTiles(curTile, position , w);
      }

    }
  }


  //This does acutal swapping
  function swapTiles(cell1,cell2, w) {
    // increment and update moves in html
    moves++;
    document.getElementById("moves").innerHTML="moves:"+moves;

    // swaps IDs
    var temp = document.getElementById(cell1).className;
    document.getElementById(cell1).className = document.getElementById(cell2).className;
    document.getElementById(cell2).className = temp;

    // Swap number text
    temp = document.getElementById(cell1).innerHTML;
    document.getElementById(cell1).innerHTML = document.getElementById(cell2).innerHTML;
    document.getElementById(cell2).innerHTML = temp;

    // Removes Animation
    document.getElementById(cell1).style.animation = "";

    if(!w)
    checkWin();
  }


  // Checks if user won
  function checkWin(){
    var count = 1;
    var win=true;
    //Checks each tile if it's in order
    for (var i = 1; i <= 4; i++) {
      for (var j = 1; j <= 4; j++) {
        // get the tile class
        var tileClass = document.getElementById(i+"-"+j).className;
        // see if it's in numerical order, if not then false
        if(tileClass != ("tile"+(count)) && tileClass != ("tile"+(count))+" moveable"){
          win=false;
          break;
        }
        count++;
      }
    }

    // if win is true
    if(win){
      // pause audio and play win sound
      audio.pause();
      new Audio("win.mp3").play();

      // change background color and display win message
      document.getElementById("inside").style.backgroundColor= "#d4af37";
      document.getElementById("4-4").innerHTML = "win";
      document.getElementById("win").innerHTML = "Win";
      document.getElementById("you").innerHTML = "You";
      seconds=-1;
    }
  }


  function shuffle() {
    // resets game board
    if(document.getElementById("4-4").innerHTML == "win"){
      document.getElementById("4-4").innerHTML = "";
      document.getElementById("inside").style.backgroundColor= "white";
      document.getElementById("win").innerHTML = "";
      document.getElementById("you").innerHTML = "";
    }

    // Shuffles 1000 times using random row and col
    for (var i = 0; i < 1000; i++) {
      var r=Math.floor(Math.random()*4 + 1);
      var c=Math.floor(Math.random()*4 + 1);
      slide(r,c,true);
    }

    // resets time and move counter
    seconds=0;
    document.getElementById("timer").textContent = "timer:"+seconds;
    moves=0;
    document.getElementById("moves").textContent = "moves:"+seconds;
    set();
  }



  //search for and set empty tile to white and set other images
  function set(){
    for (var i = 1; i <= 16; i++) {
      var a = document.getElementsByClassName("tile"+i)[0];
      //found empty tile, saves postion
      if(a.innerHTML == ""){
        a.style.backgroundImage = "url('empty.png')";
        var row = parseInt(a.id[0]);
        var col = parseInt(a.id[2]);
      }
      // set other images
      else
        a.style.backgroundImage = "url("+background+")";
      // reset class
      a.className = "tile"+i;
    }

    // Get right, left, top, and down tiles from the empty
    var right = document.getElementById(row + "-" + (col+1));
    var left = document.getElementById(row + "-" + (col-1));
    var up = document.getElementById((row-1) + "-" + col);
    var down = document.getElementById((row+1) + "-" + col);
    // Set Movable class to tiles around empty tile
    if(right)
    right.className = right.className+" moveable";
    if(left)
    left.className = left.className+" moveable";
    if(up)
    up.className = up.className+" moveable";
    if(down)
    down.className = down.className+" moveable";
  }


  // randomly set inital background
  function setBack(){
    changeBackground(Math.floor(Math.random()*5 + 1));
  }

  // For backgroundImage
  function changeBackground(val){
    switch(val) {
      case 1:background = "flower.jpg";break;
      case 2:background = "pika.png";break;
      case 3:background = "cha.png";break;
      case 4:background = "blast.png";break;
      case 5:background = "venu.png";break;
      default:
    }
    //set empty tile and all Images
    set();
  }

  var audio =  new Audio("music.mp3");
  // For music
  function music() {
    var play = document.getElementsByName('music');
    if(play[0].checked)
    audio.play();
    else if(play[1].checked)
    audio.pause();
  }
//inspiration from https://www.101computing.net/sliding-puzzle/]
