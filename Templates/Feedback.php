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
        .Statics {
            color: red;
            font-family: helvetica;
            text-decoration: none;
            text-transform: uppercase;
            display: block;
        }

        .Statics:hover {
            text-decoration: underline;
        }

        .Statics:active {
            color: black;
        }
    </style>
</head>

<body class="agileits_w3layouts">

    <?php $Include('Header'); ?>

    <h1 class="agile_head text-center"></h1>

    <div class="w3layouts_main wrap">

        <?php if ( $_->isAuthor ){ ?>
        
            <a class="Statics" href="<?php echo $_->base_url ?>Feedback/Statics?ID=<?php echo $_->ID ?>">عرض إحصائيات الإستبيان</a>

            <a class="Statics" id="Delete" href="#">مسح الإستبيان</a>

            <br /><br /><br />
        
        <?php } ?>

        <?php if ( !$_->Expired || $_->isAuthor ){ ?>

            <form class="agile_form" id="Form" method="POST">
                
                <h2><?php echo $_->Question ?></h2>
                
                <?php if ( !$_->Expired ){ ?>

                    <ul class="agile_info_select" id="Answers">
                        <?php foreach( $_->Answers as $Value ){ ?>
                            <li>
                                <input type="radio" name="QuestionAnswers" value="<?php echo $Value ?>" id="<?php echo $Value ?>" required> 
                                <label for="<?php echo $Value ?>"><?php echo $Value ?></label>
                                <div class="check w3"></div>
                            </li>
                        <?php } ?>
                    </ul>

                    <br /><br />

                    <center><input type="submit" id="Submit" name="Submit" value="Submit" class="agileinfo" style="width:92%;"/></center>
                
                <?php }else{ ?>
                    <h2>The Feedback is Ended</h2><br /><br /><br />
                <?php } ?>

            </form>
        
        <?php } ?>

	</div>

    <?php $Include('Footer'); ?>


    <script>

        document.addEventListener("load", () => {
            setTimeout(() => {
                window.scrollTo(0,1);
            }, 0);
        }, false);


        document.addEventListener('DOMContentLoaded', () => {
            
            document.getElementById('Delete').onclick = (event) => {

                event.preventDefault();

                if ( confirm('Are You Sure You Want To Delete This Feedback ?') ){
                    
                    document.getElementById('Form').setAttribute('method', 'DELETE');
                    document.getElementById('Form').submit();
                }

            };

        }, false);

    </script>
</body>
</html>
