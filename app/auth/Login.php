<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/app/config/Directories.php");
$username= $_POST["username"];
$password= $_POST["password"];



include('../config/DatabaseConnect.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
  
    $db = new DatabaseConnect();
    $conn = $db->connectDB();

    try {
        
        
        $stmt = $conn->prepare('SELECT * FROM `users` WHERE username = :p_username'); 
        $stmt->bindParam(':p_username',$username);
        $stmt->execute();
        $user = $stmt->fetchAll();


        if($user){
            if(password_verify($password, $user[0]["password"])){

                $_SESSION = [];
                session_regenerate_id(true);

                header("location: /index.php");
                $_SESSION["user_id"]=$user[0]["id"];
                $_SESSION["username"]=$user[0]["username"];
                $_SESSION["fullname"]=$user[0]["fullName"];
                $_SESSION["is_admin"]=$user[0]["is_admin"];

                $_SESSION["tama"]="Registration successful";
                header("location: /index.php");
                exit;
            } else{
                header("location: /login.php");
                $_SESSION["mali"]="Insert error";
                exit;
                    // hello world
            }

            
        }else{
            
            header("location: /login.php");
            $_SESSION["wrong"]="Insert error";
            exit;
        }
        
    
        
    } catch (Exception $e){
    echo "Connection Failed: " . $e->getMessage();
        }

        
           
    }  
                
        
?>