<?php
	chdir(dirname(__FILE__).'/lib_timezones');
	$sha = trim(shell_exec('git rev-parse HEAD'));
?>
<html>
<head>
<title>timezone.help</title>
<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script src="/lib_timezones/lib_timezones.js"></script>
<script>

$(function(){

	var t0 = performance.now();
	var guess = timezones_guess();
	var t1 = performance.now();
	var label = '???';
	var list = timezones_list();
	for (var i=0; i<list.length; i++){
		if (list[i][1] == guess) label = list[i][0];
	}

	$('#guess-name').text(label);
	$('#guess-zone').text(guess);

	//$('#detect').html("<p>Guess: "+label+" ("+guess+")</p>" + 
	//	"<p>Guess took "+(Math.round(t1-t0))+"ms</p>");

	$('#detect').show();
});

</script>
<style>

#main {
	width: 600px;
	margin: 0 auto;
	text-align: center;
	font-family: Arial, sans-serif;
}

#detect {
	display: none;
	border-top: 2px solid #666;
	border-bottom: 2px solid #666;
	background-color: #eee;
	padding: 1em;
}

#guess-name {
	font-size: 130%;
	margin: 0.5em;
}

#zone {
	font-size: 80%;
}

</style>
</head>
<body>

<div id="main">

	<h1>timezone.help</h1>

	<div id="detect">
		We think your timezone is:
		<div id="guess-name"></div>
		<div id="zone">(Zone ID: <span id="guess-zone"></span>)</div>
	</div>

	<p>
		<a href="https://github.com/iamcal/lib_timezones">Source on GitHub</a><br />
		Git rev: <?php echo $sha; ?>
	</p>

</div>

</body>
</html>
