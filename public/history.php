<?php

    // configuration
    require("../includes/config.php"); 
    
    
    $history_values = CS50::query("SELECT * FROM `history` WHERE user_id = ?",$_SESSION["id"]);
    
    
    $positions = [];
    foreach($history_values as $history_value)
    {
        $positons[] = [
            "buy_or_sell" => $history_value["buy_or_sell"],
            "symbol" => $history_value["symbol"],
            "share_number" => $history_value["share_number"],
            "time" => $history_value["time"],
            "price" => $history_value["price"],
            "total_price" => $history_value["share_number"] * $history_value["price"]
            ];
    }
    
    //render history
    render("history_display.php", ["title" => "Positions", "positions" => $history_values]);
    
    
    
    
?>    
