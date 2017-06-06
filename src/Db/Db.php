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
    const COLLECTION = 'db.payments_storage';

    private static $instance;
    public $manager;
//    public $database;

    public function __construct() {
        $connectionString = "mongodb://" . self::DB_HOST . ":" . self::DB_PORT;
        $this->manager = new \MongoDB\Driver\Manager($connectionString);
    }

//    static public function instantiate(){
//        if(!isset(self::$instance)){
//            $class = __CLASS__;
//            self::$instance = new $class;
//        }
//        return self::$instance;
//    }
//
//    public function getCollection($name){
//        return $this->database->selectCollection($name);
//    }

}