<?php

/**
 * @var $content string
 */

use yii\helpers\Html;
use common\widgets\Alert;
use backend\models\Cart;
use backend\models\Inventory;

yiister\adminlte\assets\Asset::register($this);
Yii::$app->language=\backend\models\Language::getDefaultLang();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="<?= Yii::$app->language?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <script>
        $("#language").click(function(){
            alert("clicked");
        });

    </script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-purple sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>BS</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Languages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag"></i>
                            <?=\backend\models\Language::getDefaultLang();?>
                        </a>
                        <ul class="dropdown-menu">

                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">
                                    <?php
                                    /*$languages=\backend\models\Language::getAll();
                                    foreach ($languages as $language)
                                    {
                                        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><li style="padding: 10px" id="language">
                                                <i class="fa fa-angle-double-right"></i>
                                            '.$language->title.'
                                            </li></a>';
                                    }*/
                                    ?>
                                </ul><!-- /.menu -->
                            </li>

                        </ul>
                    </li><!-- /.Languages-menu -->
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        //echo Yii::$app->user->identity->username;

                    ?>
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-shopping-cart"></i>
                            <?php
                            $incart=Cart::find()->count();
                            ?>
                            <span class="label label-success"><?= $incart;?></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="header"><i class="fa fa-th text-aqua"></i> You have <?= $incart;?> products in cart</li>
                            <?php
                            if($incart>0){
                               echo  '<li><div class="col-sm-12 text-center" style="padding: 10px">'.Html::a(Yii::t('app', 'View'), ['sales/create'], ['class' => 'btn btn-primary']).'</div></li>';
                            }
                            ?>

                        </ul>

                    </li><!-- /.messages-menu -->
                    <?php }?>

                    <!-- Notifications Menu -->
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        //echo Yii::$app->user->identity->username;

                    ?>
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <?php
                            $less=Inventory::getMinLevelCounts();
                            ?>
                            <span class="label label-warning"><?= $less;?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?= $less;?> products with minimal level stock</li>
                            <?php
                            if($less>0){
                                echo  '<li><div class="col-sm-12 text-center" style="padding: 10px">'.Html::a(Yii::t('app', 'View'), ['inventory/minlevel'], ['class' => 'btn btn-primary']).'</div></li>';
                            }
                            ?>

                        </ul>
                    </li>
                    <?php }?>
                    <!-- User Account Menu -->
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        //echo Yii::$app->user->identity->username;

                    ?>
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="http://placehold.it/160x160" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                   //echo Yii::$app->user->identity->username;
                                }
                                ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="http://placehold.it/160x160" class="img-circle" alt="User Image">
                                <p>
                                    <?php
                                   if (!Yii::$app->user->isGuest) {

                                       echo Yii::$app->user->identity->username;
                                         $user_id=Yii::$app->user->identity->id;
                                   }

                                    ?>

                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <?php
                                    if(!Yii::$app->user->isGuest) {
                                        echo Html::beginForm(['/site/logout'], 'post');
                                        echo Html::submitButton(
                                            'Logout (' . Yii::$app->user->identity->username . ')',
                                            ['class' => 'btn btn-link logout']
                                        );
                                        echo Html::endForm();
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="http://placehold.it/45x45" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php
                        if (!Yii::$app->user->isGuest) {
                            echo Yii::$app->user->identity->username;
                        ?>
                        [<small style="color: green"><?=  \backend\models\AuthItem::getRoleName(\backend\models\AuthAssignment::getRoleByUserId($user_id));?> </small>]
                        <?php }?>
                    </p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <?php if (!Yii::$app->user->isGuest) {?>
            <?=

            \yiister\adminlte\widgets\Menu::widget(
                [
                    "items" => [
                        ["label" =>Yii::t('app','Home'), "url" =>  Yii::$app->homeUrl, "icon" => "home"],
                        [
                            "label" => Yii::t('app','Catalog'),
                            "url" => "#",
                            'visible' => yii::$app->User->can('purchasePerson')||yii::$app->User->can('admin'),
                            "icon" => "fa fa-tags fa-fw",
                            "items" => [
                                [
                                    "label" => Yii::t('app','Categories'),
                                    "url" => ["/category/index"],
                                    "icon" => "fa fa-angle-double-right",
                                   // "badge" => "123",
                                ],
                                [
                                    "label" => Yii::t('app','Products'),
                                    "url" => ["/product/index"],
                                    "icon" => "fa fa-angle-double-right",
                                   // "badge" => "123",
                                   // "badgeOptions" => [
                                       // "class" => \yiister\adminlte\components\AdminLTE::BG_BLUE,
                                    //],
                                ],
                            ],
                        ],
                        [
                            'visible' => yii::$app->User->can('salesPerson')||yii::$app->User->can('admin'),
                            "label" => Yii::t('app','Sales'),
                            "url" => "#",
                            "icon" => "fa fa-cart-arrow-down",
                            "items" => [
                                [
                                    "label" => "POS",
                                    "url" =>  ["/sales/create"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    "label" => "Receipts",
                                    "url" =>  ["/sales/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                            ],
                        ],
                        [
                            'visible' => yii::$app->User->can('PurchasePerson')||yii::$app->User->can('admin'),
                            "label" =>Yii::t('app','Purchases'),
                            "url" => "#",
                            "icon" => "fa fa-cart-plus",
                            "items" => [
                                [
                                    "label" => "Batches",
                                    "url" => ["/purchase-master/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    "label" => "Invoices",
                                    "url" => ["/purchase-invoice/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    "label" => "Entries",
                                    "url" => ["/purchase/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    "label" => "Suppliers",
                                    "url" => ["/supplier/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    "label" => "Costs",
                                    "url" => ["/purchase-cost/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                            ],
                        ],
                        ["label" =>Yii::t('app','Returns'), "url" =>  ["/product-return/index"], "icon" => "fa fa-refresh",],

                        [
                            'visible' => yii::$app->User->can('StockPerson')||yii::$app->User->can('admin'),
                            "label" =>Yii::t('app','Inventory'),
                            "url" => "#",
                            "icon" => "fa fa-cart-plus",
                            "items" => [
                                [
                                    "label" => "Current Stock",
                                    "url" => ["/inventory/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    "label" => "Price Maintenance",
                                    "url" => ["/price-maintanance/create"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    "label" => "Stock Adjustment",
                                    "url" => ["/stock-adjustment/create"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                            ],
                        ],
                        ["label" =>Yii::t('app','Reports'), "url" =>  ["/report/index"], "icon" => "fa fa-bar-chart",],

                        [
                            "label" =>Yii::t('app','Settings'),
                            "url" => "#",
                            'visible' => yii::$app->User->can('admin'),
                            "icon" => "fa fa-gears",
                            "items" => [
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => Yii::t('app','Language'),
                                    "url" => ["/language/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Payment Method",
                                    "url" =>["/payment-method/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Modules",
                                    "url" => ["/system-module/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Backup",
                                    "url" => ["/backup"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    "label" => "Users",
                                    "url" => ["/user"],
                                    "icon" => "fa fa-user",
                                ],

                                [
                                    'visible' => (Yii::$app->user->identity->username == 'admin'),
                                    'label' => Yii::t('app', 'Manager Permissions'),
                                    'url' => ['/auth-item/index'],
                                    'icon' => 'fa fa-lock',
                                ],
                                [
                                    'label' => Yii::t('app', 'Manage User Roles'),
                                    'url' => ['/role/index'],
                                    'icon' => 'fa fa-lock',
                                ],

                            ],
                        ],
                    ],
                ]
            )
            ?>
            <?php }?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php // Html::encode(isset($this->params['h1']) ? $this->params['h1'] : $this->title) ?>
            </h1>
            <?php if (isset($this->params['breadcrumbs'])): ?>
                <?=
                \yii\widgets\Breadcrumbs::widget(
                    [
                        'encodeLabels' => false,
                        'homeLink' => [
                            'label' => new \rmrevin\yii\fontawesome\component\Icon('home') .Yii::t('app','Home'),
                            "url" =>  Yii::$app->homeUrl,
                        ],
                        'links' => $this->params['breadcrumbs'],
                    ]
                )
                ?>
            <?php endif; ?>
        </section>

        <!-- Main content -->
        <section class="content">
            <div style="padding-top: 10px"><?= Alert::widget() ?></div>
            <?= $content ?>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Powered by Adotech
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; Biashara Solution <?= date("Y") ?>
    </footer>

    <!-- Control Sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    $("#purchasemaster-country").change(function(){
        var id =document.getElementById("purchasemaster-country").value;
        if(id==1){
            $( "#rates" ).hide( "slow", function() {
                //alert( "Animation complete." );
            });
        }
        else if(id==2){
            $( "#rates" ).show( "slow", function() {
            });
        }
        else if(id==0){
            $( "#rates" ).show( "slow", function() {
            });
        }


    });

</script>

<script>
    $("#reportsearch-report").change(function(){
        var id =document.getElementById("reportsearch-report").value;
        if(id==1){
            $( "#dates" ).hide( "slow", function() {
                //alert( "Animation complete." );
            });
        }
        else if(id==2){
            $( "#dates" ).hide( "slow", function() {
            });
        }
        else{
            $( "#dates" ).show( "slow", function() {
            });
        }


    });

</script>

<script>

    $("#refresh-form").click(function(){

            window.location.reload(true);
    });




    $("#pricemaintanance-product_id").change(function(){
        var id =document.getElementById("pricemaintanance-product_id").value;
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['inventory/price','id'=>'']);?>"+id,function(data) {

            //alert(data);
            document.getElementById("pricemaintanance-old_price").value = data;

        });


    });

    $("#productreturn-product_id").change(function(){
        var id =document.getElementById("productreturn-product_id").value;
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['inventory/price','id'=>'']);?>"+id,function(data) {

            //alert(data);
            document.getElementById("productreturn-price").value = data;

        });


    });

    $("#stockadjustment-product_id").change(function(){
        var id =document.getElementById("stockadjustment-product_id").value;
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['inventory/qty','id'=>'']);?>"+id,function(data) {

            //alert(data);
            document.getElementById("stockadjustment-qty").value = data;

        });


    });

</script>

