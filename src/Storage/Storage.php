<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01.06.17
 * Time: 11:25
 */

namespace Playkot\PhpTestTask\Storage;


use Playkot\PhpTestTask\Payment\IPayment;
use Playkot\PhpTestTask\Db\Db;
use Playkot\PhpTestTask\Payment\Payment;
use Playkot\PhpTestTask\Storage\Exception;
//use Playkot\PhpTestTask\Storage\Exception\Payment;

class Storage implements IStorage
{
    public $collection;
    public $db;

    public function __construct()
    {
        $this->db = new Db();
        $this->collection = Db::COLLECTION;

        $bulk = new \MongoDB\Driver\BulkWrite();
        $bulk->delete([]);
        $writeConcern = new \MongoDB\Driver\WriteConcern(\MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $this->db->manager->executeBulkWrite($this->collection, $bulk, $writeConcern);


//        var_dump($this->db);
//        die;
    }

    /**
     * Фабричный метод для создания экземпляра хранилища
     *
     * @param array $config
     * @return IStorage
     */
    public static function instance(array $config = null): IStorage
    {
        return new self;
    }

    public function save(IPayment $payment): IStorage
    {
        $paymentId = $payment->paymentId;

        if($this->has($paymentId)) {
            $paymentToDelete = $this->get($paymentId);
            $this->remove($paymentToDelete);
        }

        $bulk = new \MongoDB\Driver\BulkWrite();
        $bulk->insert($payment);
        $writeConcern = new \MongoDB\Driver\WriteConcern(
            \MongoDB\Driver\WriteConcern::MAJORITY,
            1000
        );
        $this->db->manager->executeBulkWrite(
            $this->collection,
            $bulk,
            $writeConcern
        );

        return $this;
    }

    public function has(string $paymentId): bool
    {
        $cursor = $this->getQueryResult($paymentId);

        return (count($cursor)>0);
    }

    public function remove(IPayment $payment): IStorage
    {
        $bulk = new \MongoDB\Driver\BulkWrite();
        $paymentId = $payment->paymentId;
        $bulk->delete([$paymentId]);
        $writeConcern = new \MongoDB\Driver\WriteConcern(
            \MongoDB\Driver\WriteConcern::MAJORITY,
            1000
        );
        $this->db->manager->executeBulkWrite(
            $this->collection,
            $bulk,
            $writeConcern
        );

        return $this;
    }

    public function get(string $paymentId): IPayment
    {
        $cursor = $this->getQueryResult($paymentId);

        if (count($cursor)>0) {
            $paymentRecord = $cursor[0];

            var_dump($paymentRecord);
            die;
            $payment = Payment::instance(
                $paymentRecord->paymentId,
                $paymentRecord->created,
                $paymentRecord->updated,
                $paymentRecord->isTest,
                $paymentRecord->currency,
                $paymentRecord->amount,
                $paymentRecord->taxAmount,
                $paymentRecord->state
            );
        } else {
            throw new Exception\NotFound;
        }

        return $payment;
    }

    private function getQueryResult($paymentId)
    {
        $filter = [ 'paymentId' => $paymentId ];
        $query = new \MongoDB\Driver\Query($filter);
        $cursor = $this->db->manager->executeQuery($this->collection, $query);

        $paymentsArray = $cursor->toArray();

        return $paymentsArray;
    }
}