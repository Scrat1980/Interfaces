<?php

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/Test/Test.php';
require_once __DIR__ . '/../src/Payment/Payment.php';
require_once __DIR__ . '/../src/Storage/Storage.php';

use Playkot\PhpTestTask\Payment\Payment;
use Playkot\PhpTestTask\Payment\Currency;
use Playkot\PhpTestTask\Payment\State;
use Playkot\PhpTestTask\Storage\Storage;

echo 'ОК ' . file_get_contents('php://input');



$collection = (new MongoDB\Client)->example->users;

class MyClass {
    public $userName = 'admin';
    public $email = 'admin@example.com';
    public $name = 'John';
}

$collection->deleteMany([]);
$object = new MyClass();
$serializedObject = serialize($object);

$insertOneResult = $collection->insertOne([$serializedObject]);

//printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

$result = $collection->find();

foreach ($result as $item) {
    var_dump(unserialize($item[0]));

}
die;



//$storage = Storage::instance();
//for ($i = 1; $i <= 1; $i++) {
//
//    $paymentId = 'payment_' . $i;
//
//    $payment = Payment::instance(
//        $paymentId,
//        new \DateTime('2017-01-02 03:04:05'),
//        new \DateTime('2017-02-03 04:05:06'),
//        $i % 2 ? true : false,
//        Currency::get(Currency::USD),
//        14.55 * $i,
//        1.34 * $i,
//        State::get((int)($i % 4))
//    );
//
//    $storage->save($payment);
//}



//var_dump($storage->get('payment_1'));
//die;

class MyClass {
    public $property1;
}

$bulk = new MongoDB\Driver\BulkWrite();

$object = new MyClass();
$object->property1 = 0;

$bulk->insert(['1' => $object]);
//$bulk->insert(['x' => 2, 'y' => 'bar']);
//$bulk->insert(['x' => 3, 'y' => 'bar']);


$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
//var_dump($manager);

$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
$manager->executeBulkWrite('db.testCollection', $bulk, $writeConcern);

//var_dump($result->getUpsertedIds());

//$filter = ['x' => ['$gt' => 1]];
$filter = [];

$query = new MongoDB\Driver\Query($filter/*, $options*/);
$cursor = $manager->executeQuery('db.testCollection', $query);

//var_dump($cursor);

foreach ($cursor as $document) {
    var_dump($document);
}












//echo '<br>';
//
//$client = new MongoDB\Client("mongodb://localhost:27017");

//$collection = $client->db->payments3;
//$collection->drop();
//$collection->insertOne($payment);
//$collection->insertOne(['prop1'=>1]);

//$searchObject = new \stdClass();
//$searchObject->paymentId = $paymentId;
//$payment = $collection->find($searchObject);
//$findResult = $collection->find(['prop1' => 1]);
//var_dump($findResult->getNext());
//var_dump(iterator_to_array($findResult));
//var_dump( iterator_to_array($findResult)[0] instanceof
//    \Playkot\PhpTestTask\Payment\IPayment);
//echo '<pre>';
//print_r(iterator_to_array($findResult)[0]);
//echo '</pre>';

//
//$searchObject = new stdClass();
//$searchObject->paymentId = $paymentId;
//$findResult = $collection->find($searchObject);
//
//$foundArray = iterator_to_array($findResult);
//var_dump($foundArray);
//foreach ($foundArray as $item) {
//    var_dump($item);
//}

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