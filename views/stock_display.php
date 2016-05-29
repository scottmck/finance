<div id="tableid">
        
    <table class="center"; border="2">
        <tr>
            <td>Stock Symbol</td>
            <td>Stock Name</td>
            <td>Stock Price</td>
        </tr>
        <tr>
            <td><?=($stock["symbol"])?></td>
            <td><?=($stock["name"])?></td>
            <td>$<?=number_format($stock["price"], 2)?></td>
        </tr>
        
    </table>
</div>   
