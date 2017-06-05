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
use Playkot\PhpTestTask\Storage\Exception\NotFound;
//use Playkot\PhpTestTask\Storage\Exception\Payment;

class Storage implements IStorage
{
    private $collection;

    public function __construct()
    {
        $db = new Db();
        $this->collection = $db->getCollection('paymentsCollection');
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
//        $this->collection->drop();

        $paymentId = $payment->paymentId;

        if($this->has($paymentId)) {
            $paymentToDelete = $this->get($paymentId);
            $this->remove($paymentToDelete);
        }

        $this->collection->insertOne($payment);

        return $this;
    }

    public function has(string $paymentId): bool
    {
        return (count($this->getPaymentArray($paymentId))>0);
    }

    public function get(string $paymentId): IPayment
    {
        $paymentArray = $this->getPaymentArray($paymentId);

        try {

            if (count($paymentArray) > 0) {
                $outputPayment = new Payment(
                    $paymentArray['paymentId'],
                    $paymentArray['created'],
                    $paymentArray['updated'],
                    $paymentArray['isTest'],
                    $paymentArray['currency'],
                    $paymentArray['amount'],
                    $paymentArray['taxAmount'],
                    $paymentArray['state']
                );
            } else {
                throw new NotFound('Trying to get not existing payment');
            }
        } catch (Exception $e) {
            echo 'Caught exception';
        }

        return $outputPayment;
    }

    public function remove(IPayment $payment): IStorage
    {
        $this->collection->deleteOne($payment);
//        remove(['paymentId' => $payment->getId()]);
        return $this;
    }

    private function getPaymentArray(string $paymentId): array
    {
        $searchObject = new \stdClass();
        $searchObject->paymentId = $paymentId;
        $payment = $this->collection->findOne($searchObject);
        if($payment) {
            $paymentArray = iterator_to_array($payment);
        } else {
            $paymentArray = [];
        }

        return $paymentArray;
    }
}