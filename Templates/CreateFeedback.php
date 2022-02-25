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

    <script src="<?php echo $Public('JavaScript/Jquery.min.js') ?>"></script>
    <style>
        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            text-align: center;
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="agileits_w3layouts">

    <?php $Include('Header'); ?>

    <h1 class="agile_head text-center"><?php echo $_->Title ?></h1>
    <div class="w3layouts_main wrap">
	    <form class="agile_form" id="Form">
            
            <textarea placeholder="Put Your Question Here" id="Question" class="w3l_summary" name="Question" required></textarea>
            
            <h2>Your Answers</h2>
            
            <ul class="agile_info_select" id="Answers"></ul>

            <input type="text" placeholder="Put Answer Here" id="Answer"/>
            <br /><br /><br /><br />

            <label for="expireDate" style="color: #1ec8e9;">Expire At</label>
            <input type="date" id="expireDate" name="expireDate">

            <center><input type="submit" id="Submit" name="Submit" value="Create" class="agileinfo" style="width:92%;"/></center>

	  </form>

	</div>

	<?php $Include('Footer'); ?>


    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <p id="ModelText">Please Wait While Sending Data</p>
        </div>

    </div>

    <script>
        Counter = 0;
        Answers = [];
        document.addEventListener("load", () => {
            setTimeout(() => {
                window.scrollTo(0,1);
            }, 0);
        }, false);

        document.addEventListener('DOMContentLoaded', () => {

            document.getElementById('Answer').onkeydown = (event) => {

                el = document.getElementById('Answer');

                if (event.keyCode == 13){
                    
                    event.preventDefault();
                    if ( el.value.length < 1 ){
                        return ;
                    }

                    _String = `
                            <li>
                                <input type="radio" value="${el.value}" id="_${Counter}" required> 
                                <label for="_${Counter}">${el.value}</label>
                                <div class="check w3"></div>
                            </li>
                    `;
                    document.getElementById('Answers').insertAdjacentHTML('beforeend', _String);
                    Answers.push(el.value);
                    el.value = '';
                }
            }
            
            document.getElementById('Form').onsubmit = (event) => {
                event.preventDefault();

                if (document.getElementById('Question').value.length < 1){
                    alert('Must Put Question');
                }

                else if (Answers.length < 0){
                    alert('Must Put Answers');
                }

                else{

                    document.getElementById('myModal').style.display = 'block';
    
                    $.ajax({
                        url: "<?php echo $_->base_url ?>Feedback/Create",
                        type: "POST",
                        data: {
                            'Question': document.getElementById('Question').value,
                            'Answers': Answers,
                            'expireDate': document.getElementById('expireDate').value
                        },
                        dataType: 'json',
                        success: function(result, code){
                            document.location.href = '<?php echo $_->base_url ?>Feedback?id=' + result.ID;
                        },
                        error: function (err){
                            document.getElementById('myModal').style.display = 'none';
                            alert('error occured while sending data');
                            console.log(err.responseText);
                            console.log(err);
                        }
                    });
                }

            }

        }, false);
    </script>
</body>
</html>
