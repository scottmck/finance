<?php

    // configuration
    require("../includes/config.php"); 
    
     // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("password_form.php", ["title" => "Password reset"]);
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //validate
        if(empty($_POST["password"])) 
        {
            apologize("You need to fill in your current password");
        }
        elseif(empty($_POST["newpassword"]))
        {
            apologize("You need to fill in your new password");
        }
        elseif(empty($_POST["newpassword2"]))
        {
            apologize("You need to fill in your new password confirmation");
        }
        
        $pass = CS50::query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        
        if (count($pass) == 1)
        {
            $passrow = $pass[0];
            
            //verify password against hash
            if(password_verify($_POST["password"], $passrow["hash"]))
            {
                //checks password confirmation
                if($_POST["password"] == $_POST["newpassword"])
                {
                    apologize("Your new password is the same as your old password");
                }
                //check both new passwords are the same
                elseif($_POST["newpassword"] == $_POST["newpassword2"])
                {
                   CS50::query("UPDATE users SET hash = ? WHERE id = ?",password_hash($_POST["newpassword2"], PASSWORD_DEFAULT), $_SESSION["id"]);
                   redirect("/");
                }
                else
                {
                    apologize("Your new passwords do not match");
                }
            }
            else
            {
                apologize("Sorry i do not recognize your current password please try again");
            }
        }
    }
?>
