<?php

$pageTitle = 'Index of '.$_SERVER['REQUEST_URI'];

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pageTitle ?></title>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- css -->
    <style>
body {
    min-height: 100vh;
    background-color: #dee7eb;
}

body {
    font-family: Arial, Verdana, Tahoma, Arial, Helvetica, sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.429;
    color: rgba(0,0,0,.87);
}

html, body, input, textarea, button {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
}

hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    height: 1px;
    background-color: rgba(0,0,0,.12);
}

hr {
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
    overflow: visible;
}

img {
    border: none;
}

a {
    color: #2196F3;
    text-decoration: none;
}

a i {
    vertical-align: middle !important;
}

.container {
    margin: 0 auto;
    max-width: 1280px;
    width: calc(100% - 20px);
}

@media only screen and (min-width: 601px) {
    .container {
        width: 95%;
    }
}

@media only screen and (min-width: 993px) {
    .container {
        width: 85%;
    }
}

.flex-grow {
    display: inline-block;
    flex-grow: 1;
}

.title {
    word-wrap: break-word;
}

.icon-sm {
    vertical-align: middle !important;
    font-size: 1rem;
    opacity: .97;
}

.file-browser a {
    display: flex;
    align-items: center;
    box-sizing: border-box;
    padding: 5px 5px 5px 5px;
    margin: 0 2px 2px 2px;
    background-color: rgba(255,255,255,0.65);
    border-radius: 2px;
}

.file-browser a:hover {
    background-color: rgba(255,255,255,.9);
}

.file-browser a:focus {
    background-color: rgba(255,255,255,1);
}

.file-browser a > span {
    flex-wrap: wrap;
    word-break: break-word;
}

@media screen and (max-width: 1000px) {
    .file-browser a {
        padding: 7px 5px 7px 5px;
    }
}

@media screen and (max-width: 768px) {
    .file-browser a {
        padding: 7px 5px 7px 5px;
    }
}

@media screen and (max-width: 562px) {
    .file-browser a {
        padding:8px 5px 8px 5px;
        margin: 0 10px 3px 0px;
    }
}

.icon-sm.file {
    color: rgba(49, 99, 182, .9);
}

.icon-sm.folder {
    color: rgba(255, 204, 102, .8);
}

.file-browser a:hover {
    text-decoration: none;
}
    </style>
  </head>
  <body>
<div class="container">
    <h1 class="title"><?= $pageTitle ?></h1>
        <a href="../"><i class="material-icons icon-sm">&#xe5d8;</i> Parent Directory</a>
        <div class="file-browser">
    <hr />
    <?php
        function formatSizeUnits($bytes)
        {
            if ($bytes >= 1073741824)
            {
                $bytes = number_format($bytes / 1073741824, 2) . ' GB';
            }
            elseif ($bytes >= 1048576)
            {
                $bytes = number_format($bytes / 1048576, 2) . ' MB';
            }
            elseif ($bytes >= 1024)
            {
                $bytes = number_format($bytes / 1024, 2) . ' KB';
            }
            elseif ($bytes > 1)
            {
                $bytes = $bytes . ' bytes';
            }
            elseif ($bytes == 1)
            {
                $bytes = $bytes . ' byte';
            }
            else
            {
                $bytes = '0 bytes';
            }

            return $bytes;
    }
    function numfilesindir ($thedir){
        if (is_dir ($thedir)){
        $scanarray = scandir ($thedir);
        for ($i = 0; $i < count ($scanarray); $i++){
            if ($scanarray[$i] != "." && $scanarray[$i] != ".." && $scanarray[$i] != basename(__FILE__) && $scanarray[$i] != "explorer.inc.php" && substr( $scanarray[$i], 0, 3 ) != ".ht"){ // <- hide files
                if(is_dir($scanarray[$i])){
                    echo '<a href="' . $scanarray[$i] . '/"><i class="material-icons icon-sm folder">&#xe2c7;</i>&nbsp;<span>' .  $scanarray[$i] . '</span>/</a>';
                }else{
                    echo '<a href="' . $scanarray[$i] . '"><i class="material-icons icon-sm file">&#xe24d;</i>&nbsp;<span>' .  $scanarray[$i] . '</span> <span class="flex-grow"></span>&nbsp;<span>'. formatSizeUnits(filesize($scanarray[$i])) .'</span></a>';
                }

            }
        }
        } else {
            header('HTTP/1.0 404 Not Found');
        }
    }
    numfilesindir (".");

    ?>
        <hr />
            </div>
        <address>Server at <?php echo $_SERVER['HTTP_HOST']; ?></address>
        <br />
    </div>
  </body>
</html>
