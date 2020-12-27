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
    <img src="battle3.gif" class="battle">
    <div class="background">
      <?php
      // Retrieve info from previous form
      $choose = $_POST['choose'];
      $name = $_POST['name'];
      $gender = $_POST['gender'];
      //
      $char1 = "slash";
      $char2 = "flamethrower";
      $char3 = "swordsdance";

      $blas1 = "crunch";
      $blas2 = "hydropump";
      $blas3 = "irondefense";

      $ven1 = "bodyslam";
      $ven2 = "solarbeam";
      $ven3 = "sythesis";

      // Sets attack, defense, hp, and move set according to user choosen pokemon
      // User Charizard
      if($choose=="charizard"){
        $att = 25;
        $def = 15;
        $hp = 50;
        $move1 = $char1;
        $move2 = $char2;
        $move3 = $char3;
        echo"<img src=charizard2.gif class=pos1><br>";
      }
      // User Blastoise
      else if($choose=="blastoise"){
        $att = 20;
        $def = 25;
        $hp = 50;
        $move1 = $blas1;
        $move2 = $blas2;
        $move3 = $blas3;
        echo"<img src=blastoise2.gif class=pos1>";
      }
      // User Venusaur
      else if($choose=="venusaur"){
        $att = 15;
        $def = 20;
        $hp = 55;
        $move1 = $ven1;
        $move2 = $ven2;
        $move3 = $ven3;
        echo"<img src=venusaur2.gif class=pos1>";
      }
      echo"<br>";

      // Randomly picks enemy pokemon
      $comp = rand(1,3);
      if($comp==1)
      $comp = "charizard";
      else if($comp==2)
      $comp = "blastoise";
      else if($comp==3)
      $comp = "venusaur";


      // Sets attack, defense, hp, and move set according to ENEMY choosen pokemon
      // Enemy Charizard
      if($comp=="charizard"){
        $aiAtt = 25;
        $aiDef = 15;
        $aiHp = 50;
        $aimove1 = $char1;
        $aimove2 = $char2;
        $aimove3 = $char3;
        echo"<img src=charizard.gif class=pos2>";
      }
      // Enemy Blastoise
      elseif($comp=="blastoise"){
        $aiAtt = 20;
        $aiDef = 25;
        $aiHp = 50;
        $aimove1 = $blas1;
        $aimove2 = $blas2;
        $aimove3 = $blas3;
        echo"<img src=blastoise.gif class=pos2>";
      }
      // Enemy Venusauer
      elseif($comp=="venusaur"){
        $aiAtt = 15;
        $aiDef = 20;
        $aiHp = 55;
        $aimove1 = $ven1;
        $aimove2 = $ven2;
        $aimove3 = $ven3;
        echo"<img src=venusaur.gif class=pos2>";
      }

      // Save all stats and moveset info to SESSION
      session_start();
      $_SESSION['poke'] = $choose;
      $_SESSION['aiPoke'] = $comp;

      $_SESSION['att'] = $att;
      $_SESSION['def'] = $def;
      $_SESSION['hp'] = $hp;
      $_SESSION['aiAtt'] = $aiAtt;
      $_SESSION['aiDef'] = $aiDef;
      $_SESSION['aiHp'] = $aiHp;

      $_SESSION['move1'] = $move1;
      $_SESSION['move2'] = $move2;
      $_SESSION['move3'] = $move3;

      $_SESSION['aimove1'] = $aimove1;
      $_SESSION['aimove2'] = $aimove2;
      $_SESSION['aimove3'] = $aimove3;

      $_SESSION['name'] = $name;
      $_SESSION['gender'] = $gender;

      // Displays User character based on gender and enemy character
      if( $gender=="boy"){
        echo"<img src=boy.gif class=trainer>";
      }
      elseif( $gender=="girl"){
        echo"<img src=girl2.gif class=trainer>";
      }
      echo"<img src=gary.gif class=rival>";
      ?>
    </div>
    <div class=bottom>
      <?php
      // Display attack, defense, and HP bar of enemy
      echo"Computer choose $comp!<br>";
      echo "<span class=stat>ATK: </span>";
      for($i=0;$i<$aiAtt;$i++)
      echo"<div class=atk></div>";
      echo "$aiAtt ";

      echo "<br><span class=stat>DEF: </span>";
      for($i=0;$i<$aiDef;$i++)
      echo"<div class=def></div>";
      echo "$aiDef%";

      echo "<br><span class=stat>HP: </span>";
      for($i=0;$i<$aiHp;$i++)
      echo"<div class=hp></div>";
      echo "$aiHp";

      // Display attack, defense, and HP bar of User
      echo"<br><hr>$name choose $choose!<br>";
      echo "<span class=stat>ATK: </span>";
      for($i=0;$i<$att;$i++)
      echo"<div class=atk></div>";
      echo "$att ";

      echo "<br><span class=stat>DEF: </span>";
      for($i=0;$i<$def;$i++)
      echo"<div class=def></div>";
      echo "$def%";

      echo "<br><span class=stat>HP: </span>";
      for($i=0;$i<$hp;$i++)
      echo"<div class=hp></div>";
      echo "$hp";

      ?>
      <br>
      <a href="move.php"> Next </a>

      <br> click next
    </div>
    </div>
  </body>
  </html>
