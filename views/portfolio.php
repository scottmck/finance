<div>
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
                <td><?= strtoupper($position["symbol"])?></td>
                <td><?= $position["name"]?></td>
                <td><?= $position["shares"]?></td>
                <td>$<?= number_format($position["price"], 2)?></td>
                <td>$<?= number_format($position["total"], 2)?></td>
            </tr>
            <?php endforeach ?>    
        </tbody>
    </table>
</div>

