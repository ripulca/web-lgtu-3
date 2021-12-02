<?php
    header('Content-Type: application/json');
    require 'pdo.php';
    $errors=[];
    echo $_POST['login'];
    echo $_POST['password'];
    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['email']))) {
        $password = $_POST['password'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        
        if(!empty($_POST['phone'])){
            $phone = $_POST['phone'];
            if(!Preg_match("/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/", $phone)){
                array_push($errors,'Wrong phone!');
            }
        }
        if (!Preg_match("/^[А-Яа-яЁё\s\-]+$/", $login)){
            array_push($errors,'Wrong login!');
        }
        if(!Preg_match("/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/", $email)){
            array_push($errors,'Wrong email!');
        }
        if (empty($errors)) {
            $user_id=random_int(PHP_INT_MIN, PHP_INT_MAX);
            $proc=$db_connection->prepare('SELECT user_id, user_email
            FROM users
            WHERE user_id=? OR user_email=?');
            $proc->bindParam(1, $user_id, PDO::PARAM_INT);
            $proc->bindParam(2, $user_email, PDO::PARAM_STR);
            $proc->execute();
            $check=$proc->fetch(PDO::FETCH_ASSOC);
            if($check['user_email']==$email){
                array_push($errors,'Email repeating');
            }
            else{
                while(!$check['user_id']==$user_id){
                    $user_id=random_int(PHP_INT_MIN, PHP_INT_MAX);
                }
                $login = htmlspecialchars($login, ENT_HTML5);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $proc=$db_connection->prepare('INSERT INTO users
                (user_id, user_login, user_password_hash, user_email, user_phone, user_bio)
                VALUES (?,?,?,?,?,DEFAULT)');
                $proc->bindParam(1, $user_id, PDO::PARAM_INT);
                $proc->bindParam(2, $login, PDO::PARAM_STR);
                $proc->bindParam(3, $password, PDO::PARAM_STR);
                $proc->bindParam(4, $email, PDO::PARAM_STR);
                $proc->bindParam(5, $phone, PDO::PARAM_STR);
                if($proc->execute()){
                    echo json_encode(['success'=>true]);
                }
                else{
                    array_push($errors,"Failed!");
                }
            }
        }
        if (!empty($errors)) {
            echo json_encode(['errors' => $errors]);
            die();
        }
    }