<link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.css" />
<!--[if IE 6]>
  <link rel="stylesheet" type="text/css" href="http://theme.codecampus.ru/plugin/lightbox/themes/default/jquery.lightbox.ie6.css" />
<![endif]-->
<script type="text/javascript" src="http://theme.codecampus.ru/plugin/lightbox//jquery.lightbox.min.js"></script>

<div class="sidebar-item" id="authBox">
    <h5>Личный кабинет</h5>
    <div>
        <a href="/pubform/authUser.html?lightbox[width]=400&lightbox[height]=300" class="button blue lightbox" title="Нажмите, что бы авторизоваться">Вход</a>
        /
        <a href="/pubform/regUser.html?lightbox[width]=300&lightbox[height]=250" class="button blue lightbox" title="Нажмите, что бы зарегистрироваться">Регистрация</a>
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