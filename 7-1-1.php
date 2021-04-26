


<?php
echo $_GET['ro'];
echo "<hr>";
echo $_GET['jobcat']; 
echo "<hr>"; 
echo $_GET['kwop']; 
echo "<hr>"; 
echo $_GET['keyword']; 
echo "<hr>"; 
echo $_GET['expansionType']; 
echo "<hr>"; 
echo $_GET['area']; 
echo "<hr>"; 
echo $_GET['order']; 
echo "<hr>"; 
echo $_GET['asc']; 
echo "<hr>"; 
echo $_GET['page']; 
echo "<hr>"; 
echo $_GET['mode']; 
echo "<hr>"; 
echo $_GET['jobsource'];

echo "<hr>"; 

if( isset($_GET["keyword"]) ){
    echo '有$_GET["keyword"]';
} else {
    echo '沒有$_GET["keyword"]';
}