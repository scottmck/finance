<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        if($_POST["username"] == ""|| $_POST["password"] == "")
        {
            apologize("Sorry you need to enter a valid username and/or password");
        }
        elseif($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Sorry your passwords do not match");
        }
        else
        {
            CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
            {
                if (query === 0)
                {
                    apologize("sorry username already exists");
                }
                else
                {
                    $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                    $id = $rows[0]["id"];
                    $_SESSION["id"] = $id;
                    redirect("/");
                    
                }
            }
        }
        
    }
         
?>