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
      
        //query sql for variables to use and update cash before deleting portfolio entry
        $stock_sell = lookup($_POST["sale_stock"]);
        $user_cash = CS50::query("SELECT cash FROM `users` WHERE id = ?", $_SESSION["id"]);
        $lookup_rows = CS50::query("SELECT * FROM `portfolio` WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["sale_stock"]);
        CS50::query("UPDATE `users` SET cash = cash + ? WHERE id = ?",($stock_sell["price"] * $lookup_rows[0]["shares"]), $_SESSION["id"]);

        //delete portfolio containing shares to be sold
        CS50::query("DELETE FROM `portfolio` WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["sale_stock"]);
        
        //add update to sql for inserting row into history
        CS50::query("INSERT INTO `history` (user_id, buy_or_sell, symbol, share_number, price) VALUES ( ?, ?, ?, ?, ? )", 
        $_SESSION["id"], "sell", $_POST["sale_stock"], $lookup_rows[0]["shares"], $stock_sell["price"]);
        
        //query database to be able to output to sell_display via render
        $rows = CS50::query("SELECT * FROM `portfolio` WHERE user_id = ?", $_SESSION["id"]);
        $cash = CS50::query("SELECT username, cash FROM `users` WHERE id =?", $_SESSION["id"]);
         
        //set positions array and pass to sell_display via render
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
        redirect("/");
    }
?>
