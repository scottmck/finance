<div id="tableid">

    <table class="center"; border="2">
        <thead>
            <th>Buy/Sell</th>
            <th>Symbol</th>
            <th>Share Number</th>
            <th>Time</th>
            <th>Price</th>
        </thead>
        
        <tbody>
        <?php foreach ($positions as $position): ?>
            <tr>    
                <td><?= $position["buy_or_sell"]?></td>
                <td><?= $position["symbol"]?></td>
                <td><?= $position["share_number"]?></td>
                <td><?= $position["time"]?></td>
                <td><?= $position["price"]?></td>
            </tr>
            <?php endforeach ?>    
        </tbody>
    </table>
</div>
