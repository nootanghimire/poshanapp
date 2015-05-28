<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add new Nutrient</title>
</head>
<body>
  <form action="proc_add_nutrient.php" method="post" accept-charset="utf-8">
    <label for="n_name">Nutrient Name</label>
    <input type="text" name="n_name" id="n_name" placeholder="e.g. Carbohydrate">
    <br>
    <label for="n_type">Nutrient Type</label>
    <input type="text" name="n_type" id="n_type" placeholder="e.g. Solid, Liquid">
    <br>
    <label for="unit_type">Unit Type</label>
    <input type="text" name="unit_type" value="unit_type" placeholder="e.g. Weight, Volume, Area, etc..">
    <br>
    <label for="n_unit">Unit Name</label>
    <input type="text" name="n_unit" value="n_unit" placeholder="e.g. gm, mg">
    <br>
    <input type="submit" value="Add Nutrient" name="submit" />
  </form>
</body>
</html>