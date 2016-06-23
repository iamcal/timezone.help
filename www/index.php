<?php
	include('lib_timezones/lib_timezones.php');

	chdir(dirname(__FILE__).'/lib_timezones');
	$sha = trim(shell_exec('git rev-parse HEAD'));

	$raw_list = timezones_list();
	$list = array();
	foreach ($raw_list as $row){
		$list[$row[1]] = $row;
	}
?>
<html>
<head>
<title>timezone.help</title>
<script src="https://code.jquery.com/jquery-3.0.0.min.js" integrity="sha256-JmvOoLtYsmqlsWxa7mDSLMwa6dZ9rrIdtrrVYRnDRH0=" crossorigin="anonymous"></script>
<script src="/lib_timezones/lib_timezones.js"></script>
<script>

var zonedata = <?php echo json_encode($list); ?>;

$(function(){

	var t0 = performance.now();
	var guess = timezones_guess();
	var t1 = performance.now();

	var label = zonedata[guess][0];

	$('#guess-name').text(label);
	$('#guess-zone').text(guess);

	$('#label-reg').text(zonedata[guess][3]);
	$('#label-dst').text(zonedata[guess][4]);

	if (zonedata[guess][4]){
		$('#dst-yes').show();
		$('#dst-no').hide();
	}else{
		$('#dst-yes').hide();
		$('#dst-no').show();
	}

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
	margin-bottom: 0.5em;
}

#label-reg, #label-dst {
	font-weight: bold;
}

</style>
</head>
<body>

<div id="main">

	<h1>timezone.help</h1>

	<div id="detect">
		We have detected your timezone as:
		<div id="guess-name"></div>
		<div id="zone">(Zone ID: <span id="guess-zone"></span>)</div>
		The label for this timezone is <span id="label-reg"></span><br />
		<span id="dst-yes">During daylight savings, the label is <span id="label-dst"></span><br /></span>
		<span id="dst-no">This timezone does not observe daylight savings.<br /></span>
	</div>

	<p>
		<a href="https://github.com/iamcal/lib_timezones">Source on GitHub</a><br />
		Git rev: <?php echo $sha; ?>
	</p>

</div>

</body>
</html>
