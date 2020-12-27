<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pokemon Battler</title>
  <link href="pokemonStyle.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="mid">
  <img src="dsnew.png"  class="over">
  <div class="center">
    <div class="background">
      <?php
      // Retrieve info from session
      session_start();
      $poke = $_SESSION['poke'];
      $aiPoke = $_SESSION['aiPoke'];
      $pokeP = $poke."2.gif";
      $aiPokeP = $aiPoke.".gif";

      $move1 = $_SESSION['move1'];
      $move2 = $_SESSION['move2'];
      $move3 = $_SESSION['move3'];
      $aimove1 = $_SESSION['aimove1'];
      $aimove2 = $_SESSION['aimove2'];
      $aimove3 = $_SESSION['aimove3'];

      $name = $_SESSION['name'];
      $gender= $_SESSION['gender'];

      // Displays User character based on gender and enemy character
      if( $gender=="boy"){
        echo"<img src=boy.gif class=trainer>";
      }
      elseif( $gender=="girl"){
        echo"<img src=girl2.gif class=trainer>";
      }
      echo"<img src=gary.gif class=rival>";
      // Display pokemons
      echo "<img class=pos1 src=$pokeP>";
      echo "<img class=pos2 src=$aiPokeP>";
      ?>

      <br>
    </div>
    <div class=bottom>
      Pick your move
      <?php

      //Forms for user to pick attack move
      if($poke=="charizard") {
        ?>
        <form class="title" method="post" action="attack.php" autocomplete="on" class="formLayout">
          <input type="radio" name="curMove" required value=slash><?php echo "$move1"?><br>
          <input type="radio" name="curMove" required value=flamethrower><?php echo "$move2"?><br>
          <input type="radio" name="curMove" required value=swordsdance><?php echo "$move3"?><br><br>
          <button type="submit">Submit</button>
        </form>
        <?php
      }
      ?>

      <?php
      if($poke=="blastoise") {
        ?>
        <form class="title" method="post" action="attack.php" autocomplete="on" class="formLayout">
          <input type="radio" name="curMove" required value=crunch><?php echo "$move1"?><br>
          <input type="radio" name="curMove" required value=hydropump><?php echo "$move2"?><br>
          <input type="radio" name="curMove" required value=irondefense><?php echo "$move3"?><br><br>
          <button type="submit">Submit</button>
        </form>
        <?php
      }
      ?>

      <?php
      if($poke=="venusaur") {
        ?>
        <form class="title" method="post" action="attack.php" autocomplete="on" class="formLayout">
          <input type="radio" name="curMove" required value="bodyslam"><?php echo "$move1"?><br>
          <input type="radio" name="curMove" required value=solarbeam><?php echo "$move2"?><br>
          <input type="radio" name="curMove" required value=sythesis><?php echo "$move3"?><br><br>
          <button type="submit">Submit</button>
        </form>
        <?php
      }
      ?>
      click next
    </div>
    </div>
  </body>
  </html>
