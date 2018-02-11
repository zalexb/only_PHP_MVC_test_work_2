<?php

	require_once "config/config.php";

	require_once "core/db.php";

	$db = new Db();
	
	session_start();

// CSRF Token
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }

    require_once 'core/model.php';

    require_once 'core/view.php';

    require_once 'core/controller.php';

    require_once 'lib/lib.php';

    require_once 'lib/paginator.php';

    require_once 'core/route.php';

Route::start($db);
	