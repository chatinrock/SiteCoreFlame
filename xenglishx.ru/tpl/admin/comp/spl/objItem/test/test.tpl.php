<script src="res/plugin/classes/utils.js" type="text/javascript" xmlns="http://www.w3.org/1999/html"></script>

<script type="text/javascript" src="/res/plugin/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="/res/plugin/fancybox/source/jquery.fancybox.css" media="screen" />


<link   href="res/plugin/dhtmlxTree/codebase/dhtmlxtree.css" rel="stylesheet" type="text/css"/>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxcommon.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/dhtmlxtree.js"></script>
<script src="res/plugin/dhtmlxTree/codebase/ext/dhtmlxtree_json.js"></script>

<link rel="stylesheet" href="http://theme.codecampus.ru/plugin/jqui/custom/css/smoothness/jquery-ui-1.8.22.custom.css">
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/jqui/custom/js/jquery-ui-1.8.22.custom.min.js"></script>

<script src="res/plugin/classes/utils.js" type="text/javascript"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>

<style>
    div .dt{font-weight: bold}
    div .dd{ padding-left: 25px}

    #cloakingBox{width: 800px}

    .shortText{
        width: 400px;
        height: 200px;
    }
</style>

<style>
    #ruleBtnPanel{
        width: 200px;
        height: 40px;
        border: 1px solid black;
        position: fixed ;
        bottom: 0px;
        background-color: blue;
        left: 20%;
        z-index: 1150;
    }
    .hidden{display: none}

    .childLeft>div{
        float: left;
    }

    .clear{
        float: none;
    }

    #rulesArtBox{
        width: 300px;
        /*height: 300px;*/
        background-color: #d5d6d6;
        padding: 5px 5px 5px 5px;
        margin-right: 10px;
    }

    .ruleArtSelect{
        background-color: #bfecfd;
    }

        /*#rulesArtBox>div{
            margin-top: 5px;
            line-height: 16px;
            height: 18px;

        }*/

    #artRuleTreeBox{
        width: 200px;
        height: 300px;
    }

    .panel{
        margin-bottom: 10px;
    }

</style>

<style>
    span.word:hover {
        cursor: pointer;
    }

    span.word:hover {
        color: red;
    }

    span.word.selected{
        font-weight: bold;
        color: red;
    }

    span.word.ruleOsn{
        color: green;
        font-weight: bold;
    }

    span.word.ruleSecond{
        color: gray;
        font-weight: bold;
    }

    span.sentence{
        display:inline-block;
        padding-right:17px
    }

    span.sentence:hover{
        background: url('/res/img/objItem/eng/edit_16.png?v=1') no-repeat right center;
        cursor: pointer;
    }

    span.sentence.select{
        background-color: #dcdcdc;
    }

    span.sentence:hover{
        text-decoration: underline;
        /*background-position: right center;
          background-image: url(/res/images/info.png);
          background-repeat: no-repeat;
          padding-right: 18px;
          margin-right: 18px;*/
    }
</style>
<div class="column">
    <div class="panel corners">

        <div class="title corners_top">
            <div class="title_element">
                <span id="history"><?=self::get('caption')?></span>
            </div>
        </div>
        <div class="panel"><?=self::get('saveData')?></div>

        <div class="boxmenu corners">
            <ul class="menu-items">
                <li>
                    <a href="#back1" id="backBtn" title="Назад">
                        <img src="<?= self::res('images/back_32.png') ?>" alt="Назад" /><span>Назад</span>
                    </a>
                </li>
                <li>
                    <a href="#saveBtn" id="saveBtn" title="Сохранить">
                        <img src="<?= self::res('images/save_32.png') ?>" alt="Сохранить" /><span>Сохранить.</span>
                    </a>
                </li>
            </ul>
        </div>


        <div class="content">




        </div>
    </div>
</div>


<script type="text/javascript">
    var testData = {
        contid: <?= self::get('contId') ?>,
        objItemId: <?= self::get('objItemId') ?>
    };

    var testMvc = (function(){

    })();

    testMvc.init();
</script>