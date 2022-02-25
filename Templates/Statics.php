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

    <script src="https://code.highcharts.com/highcharts.js"></script>

</head>

<body class="agileits_w3layouts">

    <?php $Include('Header'); ?>

    <h1 class="agile_head text-center"><?php echo $_->Title ?></h1>

    <div id="container" style="width:100%; height:400px;"></div>

	<?php $Include('Footer'); ?>

    <script>
        addEventListener("load", function() {
            setTimeout(function (){
                window.scrollTo(0,1);
            }, 0);
        }, false);

        document.addEventListener('DOMContentLoaded', function () {
            const chart = Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '<?php echo $_->Feedback['Question'] ?>'
                },
                xAxis: {
                    categories: [ <?php foreach( json_decode($_->Feedback['Answers']) as $Answer ){
                        echo "'$Answer', ";
                    } ?>]
                },
                yAxis: {
                    title: {
                        text: 'Feedback Answers'
                    }
                },
                series: [{
                    name: '',
                    <?php
                        $Count = [];
                        foreach($_->FeedbackAnswers as $Answer){
                            if ( isset($Count[$Answer['Answer']]) ){
                                $Count[$Answer['Answer']] += 1;
                            }
                            else{
                                $Count[$Answer['Answer']] = 1;
                            }
                        }
                    ?>
                    data: [ <?php foreach( json_decode($_->Feedback['Answers']) as $Answer ){
                        if ( isset($Count[$Answer]) ){
                            echo $Count[$Answer].', ';
                        }
                        else{
                            echo '0, ';
                        }
                    } ?>],
                }],
            });
        });
    </script>
</body>
</html>
