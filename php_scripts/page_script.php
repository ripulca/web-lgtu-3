<?php

    include '../pdo.php';

    $lastId = intval($_GET['lastId']);
    $lastId+=1;
    $START_ID=$lastId;
    $TAG_MARK=$START_ID;


    $sql = "SELECT photo_id, photo_path
    FROM photos 
    WHERE photo_id >= :lastId
    ORDER BY photo_id ASC 
    LIMIT 9";
    // var_dump($lastId);
    // $proc=$db_connection->prepare($sql);
    // $proc->bindValue(':lastId', $lastId, PDO::PARAM_INT);
    // $proc->execute();

    $proc = $db_connection->prepare('SELECT photo_id, photo_path
        FROM photos
        WHERE photo_id >= ?
        ORDER BY photo_id ASC
        LIMIT 9');
    $proc->bindValue(1, $lastId, PDO::PARAM_INT);
    $proc->execute();

    // $result_array = $proc->fetchAll(PDO::FETCH_ASSOC);

    // $photos=$db_connection->query($sql);
    while ($photo=$proc->fetch(PDO::FETCH_ASSOC)) {
        if ($START_ID==$TAG_MARK) {?>
            <div class="main_photos_row">
            <?php $TAG_MARK+=$PHOTOS_IN_ROW;
        }?>
        <a href="photo_page.php?photoid=<?php echo $photo['photo_id'];?>">
        <img class="photo_card" src="<?php echo $photo['photo_path'];?>" width="400" height="auto" data-id="<?php echo $photo['photo_id'];?>" />
        </a>
        <?php $START_ID+=1;
        if ($START_ID==$TAG_MARK) {?>
            </div>
        <?php }
    }
?>
