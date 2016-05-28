<div>
    <div id="message">
        <?php
            print("Welcome back ". $cash[0]["username"] .". Your balance is " . number_format($cash[0]["cash"], 2));?>
    </div>
    <table class="center"; border="2">
    <thead>
        <th>Buy/Sell</th>
        <th>Symbol</th>
        <th>Time</th>
        <th>Amount</th>
        <th>Price</th>
        <th>Total Price</th>
    </thead>
    
    <tbody>
    <?php foreach ($positions as $position): ?>
        <tr>    
            <td><?= $position["buy/sell"]?></td>
            <td><?= $position["symbol"]?></td>
            <td><?= $position["time"]?></td>
            <td><?= $position["amount"]?></td>
            <td><?= $position["price"]?></td>
            <td><?= $position["total_price"]?></td>
        </tr>
    <?php endforeach ?>    
    </tbody>
</table>
</div>
