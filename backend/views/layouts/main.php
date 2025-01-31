<?php
/** @var \yii\web\View $this */

/** @var string $content */
use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* Ensure the sidebar takes full height */
            #sidebar {
                min-height: 100vh;
                width: 250px; /* Default width */
                transition: width 0.3s ease, margin-left 0.3s ease; /* Smooth transition for width */
            }

            /* Adjust main content */
            #main-content {
                /*margin-left: 250px;  Default margin to accommodate sidebar */
                transition: margin-left 0.3s ease; /* Smooth transition for content shift */
            }

            /* When sidebar is collapsed */
            .collapsed #sidebar {
                width: 0; /* Smoothly collapse the sidebar */
            }

            /* Adjust main content when sidebar is collapsed */
            .collapsed #main-content {
                margin-left: 0; /* Main content shifts smoothly */
            }

            @media (max-width: 768px) {
                /* On smaller screens, main content spans full width when sidebar is hidden */
                #main-content {
                    margin-left: 0;
                }
            }
            .nav-link i {
                margin-right: 8px; /* Adjust spacing as needed */
                width: 16px !important;
            }
            /* Align the dropdown arrow to the right */
            .dropdown-arrow {
                margin-left: auto; /* Pushes the arrow to the far right */
            }

            .nav-link {
                display: flex; /* Ensure proper alignment of elements */
                align-items: center; /* Vertically center icon and text */
                color: #212529;
                padding: 5px 5px 5px 1px;
            }

            .nav-link-text{
                width: 150px;
            }

            .hint-block {
                display: block;
                margin-top: 5px;
                color: #999;
            }

            .error-summary {
                color: #a94442;
                background: #fdf7f7;
                border-left: 3px solid #eed3d7;
                padding: 10px 20px;
                margin: 0 0 15px 0;
            }

            .has-error > input, .has-error > select {
                border: 0.5px red solid;
            }

            .has-error > .help-block {
                color:red;
            }

            .has-success > input, .has-success > select {
                border: 0.5px #28a745 solid;
            }
        </style>
    </head>
    <!--<body class="d-flex flex-column h-100">-->
    <body>
        <?php $this->beginBody() ?>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar" class="bg-light border-end collapse show">
                <div class="pt-3 ps-2">
                    <h4><?= Yii::$app->name; ?></h4>
                    <ul class="nav flex-column pt-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/"><i class="fa fa-dashboard fa-fw fa-sm" role="button" ></i><span class="nav-link-text">Dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#store" role="button" aria-expanded="false" aria-controls="submenu1">
                                <i class="fa fa-archive fa-fw fa-sm"></i><span class="nav-link-text">Stores</span><i class="fa fa-caret-down dropdown-arrow"></i>
                            </a>
                            <div class="collapse" id="store">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="collapse" href="#rawMaterials" role="button" aria-expanded="false" aria-controls="submenu4">
                                            <i class="fa fa-cubes fa-fw fa-sm"></i><span class="nav-link-text">Materials</span><i class="fa fa-caret-down dropdown-arrow"></i>
                                        </a>
                                        <div class="collapse" id="rawMaterials">
                                            <ul class="nav flex-column ms-3">
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/stores/materials/brands">
                                                        <i class="fa fa-font-awesome fa-fw fa-sm"></i><span class="nav-link-text">Brands</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/stores/materials/categories">
                                                        <i class="fa fa-sitemap fa-fw fa-sm"></i><span class="nav-link-text">Categories</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/stores/materials/measurement-units">
                                                        <i class="fa fa-arrows fa-fw fa-sm"></i><span class="nav-link-text">Measurement Units</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/stores/materials/materials">
                                                        <i class="fa fa-cube fa-fw fa-sm"></i><span class="nav-link-text">Materials</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="collapse" href="#purchase" role="button" aria-expanded="false" aria-controls="submenu4">
                                            <i class="fa fa-shopping-cart fa-fw fa-sm"></i><span class="nav-link-text">Purchase</span><i class="fa fa-caret-down dropdown-arrow"></i>
                                        </a>
                                        <div class="collapse" id="purchase">
                                            <ul class="nav flex-column ms-3">
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/stores/purchase/quatation">
                                                        <i class="fa fa-question fa-fw fa-sm"></i><span class="nav-link-text">Quotation</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/stores/purchase/receive">
                                                        <i class="fa fa-download fa-fw fa-sm"></i><span class="nav-link-text">Receive</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/stores/purchase/return">
                                                        <i class="fa fa-upload fa-fw fa-sm"></i><span class="nav-link-text">Return</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/stores/suppliers">
                                            <i class="fa fa-truck fa-fw fa-sm"></i><span class="nav-link-text">Suppliers</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#factory" role="button" aria-expanded="false" aria-controls="submenu4">
                                <i class="fa fa-industry fa-fw fa-sm"></i><span class="nav-link-text">Factory</span><i class="fa fa-caret-down dropdown-arrow"></i>
                            </a>
                            <div class="collapse" id="factory">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="collapse" href="#factoryTransfers" role="button" aria-expanded="false" aria-controls="submenu5">
                                            <i class="fa fa-exchange fa-fw fa-sm"></i><span class="nav-link-text">Transfers</span><i class="fa fa-caret-down dropdown-arrow"></i>
                                        </a>
                                        <div class="collapse" id="factoryTransfers">
                                            <ul class="nav flex-column ms-3">
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/factory/transfers/request">
                                                        <i class="fa fa-question fa-fw fa-sm"></i><span class="nav-link-text">Request</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/factory/transfers/receive">
                                                        <i class="fa fa-download fa-sm"></i><span class="nav-link-text">Receive</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/factory/transfers/return">
                                                        <i class="fa fa-upload fa-fw fa-sm"></i><span class="nav-link-text">Return</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="collapse" href="#production" role="button" aria-expanded="false" aria-controls="submenu5">
                                            <i class="fa fa-cogs fa-fw fa-sm"></i><span class="nav-link-text">Production</span><i class="fa fa-caret-down dropdown-arrow"></i>
                                        </a>
                                        <div class="collapse" id="production">
                                            <ul class="nav flex-column ms-3">
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/reports/low-stocks">
                                                        <i class="fa fa-sticky-note fa-fw fa-sm"></i><span class="nav-link-text">Templates</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/reports/vendors-products">
                                                        <i class="fa fa-cogs fa-sm"></i><span class="nav-link-text">Produce</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#sellingPoint" role="button" aria-expanded="false" aria-controls="submenu1">
                                <i class="fa fa-shopping-basket fa-fw fa-sm"></i><span class="nav-link-text">Selling Point</span><i class="fa fa-caret-down dropdown-arrow"></i>
                            </a>
                            <div class="collapse" id="sellingPoint">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="collapse" href="#products" role="button" aria-expanded="false" aria-controls="submenu4">
                                            <i class="fa fa-cubes fa-fw fa-sm"></i><span class="nav-link-text">Products</span><i class="fa fa-caret-down dropdown-arrow"></i>
                                        </a>
                                        <div class="collapse" id="products">
                                            <ul class="nav flex-column ms-3">
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/selling-point/products/brands">
                                                        <i class="fa fa-font-awesome fa-fw fa-sm"></i><span class="nav-link-text">Brands</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/selling-point/products/categories">
                                                        <i class="fa fa-sitemap fa-fw fa-sm"></i><span class="nav-link-text">Categories</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/selling-point/products">
                                                        <i class="fa fa-cube fa-fw fa-sm"></i><span class="nav-link-text">Products</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="collapse" href="#sellingPointTransfers" role="button" aria-expanded="false" aria-controls="submenu4">
                                            <i class="fa fa-users fa-fw fa-sm"></i><span class="nav-link-text">Transfers</span><i class="fa fa-caret-down dropdown-arrow"></i>
                                        </a>
                                        <div class="collapse" id="sellingPointTransfers">
                                            <ul class="nav flex-column ms-3">
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/selling-point/transfer/request">
                                                        <i class="fa fa-question fa-fw fa-sm"></i><span class="nav-link-text">Request</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/selling-point/transfer/receive">
                                                        <i class="fa fa-sitemap fa-fw fa-sm"></i><span class="nav-link-text">Receive</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/selling-point/transfer/return">
                                                        <i class="fa fa-user-secret fa-fw fa-sm"></i><span class="nav-link-text">Return</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/selling-point/sales">
                                            <i class="fa fa-shopping-basket fa-fw fa-sm"></i><span class="nav-link-text">Sales</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/selling-point/customers">
                                            <i class="fa fa-users fa-fw fa-sm"></i><span class="nav-link-text">Customers</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#reports" role="button" aria-expanded="false" aria-controls="submenu5">
                                <i class="fa fa-line-chart fa-fw fa-sm"></i><span class="nav-link-text">Reports</span><i class="fa fa-caret-down dropdown-arrow"></i>
                            </a>
                            <div class="collapse" id="reports">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/reports/materials">
                                            <i class="fa fa-line-chart fa-fw fa-sm"></i><span class="nav-link-text">Materials</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/reports/purchases">
                                            <i class="fa fa-pie-chart fa-sm"></i><span class="nav-link-text">Purchases</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/reports/expenses">
                                            <i class="fa fa-area-chart fa-fw fa-sm"></i><span class="nav-link-text">Expenses</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/reports/templates">
                                            <i class="fa fa-bar-chart fa-fw fa-sm"></i><span class="nav-link-text">Templates</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/reports/products">
                                            <i class="fa fa-line-chart fa-sm"></i><span class="nav-link-text">Products</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/reports/productions">
                                            <i class="fa fa-pie-chart fa-fw fa-sm"></i><span class="nav-link-text">Productions</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/reports/sales">
                                            <i class="fa fa-area-chart fa-fw fa-sm"></i><span class="nav-link-text">Sales</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/reports/sales-commission">
                                            <i class="fa fa-bar-chart fa-fw fa-sm"></i><span class="nav-link-text">Sales Commission</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/reports/profit-and-loss">
                                            <i class="fa fa-line-chart fa-fw fa-sm"></i><span class="nav-link-text">Profit & Loss</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="submenu6">
                                <i class="fa fa-cogs fa-fw fa-sm"></i><span class="nav-link-text">Settings</span><i class="fa fa-caret-down dropdown-arrow"></i>
                            </a>
                            <div class="collapse" id="settings">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/settings/profile">
                                            <i class="fa fa-user fa-fw fa-sm"></i><span class="nav-link-text">Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/settings/password">
                                            <i class="fa fa-key fa-fw fa-sm"></i><span class="nav-link-text">Password</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/settings/rbac">
                                            <i class="fa fa-universal-access fa-fw fa-sm"></i><span class="nav-link-text">Role Base Access</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="/settings/employees">
                                            <i class="fa fa-user-secret fa-fw fa-sm"></i><span class="nav-link-text">Employees</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="collapse" href="#configuration" role="button" aria-expanded="false" aria-controls="submenu5">
                                            <i class="fa fa-cogs fa-fw fa-sm"></i><span class="nav-link-text">Configuration</span><i class="fa fa-caret-down dropdown-arrow"></i>
                                        </a>
                                        <div class="collapse" id="configuration">
                                            <ul class="nav flex-column ms-3">
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/settings/configurations/company">
                                                        <i class="fa fa-building fa-fw fa-sm"></i><span class="nav-link-text">Company</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/settings/configurations/tax">
                                                        <i class="fa fa-gavel fa-sm"></i><span class="nav-link-text">Tax</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/settings/configurations/smtp-mail">
                                                        <i class="fa fa-envelope fa-fw fa-sm"></i><span class="nav-link-text">SMTP Mail</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" aria-current="page" href="/settings/configurations">
                                                        <i class="fa fa-cogs fa-fw fa-sm"></i><span class="nav-link-text">Configuration</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <?=
                            Html::a('<i class="fa fa-lock fa-fw fa-sm"></i>Logout', ['/site/logout'], [
                                'class' => 'nav-link',
                                'data' => [
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div id="main-content" class="flex-grow-1 p-3">
                <!-- Toggle button for larger screens -->
                <button class="btn btn-outline-secondary mb-3 d-none d-md-block" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle sidebar">
                    <i class="fa fa-bars fa-fw"></i>
                </button>
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
        <footer class="footer mt-auto py-3 text-muted">
            <div class="container">
                <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
                <p class="float-end"><?= Yii::powered() ?></p>
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const sidebar = document.getElementById('sidebar');
            const wrapper = document.getElementById('wrapper');

            // Ensure the event listener only triggers for the sidebar collapse
            sidebar.addEventListener('hidden.bs.collapse', (event) => {
                if (event.target === sidebar) { // Check if the event is triggered by the sidebar
                    wrapper.classList.add('collapsed');
                }
            });

            sidebar.addEventListener('shown.bs.collapse', (event) => {
                if (event.target === sidebar) { // Check if the event is triggered by the sidebar
                    wrapper.classList.remove('collapsed');
                }
            });
        </script>
        <?php $this->endBody() ?>
    </body>

</html>
<?php
$this->endPage();
