<?php

if(!isset($_SESSION)){
    session_start();
}

require_once(__DIR__."/../config/Directories.php"); //to handle folder specific path
include("..\config\DatabaseConnect.php"); //to access database connection
if(!isset($_SESSION["user_id"])){
    header("location: ".BASE_URL."login.php");
    exit;
}
$db = new DatabaseConnect(); //make a new database instance

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $productId = htmlspecialchars($_POST["id"]);
    $quantity = htmlspecialchars($_POST["quantity"]);
    $userId   = $_SESSION["user_id"];
    
     //validate user input
    
    
    if (trim($productId) == "" || empty($productId)) { 
        $_SESSION["mali"] = "Product ID field is empty";
        header("location: ".BASE_URL."views/admin/products/product.php?id=".$productId);
        exit;
    }
    
    if (trim($quantity) == "" || empty($quantity) || $quantity < 1) { 
        $_SESSION["mali"] = "quantity field is empty";
        header("location: ".BASE_URL."views/admin/products/product.php?id=".$productId);
        exit; 
    }
    
    if (trim($userId) == "" || empty($userId)) { 
        $_SESSION["mali"] = "User ID field is empty";
        header("location: ".BASE_URL."views/admin/products/product.php?id=".$productId);
        exit;
    }
    
 

    try{
    //insert record to database
    $conn = $db->connectDB();
    
    /*
    $sql ="UPDATE products SET products.product_name = :p_product_name,
                    products.product_description = :p_product_description,
                    products.category_id = :p_category_id,
                    products.base_price = :p_base_price,
                    products.stocks = :p_stocks,
                    products.unit_price = :p_unit_price,
                    products.total_price = :p_total_price,
                    products.updated_at = NOW()
                    WHERE products.id = :p_id";

    $stmt= $conn->prepare($sql);
    $data = [':p_product_name'        => $productName,
         ':p_product_description' => $description,
         ':p_category_id'         => $category,
         ':p_base_price'          => $basePrice,
         ':p_stocks'              => $numberOfStocks,
         ':p_unit_price'          => $unitPrice,
         ':p_total_price'         => $totalPrice, 
         ':p_id'                  => $productId ];

         if(!$stmt->execute($data)){
            $_SESSION["mali"] = "failed to update the reccord";
            header("location: ".BASE_URL."views/admin/products/edit.php");
            exit;

         }

         $lastId = $productId;
        */
         
     

         
         
         $_SESSION["tama"] = "added to cart successfully";
         header("location: ".BASE_URL."views/admin/products/product.php?id=".$productId);
        exit;
    

        } catch(PDOException $e){
            echo "Connection Failed" . $e->getMessage();
            $db=null;
        }

        
            

}




    