<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/Test/Test.php';

echo 'ОК ' . file_get_contents('php://input');



$test = new MyTest();
var_dump($test);


//echo '<br>';
//
//$client = new MongoDB\Client("mongodb://localhost:27017");
//
//$collection = $client->db->personnel;
//
//$id = (string) new MongoDB\BSON\ObjectID();
//const AMOUNT = 5;
//$test = new MyTest( AMOUNT, $id );
//$testStatic = MyTest::instance( AMOUNT, $id );
//var_dump( $testStatic );
//echo $testStatic->getId();
//echo '<br>';
//echo $testStatic->getAmount();
//die;

//$person = [
//    'name' => 'Jack',
//    'age' => 26,
//];

//$person = new stdClass();
//$person->name = 'John';
//$person->age = 27;

//$collection->insertOne( $test );
//
//
//
//$resultFind = $collection->find( $test );
////var_dump( $resultFind );
//foreach ($resultFind as $item) {
//    var_dump( $item );
//}
//die;


//
//$newlyEnteredId = $result->getInsertedId();
//$test->setId( $newlyEnteredId );
//
//var_dump( $test );


//
//$result = $collection->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );
//
//echo "Идентификатор вставленного документа '{$result->getInsertedId()}'";

//$foundResults = $collection->find( [
//    'name' => 'Hinterland',
//    'brewery' => 'BrewDog'
//] );
//
//foreach ($foundResults as $entry) {
//    echo $entry['_id'], ': ', $entry['name'], "<br>";
//}