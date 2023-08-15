<?php

	if (DOMAIN == 'youtub.local') {
		return array(
			'charset' => 'utf8mb4',
			'user'    => 'mysql',
			'pass'    => 'mysql',
			'db'      => 'denisul4_youtub'
		);
	} else {
		return array(
			'charset' => 'utf8mb4',
			'user'    => '',
			'pass'    => '',
			'db'      => ''
		);
	}