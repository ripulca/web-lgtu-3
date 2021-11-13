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
    } catch (PDOException $e) {
        echo "Ошибка подключения к БД: " . $e->getMessage();
        die();
    }

    $lastId = intval($_GET['lastId']);
    $lastId+=1;
    $START_ID=$lastId;
    $TAG_MARK=$START_ID;
    $sql = "SELECT photo_id, photo_path FROM photos WHERE photo_id >= ".$lastId." ORDER BY photo_id ASC LIMIT 9";
    $proc=$db_connection->prepare($sql);
    // $proc->bindValue(':lastId', $lastId, PDO::PARAM_INT);
    // $proc->bindParam(':lastId', $lastId);
    $proc->execute();
    // $db_connection->query($sql);
    // $photos=$proc->fetch(PDO::FETCH_LAZY);
    $photos=$db_connection->query($sql);
    while ($photo=$photos->fetch(PDO::FETCH_ASSOC)) {
        if ($START_ID==$TAG_MARK) {
            echo '<div class="main_photos_row">';
            $TAG_MARK+=$PHOTOS_IN_ROW;
        }
        echo '<a href="photo_page.php?photoid='.$photo['photo_id'].'">';
        echo '<img class="photo_card" src="'.$photo['photo_path'].'" width="400" height="auto" data-id="'.$photo['photo_id'].'" />';
        echo '</a>';
        $START_ID+=1;
        if ($START_ID==$TAG_MARK) {
            echo '</div>';
        }
    }
