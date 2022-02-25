<!DOCTYPE html>
<html>

<head>
    <title><?php echo $_->Title ?></title>
    <!-- custom-theme -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Elegant Feedback Form  Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!-- //custom-theme -->
    <link href="<?php echo $Public('CSS/purecssframework.css') ?>" rel="stylesheet">
    <link href="<?php echo $Public('CSS/CreateFeedback.css') ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo $Public('CSS/Fonts.css') ?>" rel="stylesheet">

</head>

<body class="agileits_w3layouts">

    <?php $Include('Header'); ?>

    <h1 class="agile_head text-center"></h1>

    <div class="w3layouts_main wrap">

        <form class="agile_form" id="Form" method="POST">
                
            <h2>Website Installer</h2>

            <input type="text" placeholder="Website Base Url" id="BaseUrl" name="BaseUrl"/>
            <input type="text" placeholder="Website Base Url" id="BaseUrl" name="BaseUrl"/>

            <center><input type="submit" id="Submit" name="Submit" value="Continue" class="agileinfo" style="width:92%;"/></center>

        </form>

	</div>

	<?php $Include('Footer'); ?>


    <script>

        document.addEventListener("load", () => {
            setTimeout(() => {
                window.scrollTo(0,1);
            }, 0);
        }, false);

    </script>
</body>
</html>
