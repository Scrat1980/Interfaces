<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.05.17
 * Time: 12:37
 */
class MyTest
{
    private $id;
    private $amount;

    /*
     * Фабрика
     */
    public static function instance(
        $amount,
        $id
    ): MyTest
    {
        return new self ( $amount, $id );
    }

    public function __construct( $amount, $id )
    {
        $this->amount = $amount;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAmount()
    {
        return $this->amount;
    }

}