<!--below is the display for the sell stock form-->
<div>
    
        <form action="sell.php" method="post">
            <fieldset>
                <div class="form-group">
                    <input autocomplete="off" autofocus class="form-control" name="sale_stock" placeholder="Stock symbol to sell" type="text"/>
                </div>
                <div class="form-group">
                    <button class="btn btn-default" type="submit">
                        <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                        Submit
                    </button>
                </div>
            </fieldset>
        </form>
    <div>
        or <a href="index.php">go back to portfolio</a>
    </div>
    
<!--below is the display for portfolio -->   
    <div>
        <div id="message">
            <?php
                print("Hi ". $cash[0]["username"] .". Your balance is " . number_format($cash[0]["cash"], 2));?>
        </div>
        <div>    
            <table class="center">
                <thead>
                    <tr>
                        <th>Stock Symbol</th>
                        <th>Name</th>
                        <th>Shares</th>
                        <th>Price</th>
                        <th>Total Shares Cost</th>
                    </tr>
                </thead>
            
                <tbody>
                    <?php foreach ($positions as $position): ?>
                    <tr>    
                        <td><?= $position["symbol"]?></td>
                        <td><?= $position["name"]?></td>
                        <td><?= $position["shares"]?></td>
                        <td>$<?= number_format($position["price"], 2)?></td>
                        <td>$<?= number_format($position["total"], 2)?></td>
                    </tr>
                    <?php endforeach ?>    
                </tbody>
            </table>
        </div>
    </div>
</div>
    
