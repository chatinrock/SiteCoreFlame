<div id="main_wrap">
	<div id="title">
		<div class="container">
			<div class="sixteen columns">
				<?=self::block('breadcrumbs')?>
			</div>
		</div><!-- container -->
	</div>
	<div id="main">
		<div class="container">
			<div class="twelve columns blog">
				<?=self::block('content')?>
				<?=self::block('pagination')?>
			</div>
			<div class="four columns sidebar">
				<?=self::block('sidebar')?>
			</div>
		</div>
	</div>
</div>