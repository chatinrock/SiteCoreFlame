<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.css" />
<!--[if IE 6]>
  <link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.ie6.css" />
<![endif]-->
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/lightbox/jquery.lightbox.min.js"></script>

<div class="sidebar-item" id="authBox">
    <h5>Личный кабинет</h5>
    <div>
        <a href="/pubform/authUser.html" class="button blue lightbox" title="Нажмите, чтобы авторизоваться">Вход</a>
        /
        <a href="/pubform/regUser.html" class="button blue lightbox" title="Нажмите, чтобы зарегистрироваться">Регистрация</a>
    </div>
</div>

<script type="text/javascript">
        yepnope({
            load: ['/res/comp/spl/freeScript/js/auth.js'],
            complete:function(){
                authMvc.init();
            }
        });
</script>