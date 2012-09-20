<link   href="res/plugin/dhtmlxTree/codebase/dhtmlxtree.css" rel="stylesheet" type="text/css"/>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxcommon.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxtree.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/ext/dhtmlxtree_json.js"></script>

<script src="res/plugin/classes/utils.js" type="text/javascript"></script>

<script type="text/javascript" src="/res/plugin/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="/res/plugin/fancybox/source/jquery.fancybox.css" media="screen"/>

<style type="text/css">
    .bold {font-weight: bold}
    .vmiddle{vertical-align: middle; height: 40px}
    .vmiddle img{vertical-align: middle}
    .treeBlock{vertical-align:top; width:200px; height:218px;background-color:#f5f5f5;border :1px solid Silver;; overflow:auto;}
    img.img_button{cursor: pointer}

    div.caption{font-weight: bold}

    div.left > div{float: left; margin-right: 5px;}
    div.photo{
        height: 128px;
        width: 128px;
        background-color: #DDDDDD;
        cursor: pointer;
    }

    div.vspace10{
        padding-bottom: 10px;
    }

    input.fio{
        width: 300px;
    }
    textarea.descrip{
        width: 70%;
        height: 200px;;
    }

    textarea.aprice{
        width: 70%;
        height: 200px;;
    }
</style>
<!-- start panel right column -->
<div class="column" >
    <!-- start panel right panel -->
    <div class="panel corners">
        <!-- start panel right title -->
        <div class="title corners_top">
            <div class="title_element">

                <a style="margin-left: 10px" href="" title="В начало">
                    <img src="<? self::res('images/home_16x16.png') ?>" alt="В начало" width="16" height="16" title="В начало"/>
                    В начало /
                </a>
                <span id="history">{Hisotry}</span>
            </div>
        </div><!-- end title -->
        <!-- start panel right content -->
        <div class="content">


            <div class="boxmenu corners">
                <ul class="menu-items">
                    <li>
                        <a href="#back" id="backBtn" title="Назад">
                            <img src="<?= self::res('images/back_32.png') ?>" alt="Назад" /><span>Назад</span>
                        </a>
                    </li>
                    <li>
                        <a href="#save" id="saveBtn" title="Сохранить">
                            <img src="<?= self::res('images/save_32.png') ?>" alt="Сохранить" /><span>Сохранить</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="content">

                <div class="left">
                    <div class="photo"></div>
                    <div>
                        <div class="caption">ФИО</div>
                        <div class="vspace10"><?=self::text('name="fio" class="fio"', self::get('fio'))?></div>

                        <div class="left">
                            <div>
                                <div class="caption">Возраст</div>
                                <div class="vspace10"><?self::select(self::get('ageList'), 'name="age" class="age"');?></div>
                            </div>
                            <div>
                                <div class="caption">Пол</div>
                                <div class="vspace10"><?self::selectKeyName(self::get('sexList'), 'name="sex" class="sex"');?></div>
                            </div>
                            <div>
                                <div class="caption">Стаж</div>
                                <div class="vspace10"><?self::select(self::get('experienceList'), 'name="experience" class="experience"');?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br style='clear:both'/>
                <div>

                    <div class="caption">Цена за одно занятие</div>
                    <div class="vspace10"><?=self::text('name="price" class="price"', self::get('price'))?> руб</div>

                    <div class="caption">Метро</div>
                    <div class="vspace10"></div>

                    <div class="caption">Url видео</div>
                    <div class="vspace10"><?=self::text('name="videoUrl" class="videoUrl"', self::get('videoUrl'))?></div>

                    <div class="caption">Галлерея</div>
                    <div class="vspace10"></div>

                    <div class="caption">Общие цены</div>
                    <div class="vspace10"><?=self::textarea('name="aprice" class="aprice"', self::get('aprice'))?></div>

                    <div class="caption">Описание</div>
                    <div class="vspace10"><?=self::textarea('name="descrip" class="descrip"', self::get('descrip'))?></div>
                </div>

            </div><!-- end panel right content -->

        </div><!-- end panel right content -->
    </div><!-- end panel right panel -->
</div><!-- end panel right column -->


<script type="text/javascript">
    var peopleData = {
        contid: <?= self::get('contId') ?>,
        itemObjId: <?= self::get('objItemId') ?>
    } // var peopleData

    var contrName = peopleData.contid;
    var callType = 'comp';
    utils.setType(callType);
    utils.setContr(contrName);
    HAjax.setContr(contrName);


var peopleMvc = (function(){
    var options = {};


    function init(pOptions){
        options = pOptions;

        // Ссылка для кнопки Назад
        $(options.backBtn).attr('href', utils.url({}));

        // func. init
    }

    return {
        init: init
    }
})();

$(document).ready(function(){
    peopleMvc.init({
        backBtn: '#backBtn'
    });
});
</script>