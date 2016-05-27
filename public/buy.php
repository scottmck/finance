<?php

    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy_form.php", ["title" => "Buy"]);
    }
    //else if user reached this page after submitting form (via $_POST)
    elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["buy_stock"]))
        {
            apologize("Sorry you need to enter a stock to buy");
        }
        elseif(empty($_POST["buy_amount"]))
        {
            apologize("You must provide an amount of stock to buy");
        }
        
        $rows = CS50::query("SELECT symbol FROM `portfolio` WHERE user_id = ?", $_SESSION["id"]);
        
        $stock_buy = lookup($_POST["buy_stock"]);
        $user_cash = CS50::query("SELECT cash FROM `users` WHERE id = ?", $_SESSION["id"]);
        
        if($user_cash[0]["cash"] < ($stock_buy["price"] * $_POST["buy_amount"]))
        {
            apologize("Sorry you do not have enough money");
        }
        elseif($user_cash[0]["cash"] >= ($stock_buy["price"] * $_POST["buy_amount"]))
        {
            CS50::query("INSERT INTO `portfolio` (user_id, symbol, shares) VALUES ( ?, ?, ?) 
            ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["buy_stock"], $_POST["buy_amount"]);
                
            CS50::query("UPDATE `users` SET cash = cash - ? WHERE id = ?",($stock_buy["price"] * $_POST["buy_amount"]) ,$_SESSION["id"]);
                
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
        }
    }
    
    
?>
