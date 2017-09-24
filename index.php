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

$location = "fridge.csv";
$fridge = new Fridge(readCSV($location));
echo json_encode($fridge->getFood());

?>