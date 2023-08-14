<div>
	<div class="day {$active}" onclick="javascript:modals('{$id}'); this.className='day active';">
		<div style="padding-bottom:5px;font-size:0.95em;font-weight:400;">{$prev_date}</div>
		<div style="padding-bottom:0px;">
			<img class="img_prev" src="{$hosts}/core/color.php?image_name={$prev_image}.png&color_icon={$color_text}" width="30px" height="30px">
		</div>
		<div style="padding-bottom:0px;font-size:1.5em;font-weight:400;">
			{$prev_temperature_from}° <span style="font-weight:100;font-size:0.5em;color:#{$color_text}"> {$prev_temperature_to}°</span>
		</div>
		<div style="font-size:0.7em;">{$prev_weather_type}</div>
	</div>
</div>