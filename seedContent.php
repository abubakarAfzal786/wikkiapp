<?php

require_once 'globals.php';

global $wgBaseArticlePath;

$count = 0;
for ( $i = 0; $i < 10; $i++ ) {
	$l = new \joshtronic\LoremIpsum();
	$l->words();
	file_put_contents( sprintf( "%s/%s", $wgBaseArticlePath, $l->word() ), $l->paragraphs( 10 ) );
	echo "Creating article\n";
	$count++;
}
echo "generated $count articles!";
