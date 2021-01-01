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
      // Warning this coe can be optimized by using functions*
      // Retrieve info from previous form
      $curMove = $_POST['curMove'];

      $folder = "res/";

      // Retrieve info from session
      session_start();
      $poke = $_SESSION['poke'];
      $aiPoke = $_SESSION['aiPoke'];
      $pokeP = $folder.$poke."2.gif";
      $aiPokeP = $folder.$aiPoke.".gif";

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

      // Displays corresponding animation for user choosen attack
      if($curMove==$move3){
        echo "<img src=$pokeP class=pos1Boost>";
        echo "<img src=$aiPokeP class=pos2>";
      }
      else {
        echo "<img src=$pokeP class=pos1Atk>";
        echo "<img src=$aiPokeP class=pos2Dam>";
      }
      ?>
    </div>

    <?php
    // *USER DAMAGE CALCULATION*
    $boost = "";
    $attNum= 0;
    $defNum= 0;

    $curMove = $_POST['curMove'];
    $dam=0;
    // Calc defense to percentage
    $defEff = 1-($aiDef * .01);

    // If user choosen pokemon is charizard
    if($poke=="charizard"){
      // if sworddance then boost atk and upadte on session
      if($curMove=="swordsdance"){
        $att = $att+5;
        $_SESSION['att'] = $att;
        $boost = "+5 ATK";
        $attNum= 5;
      }
      // if slash then normal calc
      elseif($curMove=="slash")
      $dam = $att*$defEff;
      // if enemy is charizard then normal calc
      elseif($aiPoke=="charizard")
      $dam = $att*$defEff;
      // if enemy blastoise, then flamethrower does minus 3 damage
      elseif($aiPoke=="blastoise" && $curMove=="flamethrower")
      $dam = $att*$defEff-3;
      // if enemy venusaur, then flamethrower does plus 3 damage
      elseif($aiPoke=="venusaur" && $curMove=="flamethrower")
      $dam = $att*$defEff+3;
    }

    // If user choosen pokemon is blastoise
    if($poke=="blastoise"){
      if($curMove=="irondefense"){
        $def = $def+10;
        $_SESSION['def'] = $def;
        $hp = $hp+5;
        $_SESSION['hp'] = $hp;
        $att = $att+1;
        $_SESSION['att'] = $att;
        $boost = "+10 DEF% +5HP +1ATK";
        $defNum= 10;
        $attNum = 1;
      }
      elseif($curMove=="crunch")
      $dam = $att*$defEff;
      elseif($aiPoke=="blastoise"){
        $dam = $att*$defEff;
      }
      elseif($aiPoke=="charizard" && $curMove=="hydropump"){
        $dam = $att*$defEff+3;
      }
      elseif($aiPoke=="venusaur" && $curMove=="hydropump"){
        $dam = $att*$defEff-3;
      }
    }

    // If user choosen pokemon is venusaur
    if($poke=="venusaur"){
      if($curMove=="sythesis"){
        $hp= $hp+20;
        $_SESSION['hp'] = $hp;
        $att= $att+1;
        $_SESSION['att'] = $att;
        $boost = "+20HP +1ATK ";
        $attNum= 1;
        $boostNum= 0;
      }
      elseif($aiPoke=="venusaur"){
        $dam = $att*$defEff;
      }
      elseif($aiPoke=="blastoise"){
        if($curMove=="solarbeam")
        $dam = $att*$defEff+3;
        if($curMove=="bodyslam")
        $dam = $att*$defEff-3;
      }
      elseif($curMove=="bodyslam" )
      $dam = $att*$defEff;
      elseif($aiPoke=="charizard" && $curMove=="solarbeam"){
        $dam = $att*$defEff-3;
      }
    }

    // If damage is negative, then set to zero. Prevent enemy healing
    if($dam < 0)
    $dam =0;

    // Apply the damage
    $aiHp=$aiHp-$dam;
    echo"<div class=bottom>";
    // Display attack, defense, and HP bar of enemy
    echo "Computer: <span class=cap>$aiPoke </span><br>";

    echo "<span class=stat>ATK: </span>";
    for($i=0;$i<$aiAtt;$i++)
    echo"<div class=atk></div>";
    echo "$aiAtt<br>";

    echo "<span class=stat>DEF: </span>";
    for($i=0;$i<$aiDef;$i++)
    echo"<div class=def></div>";
    echo "$aiDef%<br>";

    echo "<span class=stat>HP: </span>";
    for($i=0;$i<$aiHp;$i++)
    echo"<div class=hp></div>";
    for($i=0;$i<$dam;$i++)
    echo"<div class=dam></div>";
    echo "$aiHp<br>";

    // Display attack, defense, and HP bar of User
    echo "<hr>$name: <span class=cap>$poke</span> <br>";
    echo "<span class=stat>ATK: </span>";
    for($i=0;$i<$att-$attNum;$i++)
    echo"<div class=atk></div>";
    for($i=0;$i<$attNum;$i++)
    echo"<div class=atk1></div>";
    echo "$att ";
    if($curMove == "swordsdance")
    echo " $boost";

    echo "<br><span class=stat>DEF: </span>";
    for($i=0;$i<$def-$defNum;$i++)
    echo"<div class=def></div>";
    for($i=0;$i<$defNum;$i++)
    echo"<div class=def1></div>";
    echo "$def%";
    if($curMove == "irondefense")
    echo " $boost";

    echo "<br><span class=stat>HP: </span>";
    for($i=0;$i<$hp;$i++)
    echo"<div class=hp></div>";
    echo "$hp";
    if($curMove == "sythesis")
    echo " $boost";

    // Display damage and boost info to user
    echo "<hr>$name's <span class=cap>$poke</span> used <span class=cap>$curMove</span>.
    $boost<br> It did $dam damage to Computer's <span class=cap>$aiPoke</span><br>";

    // Updates HPs on session
    $_SESSION['hp']=$hp;
    $_SESSION['aiHp']=$aiHp;

    // if enemy HP is zero, then you win. Update score
    if($aiHp<=0){
      echo "<a href=score.php>Next</a>";
      $_SESSION['win'] = true;
      $_SESSION['scoreW']++;
    }
    // else goto enemy's turn
    else
    echo "<a href=attackComp.php>Next</a>";
    ?>
    <br> click next
  </div>
  </div>
</body>
</html>
