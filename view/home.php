<?php
require_once('../includes/helper.php');
render('header', array('title' => 'C$75 Finance'));

if (isset($_SESSION['userid'])) {
    print "<p>userid: " . $_SESSION['userid'] . "</p>";
}
?>



<ul>
    <li><a href="#">Portfolio</a></li>
    <li><a href="#">Quote</a></li>
    <li><a href="#">Buy</a></li>
    <li><a href="#">Sell</a></li>
</ul>




<?php
render('footer');
?>
