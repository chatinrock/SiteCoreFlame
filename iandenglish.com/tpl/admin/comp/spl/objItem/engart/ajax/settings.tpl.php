<style>
    #openTree{
        height: 200px;
        width: 200px;
        vertical-align: top;
        ba
    }
    #closeTree{
        height: 200px;
        width: 200px;
        vertical-align: top;
    }

</style>

<table>
    <thead>
        <tr>
            <th>Открытый доступ</th>
            <th>Закрытый доступ</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="openTree">

            </td>
            <td id="closeTree">

            </td>
        </tr>
    </tbody>
</table>
<script>

    var settingsData = {
        num : '<?=self::get('num')?>',
        contTreeJson : <?=self::get('contTreeJson')?>
    }

    if ( typeof(settingsMvc) == 'undefined' ){
        settingsMvc = {};
    }

    settingsMvc[settingsData.num] = (function(){
        var openTree;
        var closeTree;

        function initTree(){
            // Создаём наши деревья
            dhtmlxInit.init({
                'openTree':{
                    tree:{ json: settingsData.contTreeJson, id:'openTree' },
                    checkbox:true
                } ,
                'closeTree':{
                    tree:{ json: settingsData.contTreeJson, id:'closeTree'},
                    checkbox:true
                }});

            openTree = dhtmlxInit.tree['openTree'];
            openTree.enableThreeStateCheckboxes(0);
            closeTree = dhtmlxInit.tree['closeTree'];
            closeTree.enableThreeStateCheckboxes(0);
            // func. initTree
        }

        function getSaveData(){
            var data = {
                open: openTree.getAllCheckedBranches(),
                close: closeTree.getAllCheckedBranches()
            }
            return JSON.stringify(data);
            // func. getSaveData
        }

        function initSaveData(pData){
            //
            var data = JSON.parse(pData);
            var openData = data.open.substr(0, data.open.length-1).split(',');
            for( var i in openData ){
                openTree.setCheck(openData[i], 1);
            }
            var closeData = data.close.substr(0, data.close.length-1).split(',');
            for( var i in closeData ){
                closeTree.setCheck(closeData[i], 1);
            }
            // func. initSaveData
        }

        function init(){
            initTree();
        }
        init();
        return{
            getSaveData: getSaveData,
            initSaveData: initSaveData
        }
    })();
</script>