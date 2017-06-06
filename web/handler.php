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


//function showPayments($storage)
//{
//    $paymentsIterator = $storage->collection->find();
//    $payments = iterator_to_array($paymentsIterator);
//    var_dump($payments);
//}

$storage = Storage::instance();
for ($i = 1; $i <= 1; $i++) {

    $paymentId = 'payment_' . $i;

    $payment = Payment::instance(
        $paymentId,
        new \DateTime('2017-01-02 03:04:05'),
        new \DateTime('2017-02-03 04:05:06'),
        $i % 2 ? true : false,
        Currency::get(Currency::USD),
        14.55 * $i,
        1.34 * $i,
        State::get((int)($i % 4))
    );

    $storage->save($payment);
}

die;
//var_dump($storage->get('payment_1'));
//var_dump($payment);
//var_dump($payment == $storage->get('payment_1'));


$bulk = new MongoDB\Driver\BulkWrite();
//$bulk->insert(['_id' => 1, 'x' => 1]);
$bulk->insert(['x' => 1, 'y' => 'foo']);
$bulk->insert(['x' => 2, 'y' => 'bar']);
$bulk->insert(['x' => 3, 'y' => 'bar']);


$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
//var_dump($manager);

$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
$manager->executeBulkWrite('db.collection', $bulk, $writeConcern);

//var_dump($result->getUpsertedIds());

//$filter = ['x' => ['$gt' => 1]];
$filter = [];
$options = [
    'projection' => ['_id' => 0],
    'sort' => ['x' => -1]
];

$query = new MongoDB\Driver\Query($filter, $options);
$cursor = $manager->executeQuery('db.collection', $query);

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