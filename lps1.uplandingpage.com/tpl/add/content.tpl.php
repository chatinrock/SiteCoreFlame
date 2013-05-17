<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <!-- Basic Page Needs
   ================================================== -->
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
   ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="http://theme.codecampus.ru/plugin/grid960/css/base/base.css">
    <link rel="stylesheet" href="http://theme.codecampus.ru/plugin/grid960/css/base/skeleton.css">
    <link rel="stylesheet" href="http://theme.codecampus.ru/plugin/grid960/css/base/layout.css">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons
     ================================================== -->
    <link rel="shortcut icon" href="/res/img/favicon.ico">
    <link rel="apple-touch-icon" href="/res/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/res/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/res/img/apple-touch-icon-114x114.png">

    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
    <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script src="http://yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>

    <script src="http://files.codecampus.ru/res/js/min/mvc-api.js" type="text/javascript"></script>

    

    <style>
        tr.create, option.create{
			background-color: #a9ffa7;
		}

		tr.remove, option.remove{
			background-color: #ffbbbb;
		}

		tr.update, option.update{
			background-color: #b2d3ff;
		}

		tr.exists, option.exists{
			background-color: #baff9c;
		}
		
		tr.turnoff, option.turnoff{
			background-color: #d8d8d8;
		}

		#themeList td{
			padding: 3px 10px 3px 10px;
		}
		
		select{
			width: 100px;
			margin: 0;
		}
		
		tr{
			border-bottom: 1px solid white;
		}
		
		tr:last-child{
			border-bottom: 0;
		}
		
		option.create, option.none{
			display: none;
		}
		
		tr.none option.create{
			display: block;
		}
		
		tr.none option.none{
			display: block;
		}
		
		option.turnon{
			display: none;
		}
		
		tr.turnoff option.turnon{
			display: block;
		}
		
		tr.turnoff option.exists{
			display: none;
		}

        tr.none option.update, tr.none option.turnoff, tr.none option.remove, tr.none option.exists{
            display: none;
        }

		div.container.top{
			margin-top: 50px;
		}
    </style>
</head>
<body>

	<div class="container top">
		<div class="sixteen columns">
			<h3><?=self::get('siteName')?></h3>

			<form action="?" method="POST" id="listForm">
				<input type="hidden" name="type" value="update"/>
				<table id="themeList">
					<thead>
						<tr>
							<th>ID</th>
							<th>Статус</th>
							<th>Тема</th>
							<th>Описание</th>
							<th>См.</th>
							<th>Ред.</th>
						</tr>
					</thead>
					<tbody>
				<?
					$list = self::get('dirList');
					foreach($list as $item){
						$value = $item['val'];// ? 'exists' : '';
						echo '<tr>
								<td>'.$item['id'].'</td>
								<td>
									<select class="createType" val="'.$value.'" name="createType['.$item['id'].']">
										<option value="none" class="none">---</option>
										<option value="exists" class="exists">Создана</option>
										<option value="create" class="create">Создать</option>
										<option value="remove" class="remove">Удалить</option>
										<option value="update" class="update">Обновить</option>
										<option value="turnoff" class="turnoff">Отключить</option>
										<option value="turnon" class="turnon">Включить</option>
									</select>
								</td>
								<td>'.$item['theme'].'</td>
								<td>'.$item['descr'].'</td>
								<td><a href="http://'.self::get('host'). self::get('duri').$item['id'].'/" target="_blank" title="смотреть">см.</a></td>
								<td><a href="http://'.self::get('host'). self::get('duri').$item['id'].'/edit/" title="редактировать">ред.</a></td>
							</tr>';
					}
				?>
					<tr><td colspan="6" class="endTr"><input type="submit" value="Применить"/></td></tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>

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

</body>
</html>