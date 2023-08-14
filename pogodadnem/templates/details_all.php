<div id="{$id}" class="details_all" {$display_none}>
	<div class="header_section">{$date} года</div>
	{$details}
	<div style="clear:left"></div>
	<!--<div class="header_section">Подробности дня</div>-->
	<div id="yet">
		<div style="float:left;padding:15px 0 5px 20px;width:160px;">
			<div style="margin-bottom:5px;">
				<img class="img_details" src="{$hosts}/core/color.php?image_name=16.png&color_icon={$color_text}" width="30" height="30"> 
				Солнце
			</div>
			<div style="font-size:0.7em;margin-bottom:10px;">с {$sunrise} до {$sunset}</div>
		</div>
		<div style="float:left;padding:15px 0 5px 20px;width:160px;">
			<div style="margin-bottom:5px;">
				<img class="img_details" src="{$hosts}/core/color.php?image_name={$moon_phase}.png&color_icon={$color_text}" width="30" height="30"> 
				Луна
			</div>
			<div style="font-size:0.7em;margin-bottom:10px;">с {$moonrise} до {$moonset}</div>
		</div>
		<div style="clear:left"></div>
	</div>
</div>