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
      <img src="res/intro2.gif" >
      <div class="bottom"><br>

        <a href=index.php >start</a>
        <a href=playMusic.html target="_blank" class="music">music</a>
        <br><br><br><br>click start
        <?php
        session_start();
        $_SESSION['scoreW']=0;
        $_SESSION['scoreL']=0;
        ?>
      </div>
    </div>
  </div>
</body>

</html>
