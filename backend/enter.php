<?php

    require 'pdo.php';

    $errors=[];
    if (isset($_POST['login']) && isset($_POST['password'])) {
        session_start();
        $password = $_POST['password'];
        $login = $_POST['login'];
        
        if (!Preg_match("/^[А-Яа-яЁё\s\-]+$/", $login)){
            array_push($errors,'Wrong login!');
        }
        else{
            $login = htmlspecialchars($login, ENT_HTML5);
            $proc=$db_connection->prepare('SELECT user_login, user_password_hash
            FROM users
            WHERE user_login=? AND user_password_hash=?');
            $proc->bindParam(1, $login_check, PDO::PARAM_STR);
            $proc->bindParam(2, $password_check, PDO::PARAM_STR);
            if(!$proc->execute()){
                array_push($errors,"Failed!");
            }
            if(password_verify($password,$password_check) && $login==$login_check){
                echo json_encode(['success' => true]);
            }
            else{
                array_push($errors, "Failed!");
            }
            if (!empty($errors)) {
                echo json_encode(['errors' => $errors]);
                die();
            }
            // if ($user) {
            //     $_SESSION['userId'] = $user['id'];
            //     //...
            //     }
        }
    }
