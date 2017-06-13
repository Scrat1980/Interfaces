<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01.06.17
 * Time: 11:25
 */

namespace Playkot\PhpTestTask\Storage;


use Playkot\PhpTestTask\Payment\IPayment;
use Playkot\PhpTestTask\Storage\Exception;

class Storage implements IStorage
{
    private $collection;

    /**
     * Создаём коллкцию. Очищаем.
     *
     * Storage constructor.
     */
    public function __construct()
    {
        $this->collection = (new \MongoDB\Client)->storage->payments;
        $this->collection->drop();
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

    /**
     * Сериализуем объект платежа и храним его с ключом $paymentId
     *
     * @param IPayment $payment
     * @return IStorage
     */
    public function save(IPayment $payment): IStorage
    {
        $filter = ['paymentId' => $payment->getId()];
        $replacement = [
            'paymentId' => $payment->getId(),
            'payment' => serialize($payment)
        ];
        $options = ['upsert' => true];

        $this->collection->findOneAndReplace(
            $filter,
            $replacement,
            $options
        );

        return $this;
    }

    /**
     * Проверка на существование платежа
     *
     * @param string $paymentId
     * @return bool
     */
    public function has(string $paymentId): bool
    {
        $record = $this->getRecord($paymentId);

        return ! is_null($record);
    }

    /**
     * Удаление платежа
     *
     * @param IPayment $payment
     * @return IStorage
     */
    public function remove(IPayment $payment): IStorage
    {
        $filter = ['paymentId' => $payment->getId()];
        $this->collection->deleteOne($filter);

        return $this;
    }

    /**
     * Получение платежа
     *
     * @param string $paymentId
     * @return IPayment
     * @throws Exception\NotFound
     */
    public function get(string $paymentId): IPayment
    {
        $record = $this->getRecord($paymentId);
        if(isset($record['payment'])) {
            return unserialize($record['payment']);
        } else {
            throw new Exception\NotFound;
        }

    }

    /**
     * Общая часть get и has: делает запрос в базу и возвращает результат
     *
     * @param $paymentId
     * @return array|null|object
     */
    private function getRecord($paymentId)
    {
        $filter = ['paymentId' => $paymentId];

        return $this->collection->findOne($filter);
    }
}