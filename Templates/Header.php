<header class="main-container header fixed dark main-header">
	<!-- Nav Bar with Logo Area -->
	<div class="flex-grid  navbar">
		<!-- Mobile Menu -->
		<input type="checkbox" id="mobileMenu" class="hide">
		<label id="mobileMenuLabel" class="mobile-menu left-side" for="mobileMenu">
			<i class="hamburger"></i>
		</label>
		<label class="full-screen" for="mobileMenu"></label>
		<!-- /Mobile Menu -->
		<div class="col-2 col-12-md logo">
			<a href="">الموقع الرئيسى</a>
		</div>
		<nav class="col-7 col-12-md navbar-right" id="topMenuNav">
			<div class="navbar-links">
				<input type="radio" class="hide" name="navbar-menu" id="navbarDropHide" checked>
				<a href="<?php echo $_->base_url ?>" class="active">الصفحة الرئيسية</a>
				<a href="<?php echo $_->base_url ?>Feedback/Create">إضافة إستبيان جديد</a>
			</div>
		</nav>
		<!-- Second menu -->
		<!-- Second Mobile Menu -->
		<input type="checkbox" id="mobileMenu2" class="hide">
		<label id="mobileMenuLabel2" class="mobile-menu right-side" for="mobileMenu2">
			<i class="profile"></i>
		</label>
		<label class="full-screen" for="mobileMenu2"></label>
		<!-- /Second Mobile Menu -->
		<nav class="col-3 col-12-md text-right" id="topMenuNav2">
			<div class="navbar-links">

				<?php if ( isset($Session->User) ){ ?>
					<a href="<?php echo $_->base_url ?>Logout">تسجيل الخروج</a>
				<?php }else{ ?>
					<a href="<?php echo $_->base_url ?>Login">تسجيل الدخول</a>
				<?php } ?>
				
			</div>
		</nav><!-- /Second menu -->
	</div>
</header>
<div class="fixed-nav-space" id="top"></div>
