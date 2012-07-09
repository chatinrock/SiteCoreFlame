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
			<?=self::block('content')?>
			<div class="four columns sidebar">
				<?=self::block('sidebar')?>
			</div>
		</div>
	</div>
</div>