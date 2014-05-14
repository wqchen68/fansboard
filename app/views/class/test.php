<?php
session_start();

//http://www.php5.idv.tw/modules.php?mod=books&act=index&cid=17
//--------------------------------------------------------------
define("CONSTANT", "Hello world"); 
$num = 123.456;
$string1 = 'abc123$a';
$string2 = "abc123$a";
$string3 = 'aaa'.'bbbb'.$string2;
$array1 = array(1,2,3);
$array2 = array('a','b','c');
$array3 = array(a=>'a1',b=>'b1',c=>'c1');


//--------------------------------------------------------------
echo CONSTANT;																			echo '<br />';
echo $string1;																			echo '<br />';
echo $string2;																			echo '<br />';
echo $string3;																			echo '<br />';
echo $array1[0];																		echo '<br />';
echo $array3[a];																		echo '<br />';


//--------------------------------------------------------------SESSION操作
$_SESSION['s1'] = 'string to server';
echo $_SESSION['s1'];																	echo '<br />';


//--------------------------------------------------------------
if($a==1){
	//...........
}else{
	//...........
}

for($i=0;$i<10;$i++){
	//...........
}



$i=0;
while($i<12){
	//...........
	$i++;
}

function func1($arg1,$arg2){
}

//--------------------------------依序存取陣列
foreach($array2 as $key => $an){
	echo "array2[$key] = $an";																			echo '<br />';
}



//--------------------------------------------------------------DB操作
require_once('dbnew.php');
$db = new DBnew();

$sql = " SELECT * FROM syncplayerlist WHERE datarange='ALL' ORDER BY player LIMIT 3";
$resultAry = $db->getData($sql,'assoc');

foreach($resultAry as $data){
	echo $data[player];																				echo '<br />';
}



$sql_update = " INSERT INTO table (....) VALUES (.....)";
//$db->Query($sql_update);

$sql_update = " UPDATE table SET xx=yy WHERE zz=1";
//$db->Query($sql_update);


//--------------------------------------------------------------檔案操作
	$handle=fopen('try.txt','a+');
	fwrite($handle,'test string'."\n");
	fclose($handle);
?>