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
<meta property="fb:admins" content="1016535977" />
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
    <table><tr><td>Linux</td><td><a href="https://travis-ci.org/lab-measurement/Lab-Measurement" target="_blank">
    <img src="https://travis-ci.org/lab-measurement/Lab-Measurement.svg?branch=master"></a>
    </td></tr><tr><td>Windows</td><td><a href="https://ci.appveyor.com/project/akhuettel/lab-measurement" target="_blank">
    <img src="https://ci.appveyor.com/api/projects/status/nx2lyvat5dm2s41q/branch/master?svg=true"></a>
    </tr></table>
    <br>
    <iframe
      src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.labmeasurement.de%2F&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21"
      scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
</div>

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
on different operating systems. A typical measurement script is based on the high-level 
interface provided by the modules <i>Lab::Instrument</i> and <i>Lab::Measurement</i>. 
All the protocol overhead is silently handled - you can write commands to an instrument 
and read out the result. Drivers for specific devices are included, implementing their
command syntax; more can easily be added to provide high-level functions. <i>Lab::Measurement</i>
includes tools to automatically generate measurement loops, for metadata handling (what was 
that amplifier setting in the measurement again?!), data plotting, and similar.</p>

<p>
Lab::Measurement is primarily developed at the <a
href="http://www.physik.uni-regensburg.de/forschung/huettel/">Carbon Nanotube Transport 
and Nanomechanics Group, University of Regensburg</a>. Feel free to try it, to hack, and to 
send us your improvements and bugfixes.
</p>


<h2>Contact</h2>
<ul>
  <li> Join the <a href="http://webchat.freenode.net/?channels=labmeasurement">
  #labmeasurement</a> channel on Freenode IRC </li>
  <li> Join our <a href="https://www-mailman.uni-regensburg.de/mailman/listinfo/lab-measurement-users"> mailing list</a></li>
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
Lab::Measurement can be <a 
href="https://metacpan.org/release/Lab-Measurement">downloaded 
from CPAN</a>. The <a href="https://github.com/lab-measurement/lab-measurement">source code archive can 
be found at Github</a>, where you can also obtain the newest pre-release code and 
browse the version history. For browsing the code we also have a direct 
<a href="/gitweb/?p=labmeasurement;a=summary">gitweb access</a>.
</p>

<p>
Please consider citing Lab::Measurement in publications where you have used it to measure. Here's how:
<blockquote>
S. Reinhardt, C. Butschkow, S. Geissler, A. Dirnaichner, F. Olbrich, C. Lane, D. Schröer, and A. K. Hüttel,
<i>"Lab::Measurement — a portable and extensible framework for controlling lab equipment and conducting measurements"</i>,
<a href="https://arxiv.org/abs/1804.03321">arXiv:1804.03321</a> (2018). (<a href="labmeasurement.bib">BibTeX file</a>)
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
<p>Quite some <a href="https://metacpan.org/pod/Lab::Measurement::Manual">documentation of Lab::Measurement</a>
is available. This documentation includes a <a href="https://metacpan.org/pod/Lab::Measurement::Tutorial">tutorial on
using Lab::Measurement</a>. Detailed <a href="https://metacpan.org/pod/Lab::Measurement::Installation">installation
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
additional code. The new <i>Lab::XPRESS</i> high-level layer was contributed by Christian Butschkow, 
Stefan Geissler and Alexei Iankilevitch; current development is pushed ahead by
    <a href="https://github.com/amba">Simon Reinhardt</a>.
</p>

<a name="license"><h2>License</h2></a>
<p>
Lab::Measurement is free software, released under <a
href="http://dev.perl.org/licenses/">the same terms as Perl itself</a>; this
means you have the choice of any version of the <a
href="https://www.gnu.org/licenses/gpl">GNU General Public License</a> or of the
<a href="http://dev.perl.org/licenses/artistic.html">Artistic License</a>.
</p>

<h2>Acknowledgments</h2>
<p>The continued improvement of Lab::Measurement was supported by the
<a href="http://www.dfg.de/en/" target="_blank">Deutsche Forschungsgemeinschaft</a>
via grants Hu 1808/1 (Emmy Noether program), collaborative research centre 
<a href="http://www-app.uni-regensburg.de/Fakultaeten/Physik/sfb689/" target="_blank">SFB 689</a>,
and graduate research school <a href="http://www.physik.uni-regensburg.de/forschung/gk_carbonano/"
target="_blank">GRK 1570</a>.
</p>

<p>
<img src="logo-emmy.png" height="150" alt="Emmy Noether logo">
<img src="logo-sfb689.png" height="150" alt="SFB 689 logo"> 
<img src="logo-grk.png" height="150" alt="GRK 1570 logo"> 
</p>

</body>
</html>
