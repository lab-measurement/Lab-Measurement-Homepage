<?xml version="1.0" encoding="utf8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
<head>
<title>Lab::Measurement - Measurement control with Perl</title>
<meta property="og:title" content="Lab::Measurement - Measurement control with Perl" />
<meta property="og:type" content="product" />
<meta property="og:url" content="http://www.labmeasurement.de/" />
<meta property="og:image" content="http://www.labmeasurement.de/screen.png" />
<meta property="og:site_name" content="Lab::Measurement" />
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
        <li><a href="https://github.com/lab-measurement/Lab-Measurement">Github repository</a></li>
    </ul>
    <h2>Development build self-test</h2>
    <br>
    <table>
    <tr><td>Linux</td><td>
    <img src="https://github.com/lab-measurement/Lab-Measurement/actions/workflows/test.yml/badge.svg">
    </td></tr>
    <tr><td>Windows</td><td><a href="https://ci.appveyor.com/project/akhuettel/lab-measurement" target="_blank">
    <img src="https://ci.appveyor.com/api/projects/status/nx2lyvat5dm2s41q/branch/master?svg=true"></a>
    </tr></table>
    <br>
</div>

<?php
/* derived from https://davidwalsh.name/php-cache-function, MIT-licensed */
/* gets the contents of a file if it exists, otherwise grabs url and caches */
function cached_get_content($file,$url,$hours = 24,$fn = '',$fn_args = '') {
    $current_time = time();
    $expire_time = $hours * 60 * 60;
	$file_time = filemtime($file);
	if(file_exists($file) && ($current_time - $expire_time < $file_time)) {
		return file_get_contents($file);
	}
	else {
		$content = file_get_contents($url);
		if($fn) { $content = $fn($content,$fn_args); }
		file_put_contents($file,$content);
		return $content;
	}
}
?>

<p><i>Lab::Measurement</i> allows to perform test and measurement tasks with Perl 5
scripts. It provides an interface to several instrumentation control backends,
as e.g. <a href="http://linux-gpib.sourceforge.net/">Linux-GPIB</a> or National Instruments' <a
href="http://sine.ni.com/psp/app/doc/p/id/psp-411">NI-VISA library</a>.
Dedicated instrument driver classes relieve the user from taking care
of internal details and make data aquisition as easy as
<pre class="titleclaim">$voltage = $multimeter-&gt;get_voltage();</pre>
</p>

<p>The <i>Lab::Measurement</i> software stack consists of several parts that are built
on top of each other. This modularization allows support for a wide range of hardware
on different operating systems. 
The protocol overhead is silently handled - you can write commands to an instrument 
and read out the result. Drivers for specific devices are included, implementing their
command syntax; more can easily be added to provide high-level functions. <i>Lab::Measurement</i>
includes tools to automatically generate measurement loops, for metadata handling (what was 
that amplifier setting in the measurement again?!), data plotting, and similar.</p>

<p>
Lab::Measurement is primarily developed at the <a
href="https://www.akhuettel.de/group/">Carbon Nanotube Transport 
and Nanomechanics Group, University of Regensburg</a>. Feel free to try it, to hack, and to 
send us your improvements and bugfixes. The latest release is <i>Lab::Measurement 
<?php 
$json=cached_get_content("/tmp/labmeasurement_magpie_cache/.metacpan-release",
                  "https://fastapi.metacpan.org/v1/release/Lab-Measurement");
$obj=json_decode($json);
print $obj->{'version'};
?></i>.
</p>


<h2>Contact</h2>
<ul>
  <li> Join the <a href="http://web.libera.chat/?channels=#labmeasurement">
  #labmeasurement</a> channel on Libera.Chat IRC </li>
  <li> Report bugs <a href="https://github.com/lab-measurement/lab-measurement/issues">on our Issue tracker</a></li>
</ul>


<h2>News</h2>

<p>
<ul>
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
    if ($counter<5) {
        $title = $item['title'];
        $published = preg_replace('/T.*$/','',$item['published']);
        $author = $item['author'];
        echo "<li><a href='news.php#pos$counter'>";
        if ($counter == 1) { echo "<b>"; };
        echo "$published: $title";
        if ($counter == 1) { echo "</b>"; };
        echo "</a></li>\n";
        $counter++;
    };
}

?>
</ul>
</p>

<h2>How to obtain</h2>
<p>
<i>Lab::Measurement</i> can be <a 
href="https://metacpan.org/release/Lab-Measurement">downloaded 
from CPAN</a>. The <a href="https://github.com/lab-measurement/lab-measurement">source code archive can 
be found at Github</a>, where you can also obtain the newest pre-release code and 
browse the version history. For browsing the code we also have a direct 
<a href="/gitweb/?p=labmeasurement;a=summary">gitweb access</a>.
</p>

