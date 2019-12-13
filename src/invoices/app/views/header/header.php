<?php if (
    isset($title) &&
    isset($controllerName)
): ?>
<!DOCTYPE html>
<html lang="it">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BOOTSTRAP_URL ?>css/bootstrap.min.css">
    <!-- Font Awesome CSS  -->
    <link rel="stylesheet" type="text/css" href="<?= FONTAWESOME_URL ?>css/all.css">
    <!-- Flat UI CSS  -->
    <link rel="stylesheet" type="text/css" href="<?= FLATUI_URL ?>dist/css/flat-ui.css">
    <!-- JQuery Confirm CSS -->
    <link rel="stylesheet" type="text/css" href="<?= JQUERY_CONFIRM_URL ?>jquery-confirm.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL ?>main.css">
    <link rel="stylesheet" type="text/svg+xml" href="<?= FLATUI_GLYPS ?>flat-ui-pro-icons-regular.svg">

    <!-- Favicon -->
    <link rel="icon" href="<?= ROOT ?>assets/img/favicon.png" />

    <title><?= $title ?></title>
</head>

<body class="bg-cloud">
    <!-- Navigation bar -->
    <nav class="navbar navbar-inverse navbar-expand-md fixed-top-sm custom-navbar" role="navigation">
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-01"></button>
        <div class="collapse navbar-collapse" id="navbar-collapse-01">
            <ul class="nav navbar-nav mr-auto">
                <?php if(
                    $controllerName ===  'Registration' ||
                    $controllerName ===  'Home'
                ) : ?>
                    <li <?= $controllerName ===  'Home' ? 'class="active"' : '' ?>>
                        <a href="<?= URL ?>home/index">Login</a>
                    </li>
                    <li <?= $controllerName ===  'Registration' ? 'class="active"' : '' ?>>
                        <a href="<?= URL ?>registration/index">Registrazione</a>
                    </li>
                <?php else: ?>
                    <li <?= $controllerName ===  'Invoices' ? 'class="active"' : '' ?>>
                        <a href="<?= URL ?>invoices/index">Fatture</a>
                    </li>
                    <?php if(!isset($_SESSION[USER_SESSION_DATA])) : ?>
                        <li <?= $controllerName ===  'Users' ? 'class="active"' : '' ?>>
                            <a href="<?= URL ?>users/index">Utenti</a>
                        </li>
                        <li <?= $controllerName ===  'Clients' ? 'class="active"' : '' ?>>
                            <a href="<?= URL ?>clients/index">Clienti</a>
                        </li>
                        <li <?= $controllerName ===  'Products' ? 'class="active"' : '' ?>>
                            <a href="<?= URL ?>products/index">Prodotti</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
        <!-- Logout Button -->
        <form class="form-inline mr-2" method="POST" action="<?= URL ?>home/logout">
            <button class="btn btn-primary navbar-btn mr-2 text-capitalize" type="submit" name="logout">Logout</button>
        </form>
    </nav>
</body>

</html>
<?php endif; ?>