<?xml version="1.0" encoding="utf8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
<head>
<title>Lab::Measurement - measurement control in Perl: News</title>
<link rel="stylesheet" type="text/css" href="doku.css" />
</head>
<body>

<?php
set_include_path("./include");
require_once('SimplePie.compiled.php');
?>

<div id="header"><img id="logo" src="header.png" alt="Lab::Measurement"/></div>
<div id="toc">
    <h1>Links</h1>
    <?php include 'deflinks.html'; ?>
    <h2>Download Lab::Measurement</h2>
    <ul>
        <li><a href="https://metacpan.org/release/Lab-Measurement">CPAN releases</a></li>
        <li><a href="https://github.com/lab-measurement/lab-measurement">Github</a></li>
    </ul>
</div>

<style>
div.separator {
  float: right;
  margin-left: 30px;
  margin-top: 5px;
  margin-bottom: 5px;
}
</style>

<h1>News blog</h1>

<?php

// We'll process this feed with all of the default options.
$feed = new SimplePie();

// Disable cache for the start
$feed->enable_cache(false);

// Set which feed to process.
// FIXME: re-add Simon
$feed->set_feed_url('http://dilfridge.blogspot.com/feeds/posts/default/-/lab-measurement');

// Run SimplePie.
$feed->init();

// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();

$counter = 1;

foreach ($feed->get_items() as $item ) {
	if ($counter<26) {
		$title = $item->get_title();
		$content = $item->get_content();
		$url   = $item->get_link();
		$published = $item->get_date('j F Y');
		echo "<h2><a name='pos$counter'></a>$title &nbsp; <font size='-1'>(posted $published)</font></h2>\n";
		echo "<div class='onlytext'>$content</div><br>\n\n";
	};
	$counter++;
}

?>

</body>
</html>