<p>
Please consider citing <i>Lab::Measurement</i> in publications where you have used it to measure. 
Here's how:
<blockquote>
S. Reinhardt, C. Butschkow, S. Geissler, A. Dirnaichner, F. Olbrich, C. Lane, D. Schröer, and A. K. Hüttel,
<i>"Lab::Measurement — a portable and extensible framework for controlling lab equipment and conducting measurements"</i>,
<a href="http://dx.doi.org/10.1016/j.cpc.2018.07.024">Computer Physics Communications <b>234</b>, 216 (2019)</a>.
</blockquote>
</p>

<p>
While <i>Lab::Measurement</i> has built-in support for devices connected, e.g., via
ethernet, serial port, or the Linux USB Test&amp;Measurement kernel driver, you 
may want to additionally install driver backends such as
<a href="https://metacpan.org/pod/Lab::VISA"><i>Lab::VISA</i></a> or
<a href="http://linux-gpib.sourceforge.net/" target="_blank"><i>LinuxGPIB</i></a>.
</p>

<h2>Documentation</h2>
<p>Quite some <a href="https://metacpan.org/pod/Lab::Measurement::Manual">documentation of <i>Lab::Measurement</i></a>
is available. This documentation includes a <a href="https://metacpan.org/pod/Lab::Measurement::Tutorial">tutorial on
using <i>Lab::Measurement</i></a>. Detailed <a href="https://metacpan.org/pod/Lab::Measurement::Installation">installation
instructions</a> are provided as well. In addition, there's also a collection
of <a href="https://metacpan.org/pod/Lab::Measurement::Backends">hardware back-end specific documentation and links</a>.
</p>

<h2>Authors and history</h2>
<p>The <i>Lab::VISA</i> packages were originally developed by <a
    href="https://metacpan.org/author/SCHROEER">Daniel Schr&ouml;er</a> and
continued by <a href="http://www.akhuettel.de/">Andreas K. H&uuml;ttel</a>, Daniela 
Taubert, and Daniel Schr&ouml;er. Most of the documentation was
written by Daniel Schr&ouml;er. In 2011, the code was refactored mostly by Florian Olbrich
to include the Bus and Connection layers; subsequently the name of the entire package collection
was changed to <i>Lab::Measurement</i>. David Kalok, Hermann Kraus, and Alois Dirnaichner have contributed 
additional code. The <i>Lab::XPRESS</i> high-level layer was added by Christian Butschkow,
Stefan Geissler and Alexei Iankilevitch. Since 2016 development is pushed ahead by
<a href="https://www.researchgate.net/profile/Simon_Reinhardt">Simon Reinhardt</a> with the port
of the entire module stack to <i>Moose</i>.
</p>

<a name="license"><h2>License</h2></a>
<p>
<i>Lab::Measurement</i> is free software, released under <a
href="http://dev.perl.org/licenses/">the same terms as Perl itself</a>; this
means you have the choice of any version of the <a
href="https://www.gnu.org/licenses/gpl">GNU General Public License</a> or of the
<a href="http://dev.perl.org/licenses/artistic.html">Artistic License</a>.
</p>

<h2>Acknowledgments</h2>
<p>The continued improvement of <i>Lab::Measurement</i> was supported by the
<a href="http://www.dfg.de/en/" target="_blank">Deutsche Forschungsgemeinschaft</a>
via grants Hu 1808/1 (Emmy Noether program), collaborative research centres 
<!a href="http://www-app.uni-regensburg.de/Fakultaeten/Physik/sfb689/" target="_blank">SFB 689</a>,
<a href="https://www.sfb1277-regensburg.de/" target="_blank">SFB 1277</a>,
and graduate research school <!a href="http://www.physik.uni-regensburg.de/forschung/gk_carbonano/"
target="_blank">GRK 1570</a>, as well as directly by the <a href="http://www.ur.de/"
target="_blank">Universität Regensburg</a>.
</p>

<p>
<img src="logo-emmy.png" height="100" alt="Emmy Noether logo">
<img src="logo-sfb689.png" height="100" alt="SFB 689 logo"> 
<img src="logo-grk.png" height="100" alt="GRK 1570 logo"> 
<img src="logo-sfb1277.png" height="100" alt="SFB 1277 logo"> 
<img src="logo-ur.png" height="100" alt="UR logo"> 
</p>

</body>
</html>
