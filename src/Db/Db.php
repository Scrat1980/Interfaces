<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01.06.17
 * Time: 12:21
 */

namespace Playkot\PhpTestTask\Db;


class Db
{
    const DB_HOST = 'localhost';
    const DB_PORT = 27017;
    const DB_NAME = 'payments_storage';

    private static $instance;
    public $connection;
    public $databse;

    public function __construct() {
        $connectionString = "mongodb://" . self::DB_HOST . ":" . self::DB_PORT;
        try {
            $this->connection = new \MongoDB\Client($connectionString);
            $this->databse = $this->connection->{self::DB_NAME};
        } catch (MongoConnectionException $e) {
            throw $e;
        }
    }

    static public function instantiate(){
        if(!isset(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

    public function getCollection($name){
        return $this->databse->selectCollection($name);
    }

}