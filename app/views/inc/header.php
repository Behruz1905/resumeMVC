
<?php

$site_params = array();
foreach( $data['saytParams'] as $row_params){
    $site_params[$row_params->key] = $row_params->value;
}


?>

?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap 101 Template</title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/responsive.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap-theme.min.css">
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
        <script src="<?php echo URLROOT; ?>/js/bootstrap.min.js"></script>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <style type="text/css">
            #cvcreate_form fieldset:not(:first-of-type) {
                display: none;
            }
        </style>


        <![endif]-->
    </head>
    <body>

    <div class="wrapper">

        <?php
            $month_array = array(

                "Jan" => "Yanvar",
                "Feb" => "Fevral",
                "Mar" => "Mart",
                "Apr" => "Aprel",
                "May" => "May",
                "Jun" => "İyun",
                "Jul" => "İyul",
                "Aug" => "Avqust",
                "Sep" => "Sentyabr",
                "Oct" => "Oktyabr",
                "Nov" => "Noyabr",
                "Dec" => "Dekabr",
            );
        ?>

        <?php require APPROOT . '/views/inc/navbar.php'; ?>



