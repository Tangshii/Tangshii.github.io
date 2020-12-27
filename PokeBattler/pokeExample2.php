<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pokemon Battler</title>
</head>
<body>
      <?php
      // Retrieve info from previous form
      $choose = $_POST['choose'];
      $name = $_POST['name'];
      $gender = $_POST['gender'];
      // User is Charizard
      if($choose=="charizard"){
        $ATK = 25;
        $HP = 50;
        $move1="slash";
        $move2="flamethrower";
      }...
      // Save all info to SESSION
      session_start();
      $_SESSION['poke'] = $choose;
      $_SESSION['att'] = $ATK;
      $_SESSION['hp'] = $hp;
      $_SESSION['move1'] = $move1;
      $_SESSION['move2'] = $move2;
      // Randomly picks enemy pokemon
      $comp = rand(1,3);
      if($comp==1)
        $comp = "charizard"
      if($comp==2)
        $comp = "blastoise";...
      // assign stats, repeat like before
      if($comp=="blastoise"){
        $aiATK = 20;
        $HP = 60;
        $move1="crunch";
        $move2="hydropump";
      }
      session_start();
      $_SESSION['aipoke'] = $comp;
      $_SESSION['aiatk'] = $aiATK;
      $_SESSION['maiove1'] = $aimove1;...
      ?>

      <?php
      session_start();
      $choose = $_SESSION['poke'];
      $move1 = $_SESSION['move1'];
      $move2 = $_SESSION['move2']
      ?>
      <form method="post" action="attack.php">
        <input type="radio" name="curMove" required value=slash> slash
        <input type="radio" name="curMove" required value=flmethwer>flmethwer
        <button type="submit">Submit</button>
      </form>



      <?php
      $curMove = $_POST['curMove'];
      session_start();
      $poke = $_SESSION['poke'];
      $ATK = $_SESSION['atk'];
      $HP = $_SESSION['hp'];
      $aiHP = $_SESSION['aihp'];

      if($curMove=="swordsdance"){
          $ATK = $ATK+5;
          $_SESSION['atk'] = $ATK
        }
      elseif($curMove=="slash")
          $aiHP = $aiHP - $ATK;

      $_SESSION['aihp'] = $aiHP;





      ?>
      <br>
      <a href="move.php"> Next </a>

      <br> click next
    </div>
  </body>
  </html>
