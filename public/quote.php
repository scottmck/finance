<?php

require("../includes/config.php");

    //render("quote_form.php", ["title" => "Quote"]);
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //render form
        render("quote_form.php", ["title" => "Quote"]);
    } 
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $stock = lookup(strtoupper($_POST["symbol"]));
        
        // validate submission
        if ($stock === false)
        {
            //apologize("sorry. Please enter another stock symbol");
            render("quote_form.php", ["title" => "Quote"]);
        }
        else
        {
            render("stock_display.php", ["stock" => $stock]);
        }
    }
    else
    {
        apologize("sorry something went wrong");
        render("quote_form.php", ["title" => "Quote"]);
    }
?>
