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
    private $redis;

    /**
     * Создаем подключение, очищаем базу
     *
     * Storage constructor.
     */
    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('localhost', 6379);
        $this->redis->flushDb();
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
     * Сохранение платежа
     *
     * @param IPayment $payment
     * @return IStorage
     */
    public function save(IPayment $payment): IStorage
    {
        if($this->has($payment->paymentId)){
            $this->remove($payment);
        }

        $this->redis->set($payment->paymentId, serialize($payment));

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
        return (bool) $this->redis->get($paymentId);
    }

    /**
     * Удаление платежа
     *
     * @param IPayment $payment
     * @return IStorage
     */
    public function remove(IPayment $payment): IStorage
    {
        $this->redis->delete($payment->paymentId);

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
        if($this->has($paymentId)){
            return unserialize($this->redis->get($paymentId));
        } else {
            throw new Exception\NotFound;
        }

    }

}