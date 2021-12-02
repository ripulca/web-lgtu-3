<?php
    require 'pdo.php';
    require 'html/header.html';
    $sql = "SELECT photo_id, photo_path FROM photos ORDER BY photo_id ASC LIMIT 9";
    $proc=$db_connection->prepare($sql);
    $proc->execute();
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
                <?php foreach($db_connection->query($sql) as $photo):
                    if ($START_ID==$TAG_MARK) {?>
                        <div class="main_photos_row">
                        <?php $TAG_MARK+=$PHOTOS_IN_ROW;
                    }?>
                    <a href="photo_page.php?photoid=<?php echo $photo['photo_id'];?>">
                    <img class="photo_card" src="<?php echo $photo['photo_path'];?>" width="400" height="auto" data-id="<?php echo $photo['photo_id'];?>" />
                    </a>
                    <?php $START_ID+=1;
                    if ($START_ID==$TAG_MARK) {
                        echo '</div>';
                    }
                    endforeach?>
            </div>
            <div class="main_btn_container">
                <button class="add_content_btn">
                    Показать еще
                </button>
            </div>
        </main>
<?php
    require 'html/footer.html';
    require 'html/modal_win.html';
?>
