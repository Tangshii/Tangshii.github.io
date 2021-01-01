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
    <div class="background">
      <?php
      // Retrieve info from session
      session_start();
      $poke = $_SESSION['poke'];
      $aiPoke = $_SESSION['aiPoke'];
      $pokeP = "res/".$poke."2.gif";
      $aiPokeP = "res/".$aiPoke.".gif";

      $att= $_SESSION['att'];
      $def=$_SESSION['def'];
      $hp =$_SESSION['hp'];
      $aiAtt = $_SESSION['aiAtt'] ;
      $aiDef = $_SESSION['aiDef'] ;
      $aiHp = $_SESSION['aiHp'];

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
        echo"<img src=res/boy.gif class=trainer>";
      }
      elseif( $gender=="girl"){
        echo"<img src=res/girl2.gif class=trainer>";
      }
      echo"<img src=res/gary.gif class=rival>";

      // Randomly picks enemey move
      $com = rand(1,3);
      if($com==1)
      $com = $aimove1;
      else if($com==2)
      $com = $aimove2;
      else if($com==3)
      $com = $aimove3;

      $aicurmove=$com;

      // Displays corresponding animation for user choosen attack
      if($aicurmove==$aimove3){
        echo "<img src=$aiPokeP class=pos2Boost>";
        echo "<img src=$pokeP class=pos1>";
      }
      else {
        echo "<img src=$pokeP class=pos1Dam>";
        echo "<img src=$aiPokeP class=pos2Atk>";
      }

      ?>
    </div>
    <?php
    // *ENEMY DAMAGE CALCULATION*
    $boost ="";
    $attNum= 0;
    $defNum= 0;
    $dam=0;
    // Calc defense to percentage
    $defEff = 1-($def * .01);

    // If enemy choosen pokemon is charizard
    if($aiPoke=="charizard"){
      if($aicurmove=="swordsdance"){
        $aiAtt = $aiAtt+5;
        $_SESSION['aiAtt'] = $aiAtt;
        $boost = "+5 ATK";
        $attNum= 5;
      }
      elseif($aicurmove=="slash")
      $dam = $aiAtt*$defEff;
      elseif($poke=="charizard")
      $dam = $aiAtt*$defEff;
      elseif($poke=="blastoise" && $aicurmove=="flamethrower")
      $dam = $aiAtt*$defEff-3;
      elseif($poke=="venusaur" && $aicurmove=="flamethrower")
      $dam = $aiAtt*$defEff+3;
    }

    // If user enemy pokemon is blastoise
    if($aiPoke=="blastoise"){
      if($aicurmove=="irondefense"){
        $aiDef= $aiDef+10;
        $_SESSION['aiDef'] = $aiDef;
        $aiHp = $aiHp+5;
        $_SESSION['aiHp'] = $aiHp;
        $att = $att+1;
        $_SESSION['att'] = $att;
        $boost = "+10 DEF% +5HP +1ATK";
        $defNum= 10;
        $attNum =1;
      }
      elseif($aicurmove=="crunch")
      $dam = $aiAtt*$defEff;
      elseif($poke=="blastoise")
      $dam = $aiAtt*$defEff;
      elseif($poke=="venusaur" && $aicurmove=="hydropump")
      $dam = $aiAtt*$defEff-3;
      elseif($poke=="charizard" && $aicurmove=="hydropump")
      $dam = $aiAtt*$defEff+3;
    }

    // If user enemy pokemon is venusaur
    if($aiPoke=="venusaur"){
      if($aicurmove=="sythesis"){
        $aiHp = $aiHp+20;
        $_SESSION['aiHp'] = $aiHp;
        $aiAtt= $aiAtt+1;
        $_SESSION['aiDef'] = $aiDef;
        $boost = "+20HP +1ATK ";
        $attNum= 1;
        $boostNum= 0;
      }
      elseif($poke=="venusaur")
      $dam = $aiAtt*$defEff;
      elseif($poke=="blastoise"){
        if($aicurmove=="solarbeam")
        $dam = $aiAtt*$defEff+3;
        if($aicurmove=="bodyslam")
        $dam = $aiAtt*$defEff-3;
      }
      elseif($aicurmove=="bodyslam" )
      $dam = $aiAtt*$defEff;
      elseif($poke=="charizard" && $aicurmove=="solarbeam")
      $dam = $aiAtt*$defEff-3;
      elseif($poke=="blastoise" && $aicurmove=="solarbeam")
      $dam = $aiAtt*$defEf+3;
    }

    // If damage is negative, then set to zero. Prevent enemy healing
    if($dam < 0)
    $dam =0;
    // Apply the damage
    $hp=$hp-$dam;
    echo"<div class=bottom>";
    // Display attack, defense, and HP bar of enemy
    echo "Computer: <span class=cap>$aiPoke</span> <br>";

    echo "<span class=stat>ATK: </span>";
    for($i=0;$i<$aiAtt-$attNum;$i++)
    echo"<div class=atk></div>";
    for($i=0;$i<$attNum;$i++)
    echo"<div class=atk1></div>";
    echo "$aiAtt";
    if($aicurmove == "swordsdance")
    echo " $boost";

    echo "<br><span class=stat>DEF: </span>";
    for($i=0;$i<$aiDef-$defNum;$i++)
    echo"<div class=def></div>";
    for($i=0;$i<$defNum;$i++)
    echo"<div class=def1></div>";
    echo "$aiDef%";
    if($aicurmove == "irondefense")
    echo " $boost";

    echo "<br><span class=stat>HP: </span>";
    for($i=0;$i<$aiHp;$i++)
    echo"<div class=hp></div>";
    echo "$aiHp";
    if($aicurmove == "sythesis")
    echo " $boost";


    // Display attack, defense, and HP bar of User
    echo "<br><hr>$name: <span class=cap>$poke</span> <br>";
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
    for($i=0;$i<$dam;$i++)
    echo"<div class=dam></div>";
    echo "$hp";

    // Display damage and boost info to user
    echo "<br><br>Computers's <span class=cap>$aiPoke</span> used <span class=cap>
    $aicurmove</span>. $boost<br> It did $dam damage to $name's <span class=cap>$poke</span><br>";

    // Updates HPs on session
    $_SESSION['hp']=$hp;
    $_SESSION['aiHp']=$aiHp;

    // if user HP is zero, then you win. Update score
    if($hp<=0){
      echo "<a href=score.php>Next</a>";
      $_SESSION['win'] = false;

      $_SESSION['scoreL']++;
    }
    // else goto back to move selection turn
    else
    echo "<a href=move.php>Next</a>";
    ?>
    <br> click next
  </div>
  </div>
</body>
</html>
