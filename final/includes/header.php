<?php include_once 'config.php'; ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$title?></title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="lib/bootstrap/dist/css/bootstrap-theme.css" type="text/css" />
    <!--My Style-->
    <link rel="stylesheet" href="css/style.css">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=UnifrakturMaguntia" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
</head>

<body>

    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo">
                        <h1><?=$logo?></h1>
                    </div>
                </div>
            </div>
            <div class="row apps">
                <div class="col-md-2">
                </div>
                <div class="col-md-4"><? echo date('l jS \of F Y h:i:s A'); ?>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
                    <a class="navbar-brand" href="index.php">Home</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="login.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid">
