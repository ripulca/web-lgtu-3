<?php
    require 'pdo.php';

    require 'html/header.html';
?>
        <main class="main">
            <div class='main_photo_container'>
                <?php
                    $photo_id= $_GET['photoid'];
                    $proc=$db_connection->prepare('SELECT photo_name, photo_path 
                    FROM photos 
                    WHERE photo_id= ?');
                    $proc->bindParam(1, $photo_id, PDO::PARAM_INT);
                    $proc->execute();
                    //$db_connection->query($sql);
                    $photo=$proc->fetch(PDO::FETCH_ASSOC);
                ?>
                    <img src="<?php echo $photo['photo_path'];?>" width="30%" height="auto"/>;
                
            </div>
            <div class='main_photo_info' style="font-weight:bold; font-size: 30px; text-trnsform: uppercase;">
                <div class='main_photo_info_interactive'>
                    <div>
                        <p><?php echo $photo['photo_name'];?></p>
                    </div>
                    <div class="main_photo_info_buttons">
                        <!-- <button class="post_btn"><svg width="30" height="21" viewBox="0 0"><path d="M16 4a5.95 5.95 0 00-3.89 1.7l-.12.11-.12-.11A5.96 5.96 0 007.73 4 5.73 5.73 0 002 9.72c0 3.08 1.13 4.55 6.18 8.54l2.69 2.1c.66.52 1.6.52 2.26 0l2.36-1.84.94-.74c4.53-3.64 5.57-5.1 5.57-8.06A5.73 5.73 0 0016.27 4zm.27 1.8a3.93 3.93 0 013.93 3.92v.3c-.08 2.15-1.07 3.33-5.51 6.84l-2.67 2.08a.04.04 0 01-.04 0L9.6 17.1l-.87-.7C4.6 13.1 3.8 11.98 3.8 9.73A3.93 3.93 0 017.73 5.8c1.34 0 2.51.62 3.57 1.92a.9.9 0 001.4-.01c1.04-1.3 2.2-1.91 3.57-1.91z" fill="currentColor" fill-rule="nonzero"></path></svg> Like</button> -->
                        <div class="rating rating_set">
                            <div class="rating_body">
                                <div class="rating_active"></div>
                                <div class="rating_items">
                                    <input type="radio" class="rating_item" name="rating" value="5">
                                    <input type="radio" class="rating_item" name="rating" value="4">
                                    <input type="radio" class="rating_item" name="rating" value="3">
                                    <input type="radio" class="rating_item" name="rating" value="2">
                                    <input type="radio" class="rating_item" name="rating" value="1">
                                </div>
                            </div>
                            <div class="rating_value">3</div>
                        </div>
                        <!-- <button class="post_btn"><svg width="30" height="21" viewBox="0 0"><path d="M6.83 15.75c.2-.23.53-.31.82-.2.81.3 1.7.45 2.6.45 3.77 0 6.75-2.7 6.75-6s-2.98-6-6.75-6S3.5 6.7 3.5 10c0 1.21.4 2.37 1.14 3.35.1.14.16.31.15.49-.04.76-.4 1.78-1.08 3.13 1.48-.11 2.5-.53 3.12-1.22zM3.24 18.5a1.2 1.2 0 01-1.1-1.77A10.77 10.77 0 003.26 14 7 7 0 012 10c0-4.17 3.68-7.5 8.25-7.5S18.5 5.83 18.5 10s-3.68 7.5-8.25 7.5c-.92 0-1.81-.13-2.66-.4-1 .89-2.46 1.34-4.35 1.4z" id="message_outline_20__Icon-Color" fill="currentColor" fill-rule="nonzero"></path></svg> Comment</button> -->
                    </div>
                </div>
                <p class="photo_author">TestUser</p>
            </div>
            <div class='main_comments neomorf_flat'>
                <div>
                    <p><b>testProfile</b></p>
                    <p>test comment</p>
                    <p>12.09.2045</p>
                </div>
            </div>
        </main>
        <footer class='footer'>
            <p>Здесь могли быть мои контакты</p>
        </footer>
        
<script src="js/rating_script.js"></script>
<?php
    require 'html/modal_win.html';
?>