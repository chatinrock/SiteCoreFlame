<style>
    tr.create, option.create{
        background-color: #a9ffa7;
    }

    tr.remove, option.remove{
        background-color: #ffa7a7;
    }

    tr.update, option.update{
        background-color: #8fc6ff;
    }

    tr.exists, option.exists{
        background-color: #d9d9d9;
    }

    #themeList td{
        padding: 3px 3px 3px 3px;
    }

</style>

<h3><?=self::get('siteName')?></h3>

<form action="?" method="POST" id="listForm">
    <input type="hidden" name="type" value="update"/>
    <table id="themeList">
        <thead>
            <tr>
                <th>Id</th>
                <th>Created?</th>
                <th>Theme</th>
                <th>Description</th>
                <th>Site</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
    <?
        $list = self::get('dirList');
        foreach($list as $item){
            $value = $item['isCreate'] ? 'exists' : '';
            echo '<tr>
                    <td>'.$item['id'].'</td>
                    <td>
                        <select class="createType" val="'.$value.'" name="createType['.$item['id'].']">
                            <option value="none">---</option>
                            <option value="exists" class="exists">exists</option>
                            <option value="create" class="create">create</option>
                            <option value="remove" class="remove">remove</option>
                            <option value="update" class="update">update</option>
                        </select>
                    </td>
                    <td>'.$item['theme'].'</td>
                    <td>'.$item['descr'].'</td>
                    <td><a href="http://'.self::get('host'). self::get('duri').$item['id'].'/" target="_blank">view</a></td>
                    <td><a href="http://'.self::get('host'). self::get('duri').$item['id'].'/edit/">edit</a></td>
                </tr>';
        }
    ?>
        <tr><td colspan="4"><input type="submit" value="Отправить"/></td></tr>
        </tbody>
    </table>
</form>

<script>
    (function(){

        function createTypeChange(pEvent){
            changeTypeTr(pEvent.target);
            // func. createTypeChange
        }

        function changeTypeTr(obj){
            jQuery(obj).parents('tr:first').removeClass('create remove update exists').addClass(obj.value);
            // func. changeTypeTr
        }

        function init(){
            jQuery('.createType').change(createTypeChange).each(function(num, obj){
                var value = jQuery(obj).attr('val');
                jQuery(obj).find('option[value="'+value+'"]').attr("selected", "selected");
                changeTypeTr(obj);
            });

            jQuery('#listForm').submit(function(){
                jQuery(this).attr('action', '?'+Math.random());
            })
            // func. init
        }

        return{
            init: init
        }
    })().init();
</script>