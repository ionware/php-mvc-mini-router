<?php

namespace sys\Database;

/*
* A little database abstraction class for DB tables to
* Select all, filter(Buggy), and insert data.
*
* Intended for Models to implement.
*
*/

abstract class QueryBuilder
{

    protected $pdo;

    public function __construct(\PDO $pdo){

        $this->pdo = $pdo;
    }

    public function selectAll($table, $colums){

        $query = "select " . implode(", ", $colums) . " from {$table}";

        $statement = $this->pdo->prepare($query);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectWhere($table, $columns, $filter, $data){

        $query = "select ". implode(", ", $columns) . " from {$table} where {$filter} ";

        $statement = $this->pdo->prepare($query);

        $statement->execute($data);

        return $statement->fetchAll();
    }

    public function insert($table, $columns){

        $query = "INSERT INTO {$table} (". implode(", ", array_keys($columns)).") VALUES(".
            implode(", ", array_map(function($param){
                return ":".$param;
            }, array_keys($columns))). ")";

        $statement = $this->pdo->prepare($query);

        try{

            $statement->execute($columns);
            return true;

        } catch(\PDOException $e){

           // var_dump($e);
           // Let the error parse_silently for now
        }
    }
}