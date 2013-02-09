<?$list=self::get('list');
    $iCount = count($list);?>
<h5>История операций</h5>
<p>Последние 20 операций</p>
<div>
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