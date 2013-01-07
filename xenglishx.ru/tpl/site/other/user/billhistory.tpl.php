<?$list=self::get('list');
    $iCount = count($list);?>
<h3>История операций</h3>
<p>Последние 20 операций</p>
    <div class="lightTable">
<table>
    <thead>
        <th>Дата</th>
        <th>Сумма</th>
        <th>Операция</th>
    </thead>
    <tbody>
    <?for( $i = 0; $i < $iCount; $i++){?>
    <tr>
        <td><?=$list[$i]['date']?></td>
        <td><?=$list[$i]['sum']?></td>
        <td><?=$list[$i]['type']?></td>
    </tr>
<?}?>
    </tbody>
</table>
</div>