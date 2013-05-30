<div class="box information">
    Помощь репетитора доступена только владельцу VIP аккаунта.
</div>

<h4>Основные плюсы VIP аккаунта</h4>
<ul>
    <li>Доступ к VIP комментария</li>
    <li>Доступ к эксклюзивным статьям блога</li>
    <li>Помощь репетитора</li>
</ul>
<a id="buyVipBtn" href="/res/form/payReg.html" class="button bright-green medium">Преобрести VIP аккаунт</a>
<script>
    jQuery('#buyVipBtn').click(function(){
       jQuery('#buyVipBtn').lightbox({
           width: 630,
           height: 358,
           iframe: true
       });
    });
    yepnope({
        load: ['http://theme.codecampus.ru/plugin/payment/walletone.com/payMvc.js']
    });

</script>