<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Music Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="webpage/viewer.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">

    <h1>190M Music Playlist Viewer</h1>
    <h2>Search Through Your Playlists and Music</h2>
</div>

<?php
    function displaySize($size) {
        if ($size < 1024) {
            return "(".$size." b)";
        } else if ($size < 1048576) {
            return "(".round($size/1024,2)." kb)";
        } else {
            return "(".round($size/1048576,2)." mb)";
        }
    }

    function sizeFormat($size) {
        $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
        if ($size == 0) {
            return('n/a');
        } else {
            return "(".(round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]).")";
        }
    }
?>

<?php if(isset($_REQUEST["playlist"])) { ?>
<div class="navbar">
    <ul>
        <li class="navitem"><a href="index.php">Home</a></li>
    </ul>
</div>
<?php
}
?>

<div id="listarea">
    <ul id="musiclist">

        <?php
        if(!isset($_REQUEST["playlist"])) {
            $songs = glob("webpage/songs/*.mp3");
            foreach ($songs as $song) {
//                print $song;
            ?>
                <li class="mp3item">
                    <a href="<?= $song ?>"> <?= basename($song) ?></a> <?= sizeFormat(filesize($song))?>
                </li>
            <?php
            }
            $playlists = glob("webpage/songs/*.txt");
            foreach ($playlists as $playlist) {
                //echo $playlist."\n";
            ?>
                <li class="playlistitem">
                    <a href="<?= "index.php?playlist=".basename($playlist) ?>"> <?= basename($playlist)?></a>
                </li>
            <?php
            }
        }
        else {
            $songs = file("webpage/songs/".$_REQUEST["playlist"]);
            foreach ($songs as $song) {
//                print $song;
            ?>
                <li class="mp3item">
                    <a href="<?= "webpage/songs/".$song?>"> <?= $song ?></a>  <?= sizeFormat(filesize(trim("webpage/songs/".$song)))?>
                </li>
            <?php
            }
        }
        ?>
    </ul>

</div>
</body>
</html>
