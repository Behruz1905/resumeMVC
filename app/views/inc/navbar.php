

<?php

//    var_dump($data);
//    die();

?>
<!--Navigator-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navi">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?php echo URLROOT; ?>"><img src="<?php echo URLROOT; ?>/img/logo.png" width="200" height="60"></a>
        </div>

        <div class="collapse navbar-collapse" id="navi">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo URLROOT; ?>">Ana Səhifə</a></li>

                 <?php foreach ($data['menu'] as $menu):?>

                      <li><a href="<?php echo URLROOT; ?><?php echo $menu->link; ?>"><?php echo $menu->name_az ?></a></li>

                  <?php endforeach; ?>

            </ul>
            <ul class="nav navbar-nav navbar-right cvBtn">
                <li><a href="<?php echo URLROOT; ?>/resume" class="btn-z"><span class="glyphicon glyphicon-open"></span> CV YERLƏŞDİR</a></li>
            </ul>
        </div>
    </div>
</nav><!--end Navigator-->