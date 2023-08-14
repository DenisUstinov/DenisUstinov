<div class="details_one">
	<div style="font-weight:100;">{$time_of_day}</div>
	<div style="font-size:3.0em">
		<span class="text_smal">{$temperature_to}°</span> <span style="font-weight:100;font-size:0.35em;color:#{$color_text};"> {$temperature_from}°</span>
		<img class="img_details" src="{$hosts}/core/color.php?image_name={$image}.png&color_icon={$color_text}">
	</div>
	<div style="font-size:0.7em;">{$weather_type}</div>
	<div style="font-size:0.7em;"><span class="none1210">Ветер {$wind_direction}</span> {$wind_speed} м/с</div>
	<div style="font-size:0.7em;"><span class="none1210">Относительная влажность</span> {$humidity} % </div>
	<div style="font-size:0.7em;"><span class="none1210">Атмосферное давление</span> {$pressure} мм</div>
	<div style="font-size:0.7em;"><span class="none1210">Среднее давление на уровне моря</span> {$mslp_pressure} мм</div>
</div>