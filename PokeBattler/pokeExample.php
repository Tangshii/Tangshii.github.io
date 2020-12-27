<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pokemon Battler</title>
</head>
<body>

  <form class="title" method="post" action="pokeExample2.php">

    <input type="radio" name="choose" required value="charizard">Charizard
    <input type="radio" name="choose" required value="blastoise">Blastoise
    <input type="radio" name="choose" required value="venusaur">Venusaur

    What is your name?
    <input type="text" name="name" required><br>

    Are you a boy or girl?
    <input type="radio" name="gender" required value="boy">Boy
    <input type="radio" name="gender" required value="girl">Girl<br>

    <button type="submit">Submit</button>
  </form>

</body>
</html>
