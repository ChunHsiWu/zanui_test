<?php
/**
 * Created by PhpStorm.
 * User: Eddie_wu
 * Date: 24/09/2017
 * Time: 9:05 PM
 */
/*
class TestClass{
    public $value1;
    function __construct($val1)
    {
        $this->value1 = $val1;
    }
    function returnVal(){
        echo $this->value1;
    }
    function setVal($val){
        $this->value1 = $val;
    }

}
$val1 = new TestClass('It works');
$val1->returnVal();
$val1->setVal('It works again');
$val1->returnVal();
*/
function readCSV($location)
{
    $readArray = array();
    $file = fopen($location, "r");
    while (!feof($file)) {
        array_push($readArray, fgetcsv($file));
    }
    fclose($file);
    return $readArray;
}

function putCSV($location, $list)
{
    $file = fopen($location, 'w');

    foreach ($list as $fields) {
        fputcsv($file, $fields);
    }
    fclose($file);
}
function readJSON($location)
{
    $readArray = array();
    $str = file_get_contents($location);
    $json = json_decode($str, true);
    return $json;
}

function putJSON($location, $json)
{
    file_put_contents($location, json_encode($json));
}
class Fridge
{
    public $food;
    function __construct($food)
    {
        $this->food = $food;
    }
    function getFood(){
        return $this->food;
    }
    function setFood($food){
        $this->food = $food;
    }
}
class Recipes
{
    private $recipes;
    function __construct($recipes)
    {
        $this->recipes = $recipes;
    }
    function getRecipes(){
        return $this->recipes;
    }
    function addRecipes($recipes){
        array_push($this->recipes, $recipes);
    }
}

$location = "fridge.csv";
$fridge = new Fridge(readCSV($location));
//echo json_encode($fridge->getFood());

$location = "recipes.json";
$recipes = new Recipes(readJSON($location));
//echo $recipes->getRecipes();

$today = date('d/m/Y');

foreach($recipes->getRecipes() as $recipe)
{
    $name = $recipe["name"];
    $ingredients = $recipe["ingredients"];
    $count=0;
    $hasFood=[];
    foreach($ingredients as $ingredient)
    {
        $hasFood[$count] = false;
        $item = $ingredient["item"];
        $amount = (int)$ingredient["amount"];
        // check food is enough
        foreach($fridge->getFood() as $food)
        {
            if(($item == trim($food[0])) && ($amount <= $food[1]) && ($today < $food[3]))
            {
                // has $ingredient
                $hasFood[$count] = true;
                break;
            }
        }
        $count +=1;
    }
    $count = 0;
    if(in_array(false, $hasFood))
    {
        echo 'you dont have enough food';
    }
    else
    {
        echo 'u can make '.$name;
        break;
        //return $name;   // return recipe
    }

}


?>