<?php

class Db extends Singleton
{
    protected $pdo;
    public static $countSql = 0;
    public static $queries = [];
    public $config;

    public function __construct()
    {
        $this->config = new Registry(include APP.'config.db.php');
        require 'rb-mysql.php';
        \R::setAutoResolve(TRUE);  
        \R::setup($this->config->dsn, $this->config->user, $this->config->pass);
        \R::freeze(true);
//        \R::fancyDebug(true);
    }

    public function execute($sql, $params = [])
    {
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function query($sql, $params = [])
    {   
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }
}
