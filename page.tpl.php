
<header id="header">
	<nav class="navbar navbar-corner navbar-white">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle navbar-hamburger-slider" data-toggle="collapse" data-target="#main-menu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				
				<?php if ($logo): ?>
					<a class="navbar-brand logo" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
						<img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
					</a>
				<?php endif; ?>
				
				<?php if ($site_slogan): ?>
					<div id="site-slogan" class="visible-lg"><?php print $site_slogan; ?></div>
				<?php endif; ?>
			</div>
			<div class="collapse navbar-collapse" id="main-menu">
				<?php print render($page['menu']); ?>
			</div>
		</div>
	</nav>
	
	<?php print render($page['header']); ?>
</header>



<?php print render($page['mainslider']); ?>

<?php print render($page['help']); ?>

<?php print $messages; ?>


<?php print render($page['content']); ?>

<footer id="footer">
    <div class="container">
        <div class="row">
			<div class="col-sm-12">
				<?php print render($page['footer']); ?>
			</div>
        </div>
    </div>
</footer>

