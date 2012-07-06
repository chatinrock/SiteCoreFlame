<div id="respond">
    <form class="short" action="#formContact" id="formContact">
        <input type="hidden" name="$form[action]" value="<?=self::get('action')?>"/>

        <div class="author required">
            <input type="text" name="$form[author]" placeholder="Name *" value="" size="22" aria-required='true' />
        </div>
        <div class="author required">
            <input type="text" name="$form[email]" placeholder="Email *" value="" size="22" aria-required='true' />
        </div>


        <div class="content">
            <textarea name="$form[message]" cols="58" rows="10" tabindex="4"></textarea>
        </div>

        <div class="actions">
            <input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
        </div>

    </form>
</div>
<script>
    var cFormList = cFormList || {};
    cFormList['formContact'] = {
        submitClick:function(){
            console.log('Данные ушли')
        },
        submitSuccess:function(){
            console.log('Данные Пришли')
        }
    };
</script>