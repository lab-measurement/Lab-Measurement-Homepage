<?xml version="1.0" encoding="utf8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
<head>
<title>Lab::Measurement - measurement control in Perl: News</title>
<link rel="stylesheet" type="text/css" href="doku.css" />
</head>
<body>
<div id="header"><img id="logo" src="header.png" alt="Lab::Measurement"/></div>
<div id="toc">
    <h1>Links</h1>
    <?php include 'deflinks.html'; ?>
    <h2>Download Lab::Measurement</h2>
    <ul>
        <li><a href="https://metacpan.org/release/Lab-Measurement">CPAN releases</a></li>
        <li><a href="https://github.com/lab-measurement/lab-measurement">Github</a></li>
        <li><a href="http://www.labmeasurement.de/gitweb/?p=labmeasurement;a=summary">Gitweb browser</a></li>
    </ul>
</div>

<?php

define('MAGPIE_CACHE_DIR', '/tmp/labmeasurement_magpie_cache');

require_once 'magpierss/rss_fetch.inc';

$url1 = 'http://dilfridge.blogspot.com/feeds/posts/default/-/lab-measurement';
$rss1 = fetch_rss($url1);
$name1= 'Andreas K. Hüttel';
foreach ($rss1->items as &$item1) { $item1['author']=$name1; }

$url2 = 'http://blogs.perl.org/mt/mt-search.fcgi?blog_id=2858&tag=lab-measurement&Template=feed&limit=20';
$rss2 = fetch_rss($url2);
$name2= 'Simon Reinhardt';
foreach ($rss2->items as &$item2) { $item2['author']=$name2; }

$allitems = array_merge($rss1->items, $rss2->items);

function so ($a, $b) { return (strcmp ($b['published'],$a['published']));    }
uasort($allitems, 'so');

$counter = 1;

foreach ($allitems as $item ) {
    if ($counter<15) {
        $title = utf8_encode( $item['title'] );
        $url   = $item['link'];
        $published = preg_replace('/T.*$/','',$item['published']);
        $author = $item['author'];
	$content = utf8_encode ( $item[atom_content] );
        echo "<a name='pos$counter'><h2>$title &nbsp; <font size='-1'>(posted $published by $author, <a href='$item[link]'>&rarr; original post</a>)</font></h2></a>\n";
        echo "<p>$content<br></p>\n";
        $counter++;
    };
}

?>

</body>
</html>
