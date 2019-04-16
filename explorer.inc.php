<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Files | <?php echo $_SERVER['REQUEST_URI']; ?></title>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- css -->
    <style>
    html,
    body {
        min-height: 100vh;
        background-color: #eee;
    }
    body {
        font-family: Arial,Verdana,Tahoma;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.429;
        color: rgba(0,0,0,.87);
    }
    html,
    body,
    input,
    textarea,
    button {
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
    img{
        border: none;
    }
    a {
        color: #2196F3;
        text-decoration: none;
    }
    a i{ vertical-align: middle !important; }
    .icon-sm{
      vertical-align: middle !important;
      font-size:1rem;
      opacity:.97;
    }
    .over-sc{
        overflow-y: scroll;
    }
    .file-browser a{
      display:inline-block;
      padding:5px 5px 5px 5px;
      width:40%;
      margin:0 10px 2px 0px;
      background-color:rgba(255,255,255,0.65);
    }
    .file-browser a:hover{
      background-color:rgba(255,255,255,.9);
    }
    .file-browser a:focus{
      background-color:rgba(255,255,255,1);
    }
    @media screen and (max-width: 1000px) {
      .file-browser a{
        padding:7px 5px 7px 5px;
        width:60%;
      }
    }
    @media screen and (max-width: 768px) {
      .file-browser a{
        padding:7px 5px 7px 5px;
        width:80%;
      }
    }
    @media screen and (max-width: 562px) {
      .file-browser a{
        padding:8px 5px 8px 5px;
        margin:0 10px 3px 0px;
        width:95%;
      }
    }
    .icon-sm.file{
        color:rgb(49, 99, 182, .9);
    }
	.icon-sm.folder{
        color:rgba(255, 204, 102, .8);
    }
    .file-browser a:hover{
		text-decoration: none;
    }
    </style>
  </head>
  <body>
<h1 class="over-sc"><?php echo $_SERVER['REQUEST_URI']; ?></h1>
	  <a href="../"><i class="material-icons icon-sm">&#xe5c4;</i> Back</a>
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
        if ($scanarray[$i] != "." && $scanarray[$i] != ".." && $scanarray[$i] != "index.php" && $scanarray[$i] != "explorer.inc.php"){ // <- hide files
            if(is_dir($scanarray[$i])){
				echo '<a href="' . $scanarray[$i] . '/"><i class="material-icons icon-sm folder">&#xe2c7;</i> ' .  $scanarray[$i] . '/</a><br />';
			}else{
				echo '<a href="' . $scanarray[$i] . '"><i class="material-icons icon-sm file">&#xe24d;</i> ' .  $scanarray[$i] . ' <span style="float:right;white-space: nowrap;">'. formatSizeUnits(filesize($scanarray[$i])) .'</span></a><br />';
			}

        }
      }
    } else {
      	header('HTTP/1.0 404 Not Found');
    }
  }
  echo numfilesindir (".");

?>
<hr />
	  </div>
<address>Topgun09 at <?php echo $_SERVER['HTTP_HOST']; ?></address>
<br />

  </body>
</html>