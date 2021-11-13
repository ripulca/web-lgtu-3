<?php

    try {
        $pdoConfig = parse_ini_file('config\parameters.ini');
        $db_connection= new PDO(
            'mysql:host='.$pdoConfig['host'].';dbname='.$pdoConfig['dbname'],
            $pdoConfig['login'],
            $pdoConfig['password'],
            array( PDO::ATTR_PERSISTENT => true)
        );
        // echo $PHOTOS_IN_ROW;
        $PHOTOS_IN_ROW=3;
        $START_ID=0;
        $TAG_MARK=0;
    } catch (PDOException $e) {
        echo "Ошибка подключения к БД: " . $e->getMessage();
        die();
    }
