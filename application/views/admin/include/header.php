<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Audyt Jakości Danych</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
<style>
    /* Sticky footer styles
-------------------------------------------------- */
    html {
        position: relative;
        min-height: 100%;
    }
    body {
        margin-bottom: 60px; /* Margin bottom by footer height */
    }
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px; /* Set the fixed height of the footer here */
        background-color: #f5f5f5;
    }


    /* Custom page CSS
     * Not required for template or sticky footer method.
     * -------------------------------------------------- */

    .container {
        /*width: auto;*/
        /*max-width: 680px;*/
        padding: 0 15px;
    }
    .container .text-muted {
        margin: 20px 0;
        text-align: right;
    }
</style>
</head>
<body>

<div class="container">
    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Audyt Jakości Danych</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><?php echo anchor('/', 'Home'); ?></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Raporty AJD <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Dzienny</a></li>
                            <li><?php echo anchor('/cReport/getReports', 'Miesięczny'); ?></li>
<!--                            <li><a href="#">Something else here</a></li>-->
<!--                            <li role="separator" class="divider"></li>-->
<!--                            <li class="dropdown-header">Nav header</li>-->
<!--                            <li><a href="#">Separated link</a></li>-->
<!--                            <li><a href="#">One more separated link</a></li>-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Wykluczenia <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Rejestr wykluczeń</a></li>
                            <!--                            <li><a href="#">Something else here</a></li>-->
                            <!--                            <li role="separator" class="divider"></li>-->
                            <!--                            <li class="dropdown-header">Nav header</li>-->
                            <!--                            <li><a href="#">Separated link</a></li>-->
                            <!--                            <li><a href="#">One more separated link</a></li>-->
                        </ul>
                    </li>
                    <li><?php echo anchor('/admin/cImport', 'Import danych z SL'); ?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><?php echo anchor('/admin/', 'Zarządzaj raportami AJD'); ?></li>
                    <li><?php echo anchor('/admin/cReport/logout', 'Wyloguj'); ?></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>