<?php

namespace sys\Database;


class Connection
{
    public static function make($config){
        /*
         * Creates an New PDO object instance for DB Transc.
         *
         * */

        return new \PDO(
            $config['dsn'].";dbname=".$config['database'],
            $config['username'], $config['password'],
            $config['options']
        );

    }
}