<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;

$bundle = yiister\gentelella\assets\Asset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>" >
<?php $this->beginBody(); ?>
<div class="container body">

    <div class="main_container">

        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="/" class="site_title"><i class="fa fa-paw"></i> <span>InovaMedika</span></a>
                </div>
                <div class="clearfix"></div>

                <!-- menu prile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                    <img src="https://via.placeholder.com/128" alt="User" class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2><?= !\Yii::$app->user->isGuest ? \Yii::$app->user->identity->username : 'Guest' ?></h2>
                    </div>
                </div>
                <!-- /menu prile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <div class="menu_section">
                    <h3 class=""><?= !\Yii::$app->user->isGuest ? \Yii::$app->user->identity->hak_akses : 'General' ?>
                    <?=
\yiister\gentelella\widgets\Menu::widget(
    [
        "items" => [
            ["label" => "Home", "url" => "/", "icon" => "home"],
            ["label" => "About", "url" => ["site/about"], "icon" => "info-circle"],
            ["label" => "Data Master", "icon" => "database", "url" => "#", "visible" => !\Yii::$app->user->isGuest && \Yii::$app->user->identity && (\Yii::$app->user->identity->hak_akses == 'admin' || \Yii::$app->user->identity->hak_akses == 'master'),
                "items" => [
                    ["label" => "Wilayah", "url" => ["/wilayah"], "icon" => "map-marker"],
                    ["label" => "Obat", "url" => ["/obat"], "icon" => "medkit"],
                    ["label" => "User", "url" => ["/user"], "icon" => "user"],
                    ["label" => "Tindakan", "url" => ["/tindakan"], "icon" => "stethoscope"],
                ],
            ],
            ["label" => "Transaksi", "icon" => "exchange", "url" => "#", "visible" => !\Yii::$app->user->isGuest && \Yii::$app->user->identity && (\Yii::$app->user->identity->hak_akses == 'pegawai' || \Yii::$app->user->identity->hak_akses == 'master' || \Yii::$app->user->identity->hak_akses == 'pasien'),
                "items" => [
                    ["label" => "Pasien", "url" => ["/pasien"], "icon" => "wheelchair", "visible" => !\Yii::$app->user->isGuest && \Yii::$app->user->identity && (\Yii::$app->user->identity->hak_akses == 'pasien' || \Yii::$app->user->identity->hak_akses == 'master')],
                    ["label" => "Transaksi", "url" => ["/transaksi"], "icon" => "money", "visible" => !\Yii::$app->user->isGuest && \Yii::$app->user->identity && (\Yii::$app->user->identity->hak_akses == 'pegawai' || \Yii::$app->user->identity->hak_akses == 'master')],
                    ["label" => "Pembayaran", "url" => ["/pembayaran"], "icon" => "credit-card", "visible" => !\Yii::$app->user->isGuest && \Yii::$app->user->identity && (\Yii::$app->user->identity->hak_akses == 'pegawai' || \Yii::$app->user->identity->hak_akses == 'master' || \Yii::$app->user->identity->hak_akses == 'pasien')],
                ],
            ],
        ],
    ]
)
?>



                    </div>

                </div>
                <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/128" alt="">
                            <?= !\Yii::$app->user->isGuest ? \Yii::$app->user->identity->username : 'Guest' ?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="javascript:;">  Profile</a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">Help</a>
                                </li>
                                <?php if (Yii::$app->user->isGuest): ?>
                                    <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/login']) ?>"><i class="fa fa-sign-in pull-right"></i> Log In</a></li>
                                <?php else: ?>
                                    <li>
                                        <?= Html::beginForm(['/site/logout'], 'post') ?>
                                        <?= Html::submitButton('<i class="fa fa-sign-out pull-right"></i> Log Out (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']) ?>
                                        <?= Html::endForm() ?>
                                    </li>
                                <?php endif; ?>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                      <span class="image">
                                        <img src="https://via.placeholder.com/128" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                      <span class="image">
                                        <img src="https://via.placeholder.com/128" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                      <span class="image">
                                        <img src="https://via.placeholder.com/128" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                      <span class="image">
                                        <img src="https://via.placeholder.com/128" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a href="/">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>

            <?= $content ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <!-- <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com" rel="nofollow" target="_blank">Colorlib</a><br />
                Extension for Yii framework 2 by <a href="http://yiister.ru" rel="nofollow" target="_blank">Yiister</a>
            </div>
            <div class="clearfix"></div>
        </footer> -->
        <!-- /footer content -->
    </div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
