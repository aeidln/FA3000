<!DOCTYPE html>
<html lang="ru">

<head>
	<title>ФИТНЕС-АРЕНА 3000</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Клубные карты">
	<link rel="stylesheet" href="3000_стили.css" type="text/css">
	<link rel="shortcut icon" href="Resources/icon.ico" type="image/png">
</head>

<body  id='cont'>
	<?php require_once ('header.php'); ?>
	<div class="container" >
		<div class="block" >
  <div class="a11">1</div>
  <div class="a11" >2</div>
  <div class="a11" >3</div>

			
		</div>
	</div>
	</div>
	<?php require_once ('footer.php'); ?>
</body>

</html>
<script>
	document.querySelector('#cont').addEventListener('scrollend', () => console.log('snap ended'))
</script>
<style>
	#cont {
		height: 100vh;

  overflow-x: auto;
  scroll-snap-type: y mandatory;

}

#cont .a11{
	height: 100vh;
	height: 100%;
  scroll-snap-align: start;
display:flex;
justify-content:center;
align-items:center;
border:solid red 2px;
box-sizing:border-box;
}
	</style>
