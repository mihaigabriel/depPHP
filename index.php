<?php

function sanitize_output($buffer) {
    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );
    $replace = array(
        '>',
        '<',
        '\\1'
    );
    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}

function create($source){
$index = fopen("index.html", "w");
fwrite($index, $source);
fclose($index);
if ($index) {
	echo 'Copied succesfully!';
}
else {
	echo 'Failed to copy/write document.';
}
}


$html = file_get_contents('http://mihaigabriel.eu');
//$html = htmlspecialchars($html, ENT_QUOTES);
$html = sanitize_output($html);
//echo '<pre>'.trim($html).'</pre>';
create($html);


?>
