<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.05.17
 * Time: 12:37
 */
use Playkot\PhpTestTask\Db\Db;

class MyTest
{
    private $id;
    private $amount;
    public $db;

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

    public function __construct( $amount=5 )
    {
        $this->amount = $amount;
        $this->id = (string) new MongoDB\BSON\ObjectID();
        $this->db = new Db();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function save(integer $amount): Test
    {
        
    }

}