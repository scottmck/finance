<?php

    // configuration
    require("../includes/config.php"); 
    
    
    $rows = CS50::query("SELECT * FROM `portfolio` WHERE user_id = ?", $_SESSION["id"]);
    $cash = CS50::query("SELECT username, cash FROM `users` WHERE id =?", $_SESSION["id"]);
    
    
    $positions = [];
    foreach($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total" => $row["shares"] * $stock["price"]
                
            ];
        }
    }
    
   

    // render portfolio
    render("portfolio.php", ["title" => "Positions", "positions" => $positions, "cash" => $cash]);

?>
