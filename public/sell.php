<?php

    // configuration
    require("../includes/config.php"); 
    
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
      
        
        //query database and find out amount to add
        $lookup_rows = CS50::query("SELECT * FROM `portfolio` WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["sale_stock"]);
        $new_arr = [];
        
        foreach($lookup_rows as $lookup_row)
        {
            $stock_sell = lookup($lookup_row["symbol"]);
        
            if($stock_sell !== false)
            {
               $new_arr[] = [
                   "name" => $stock_sell["name"],
                   "price" => $stock_sell["price"],
                   "shares" => $lookup_row["shares"],
                   "symbol" => $lookup_row["symbol"],
                   "add_total" => $lookup_row["shares"] * $stock_sell["price"]
                    ];
                       
            }
        }
        
        //delete portfolio containing shares to be sold
        CS50::query("DELETE FROM `portfolio` WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["sale_stock"]);
        CS50::query("UPDATE `users` SET cash = cash + ? WHERE id = ?", $new_arr[0]["add_total"] ,$_SESSION["id"]);
        
        //query database to be able to output to sell_display via render
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
        
   
?>
