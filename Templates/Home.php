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

    <style>
        .agile_info_select a {
            font-family: helvetica;
            text-decoration: none;
            text-transform: uppercase;
            display: block;
            padding-bottom: 20px;
        }

        .agile_info_select a:hover {
            text-decoration: underline;
        }

        .agile_info_select a:active {
            color: black;
        }
    </style>
</head>

<body class="agileits_w3layouts">

    <?php $Include('Header'); ?>

    <h1 class="agile_head text-center">الإستبيانات المتاحة</h1>

    <div class="w3layouts_main wrap" dir="rtl">
        <ul class="agile_info_select" id="Question">
            <?php foreach( $_->Feedbacks as $Value ){ ?>
                <a href="<?php echo $_->base_url ?>Feedback?id=<?php echo $Value['ID'] ?>"><?php echo $Value['Question'] ?></a>
            <?php } ?>
        </ul>
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
