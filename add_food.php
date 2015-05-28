<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Food</title>
</head>
<body>
  <form action="proc_add_food.php" method="post" accept-charset="utf-8" onsubmit="return false;">
    <label for="food_name">Food Name: </label>
    <input type="text" id="food_name" name="food_name" placeholder="e.g. Rice" />
    <br>
    <label for="food_type">Food Type: </label>
    <input type="text" id="food_type" name="food_type" placeholder="e.g. Cereal. Type to see suggestions!" />
    <br>
    <input type="checkbox" name="need_to_cook" id="need_to_cook">
    <label for="need_to_cook">Needs Cooking? </label>
    <br>
    <hr>
    <h2>Nutrient Information</h2>
    <select name="nutrient_name_req" id="nutrient_name_req" onfocus="rePopulateList(this);" onblur="showUnit(this);">
      <option value="nutrient_id">Click to Load..</option>
       <!-- ^ Thing above is  Dynamically Generated.  -->
    </select>
    <input type="text" name="nutrient_quantity_req" id="nutrient_quantity_req" />
    <!-- dynamically generate unit and enter in the span tag below -->
    <span></span>

    <div id="additional_nutrient"><!-- JS will Create Additional Elements! --></div>
    <br>
    <a href="#" onclick="addNutrientSelectBox();">Add New Nutrient Information</a>
    <br>
    <a href="add_nutrient.php" target="_blank">Nutrient not found? Click to add!</a>
    <br>
    <hr>
    <button onclick="submitForm();">Add Food</button>
  </form>
</body>
<script>
  //All Javascript here!


  function qS(str){return document.querySelector(str);}
  function qSA(str){return document.querySelectorAll(str);}

  var additional_nutrients = 0;

  var Ajax = new XMLHttpRequest();
//Might need this -->
//self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//
  function rePopulateList(obj){
    Ajax.open('GET', "get_all_nutrients.php", true);
    Ajax.onreadystatechange = function() {
      if (Ajax.readyState == 4) {
        obj.innerHTML = Ajax.responseText; //responseText will contain HTML
      }
    }
    Ajax.send();
  }

  function addNutrientSelectBox(){
    var obj = qS('#additional_nutrient');
    newObj = document.createElement('select');
    newObj.setAttribute("name", "nutrient_name_"+additional_nutrients);
    newObj.setAttribute("class", "");
    newObj.setAttribute("id", "nutrient_name_"+additional_nutrients);
    newObj.setAttribute("onfocus", "rePopulateList(this);");
    newObj.setAttribute("onblur", "showUnit(this);");
    newObj.innerHTML = "<option value=\"nutrient_id\">Click to Load..</option>"; // dynamically Generate here too :D
    obj.appendChild(newObj);
    newObj2 = document.createElement('input');
    newObj2.setAttribute("type", "text");
    newObj2.setAttribute("name", "nutrient_quantity_"+additional_nutrients);
    newObj2.setAttribute("id", "nutrient_quantity_"+additional_nutrients);
    obj.appendChild(newObj2);
    obj.appendChild(document.createElement("span"));
    obj.appendChild(document.createElement("br"));
    additional_nutrients = additional_nutrients + 1;
  }

  function showUnit(obj){
//    alert(obj.previousElementSibling.value);
    Ajax.open('GET', "get_nutrient_unit.php?id="+obj.value, true);
    Ajax.onreadystatechange = function() {
      if (Ajax.readyState == 4) {
        //alert(Ajax.responseText);
        obj.nextElementSibling.nextElementSibling.innerHTML = Ajax.responseText;
      }
    }


    Ajax.send();
  }

  function submitForm(){
    Ajax.open('POST', "proc_add_food.php", true);
    Ajax.onreadystatechange = function () {
      if (Ajax.readyState == 4){
        //Check JSON response and do stuffs accordingly.
      }
    }
    //do preparations to create json
    var frm = qS('form');
    var a = {
      "food_name":document.getElementById('food_name').value,
      "food_type":document.getElementById('food_type').value,
      "need_to_cook":document.getElementById('need_to_cook').value,
      "nutrients":{

      }
    };

    Ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    Ajax.send("send_param=<json_content>");
  }
</script>
</html>