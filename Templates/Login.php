<!DOCTYPE html>
<html>

<head>
    <title><?php echo $_->Title ?></title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Elegant Feedback Form  Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    
    <link href="<?php echo $Public('CSS/purecssframework.css') ?>" rel="stylesheet">
    <link href="<?php echo $Public('CSS/CreateFeedback.css') ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo $Public('CSS/Fonts.css') ?>" rel="stylesheet">
</head>

<body class="agileits_w3layouts">

    <?php $Include('Header'); ?>

    <h1 class="agile_head text-center"><?php echo $_->Title ?></h1>
    <div class="w3layouts_main wrap">
	    <form method="POST" class="agile_form">
			<input type="text" placeholder="User Name" name="UserName" style="width: 92%;"/>
            <br>
			<input type="password" placeholder="Password" name="Password" style="width: 92%;"/>
            <br>
			<center><input type="submit" value="Login" class="agileinfo" style="width:40%;"/></center>
	  </form>
	</div>

	<?php $Include('Footer'); ?>

    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(function (){
                window.scrollTo(0,1);
            }, 0);
        }, false);
    </script>
</body>
</html>
