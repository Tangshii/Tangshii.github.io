<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pokemon Battler</title>
  <link href="pokemonStyle.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="mid">
  <img src="res/dsnew.png"  class="over">
  <div class="center">
    <div class="large">
      <?php
      session_start();
      $name = $_SESSION['name'];
      $gender= $_SESSION['gender'];
      $win = $_SESSION['win'];
      $poke = $_SESSION['poke'];
      $aiPoke = $_SESSION['aiPoke'];
      $pokeP = "res/".$poke.".gif";
      $aiPokeP = "res/".$aiPoke.".gif";
      $scoreW=$_SESSION['scoreW'];
      $scoreL=$_SESSION['scoreL'];

      if($win){
        echo "<img src=res/win2.gif >";
        echo " <div class=bottom>";
        echo "$name YOU WON!";
        echo "<br>Wins: $scoreW - Loses: $scoreL";


        echo"<br><a href=index.html>again</a>";
        if( $gender=="boy"){
          echo"<img src=res/boy.gif >";
        }
        elseif( $gender=="girl"){
          echo"<img src=res/girl2.gif >";
        }
        echo"<img src=$pokeP>";

      }
      elseif(!$win){
        echo "<img src=res/lose.gif> ";
        echo " <div class=bottom>";
        echo "<br>$name YOU LOST!";
        echo "<br>Wins: $scoreW - Loses: $scoreL ";

        echo "<br><a href=index.php>again</a> <img src=res/gary.gif> <img src=$aiPokeP>";
      }
      ?>
    </div>
  </div>
  </div>
  </div>
  </div>
</body>
</html>
