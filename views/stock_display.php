<div>
        
    <table class="center">
        <thead>
            <tr>
                <th>Stock Symbol</th>
                <th>Stock Name</th>
                <th>Stock Price</th>
            </tr>
        </thead>
        <tr>
            <td><?=strtoupper($stock["symbol"])?></td>
            <td><?=($stock["name"])?></td>
            <td>$<?=number_format($stock["price"], 2)?></td>
        </tr>
        
    </table>
</div>
