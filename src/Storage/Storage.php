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

class Storage implements IStorage
{
    public function __construct()
    {

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
        
    }

    public function has(string $paymentId): bool
    {
        
    }

    public function get(string $paymentId): IPayment
    {
        
    }

    public function remove(IPayment $payment): IStorage
    {
        
    }
}