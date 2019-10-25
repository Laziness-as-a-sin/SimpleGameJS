<?php
session_start();
if ($_SESSION['user']) {
    
} else {
    header("location: index.php");
}
$user = $_SESSION['user'];
?>

<html>
<head>
	<title>World War</title>
	<link rel="stylesheet" type="text/css" href="styleGame.css">
	<meta charset="utf-8">
</head>
<body>
    <layer class = "stext"><?php echo $user ?></layer>
    <canvas id="Canvas" width="1280" height="640"></canvas>
    <script src="game.js"></script>
</body>
</html>