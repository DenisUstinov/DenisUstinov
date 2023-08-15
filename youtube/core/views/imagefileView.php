<?php

header("Content-type: image/jpeg");
readfile('https://i.ytimg.com/vi/'.str_replace('.jpg', '', $matches['file']).'/mqdefault.jpg'); 
exit;