<?php
    require 'pdo.php';
    require 'html\header.html';
?>
        <main class="main">
            <div class="main_info">
                <div class="main_img_container">
                    <div class="main_info_container neomorf_flat"></div>
                </div>
                <div class="main_info_text">
                    <div>Find your ideal photo</div>
                    <div>We provide free high quality photos from all over the world</div>
                </div>
            </div>
            <div class="main_photos_container">
                <?php
                $sql = "SELECT photo_id, photo_path FROM photos ORDER BY photo_id ASC LIMIT 9";
                $proc=$db_connection->prepare($sql);
                // $proc->bindParam(':id', $START_ID);
                $proc->execute();
                // $db_connection->query($sql);
                // $photos=$proc->fetch(PDO::FETCH_LAZY);
                foreach ($db_connection->query($sql) as $photo) {
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
                ?>
            </div>
            <button class="add_content_btn">
                Показать еще
            </button>
        </main>
        <footer class='footer'>
            <p>Здесь могли быть мои контакты</p>
        </footer>
<?php
    require 'html\modal_win.html';
?>
