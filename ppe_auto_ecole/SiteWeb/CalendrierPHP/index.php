<?php

session_start();
require('configdb.php');



?>

<!DOCTYPE html>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Planning</title>
		<link rel="stylesheet" type="text/css" href="stylecalendrier.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript">
			jQuery(function($){
				$('.month').hide();
				$('.month:first').show();
				$('.months a:first').addClass('active');
				var current = 1;
				$('.months a').click(function(){
					var month = $(this).attr('id').replace('linkMonth', '');
					if(month != current){
						$('#month'+current).slideUp();
						$('#month'+month).slideDown();
						$('.months a').removeClass('active');
						$('.months a#linkMonth'+month).addClass('active');
						current = month;
					}
					return false;
				});
			});
			
		</script>
	
	</head>
	
	<body>
		<?php
			require('configdb.php');
			require ('date.php');
			$date = new Date();
			$year = 2014;
			$events = $date->getEvents($year);
			$dates = $date->getAll($year);			
		?>
		<div class="periods">
			<div class="year"><?php echo $year; ?></div>
			<div class="months">
				<ul>
					<?php foreach ($date->months as $id=>$m): ?>
						<li><a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo mb_convert_encoding(substr($m, 0, 3), 'UTF-8', 'ISO-8859-1'); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="clear"></div>
			<?php $dates = current($dates); ?>
			<?php foreach ($dates as $m=>$days): ?>
			
			<div class="month relative" id="month<?php echo $m; ?>">
				<table> <!--ligne jours + cases jours -->
					<thead><!--ligne des jours Lun, Mar, Mer, etc.. -->
						<tr>
							<?php foreach ($date->days as $d): ?>
							<th><?php echo substr($d, 0, 3); ?></th> <!-- foreach 3 premieres lettres de days: -->
							<?php endforeach ?>
						</tr>
					</thead>
					<tbody><!-- cases du calendrier = jours du mois -->
						<tr><!--ligne du calendrier -->
						<?php $end = end($days); foreach($days as $d=>$w): ?>
							<?php $time = strtotime("$year-$m-$d"); ?>
							<?php if($d == 1): ?> <!-- si on est le premier du mois : -->
								<td colspan="<?php echo $w-1; ?>" class="padding"></td><!--colspan = nombre de colonnes dans la ligne(tr) de la table-->
							<?php endif; ?>
								<td <?php if($time == strtotime(date('Y-m-d'))): ?> class="today" <?php endif; ?>>
									<div class="relative">
										<div class="day"><?php echo $d; ?></div>
									</div>
									<div class="daytitle">
										<?php echo $date->days[$w-1]; ?>
										<?php echo $d; ?>
										<?php echo mb_convert_encoding($date->months[$m-1], 'UTF-8', 'ISO-8859-1'); ?>
									</div>
									<ul class="events">									
										<?php if(isset($events[$time])): foreach($events[$time] as $e): ?>									
										<li><?php foreach($e as $q): echo $q . '</br>' ;  endforeach;?></li>
										<?php endforeach; endif; ?>
									</ul>
								</td>
							<?php if($w == 7): ?>
						</tr>
						<tr>
							<?php endif; ?>
						<?php endforeach; ?>
						<?php if($end != 7): ?>
								<td colspan="<?php echo 7-$end; ?>" class="padding"></td>
						<?php endif; ?>
						</tr>
					</tbody>
				</table>				
			</div>
			
			<?php endforeach; ?>
		</div>		
		<div class="clear"></div>
		<!--<pre><?php //print_r($events); echo '</br>';?></pre>-->
	</body>
</html>
