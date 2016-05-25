<?php

    // configuration
    /*require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
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
            render("sell_display.php", ["title" => "Positions", "positions" => $positions, "cash" => $cash]);
        }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["sale_stock"]))
        {
            apologize("You must provide a stock symbol.");
        }
      
        
        //query database
        //$stock = $_POST["sale_stock"];
        //$id = $_SESSION["id"];
        CS50::query("DELETE shares FROM `portfolio` WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["sale_stock"]);
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
            render("sell_display.php", ["title" => "Positions", "positions" => $positions, "cash" => $cash]);
        }
        
*/    
?>