<?php
	include('lib_timezones/lib/lib_timezones.php');

	chdir(dirname(__FILE__).'/lib_timezones');
	$sha = trim(shell_exec('git rev-parse HEAD'));

	$raw_list = timezones_list();
	$list = array();
	foreach ($raw_list as $row){
		$list[$row[1]] = $row;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>timezone.help</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<link rel="stylesheet" href="/style.css">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="/lib_timezones/lib/lib_timezones.js"></script>
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
</head>
<body>

<div class="container">
	<div class="header clearfix">
		<nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="https://github.com/iamcal/lib_timezones">Source Code</a></li>
          </ul>
		</nav>
		<h3 class="text-muted">timezone.help</h3>
	</div>

	<div class="jumbotron" id="detect">

		We have detected your timezone as:
		<h1 id="guess-name"></h1>
		<div id="zone">(IANA ID: <span id="guess-zone"></span>)</div>
		The label for this timezone is <span id="label-reg"></span><br />
		<span id="dst-yes">During daylight savings, the label is <span id="label-dst"></span><br /></span>
		<span id="dst-no">This timezone does not observe daylight savings.<br /></span>
	</div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Subheading</h4>
	<p>
		Git rev: <?php echo substr($sha, 0, 10); ?>
	</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>

		<footer class="footer">
			<p>&copy; 2013-<?php echo date('Y'); ?> Cal Henderson</p>
		</footer>

    </div>




</body>
</html>
