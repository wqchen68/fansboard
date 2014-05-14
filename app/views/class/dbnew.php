<?php
# getData -> 取得資料集合 ( 資料庫語法 , all:陣列索引值及欄位名稱 assoc:依欄位整理 array:依索引值)
# Query -> 執行SQL指令

require("config_fb.php");

class DBnew
{

	//資料庫定義基本設定 Begin
	var $SQL_IP = SQL_IP;		// 資料庫 (MySQL) 實體位置
	var $DB_Name = DB_Name;		// 資料庫名稱
	var $DB_Author = DB_Author;		// 資料庫存取帳號
	var $DB_Password = DB_Password;	// 資料庫存取密碼
	//資料庫定義基本設定 End
	
	// 取得資料庫連線物件
	function getConnectDB(){
	try {	
		 $link=mysql_connect($this->SQL_IP,$this->DB_Author,$this->DB_Password);
		 if(!$link){throw new Exception('Division by zero.');}
	} catch (Exception $e) {
       echo 'Could not connect DB: ' . mysql_error();
    }
		 if(!$link)
		 {
		 	die('Could not connect DB: ' . mysql_error());
		 	exit;
		 }
		 mysql_query("SET NAMES 'utf8'",$link);
		 @mysql_select_db($this->DB_Name,$link);
		 return $link;
	}
	
	function chageDB_Name($DB_Name){
		$this->DB_Name = $DB_Name;
	}
	
	// 取得資料集合 ( 資料庫語法 , all:陣列索引值及欄位名稱 assoc:依欄位整理 array:依索引值)
	function getData($query,$_type){
		$conn = $this->getConnectDB();
		$result = (mysql_query($query,$conn)); //@mysql_close($conn);
		
		$i = 0;
		$FieldLenght = mysql_num_fields($result);
		while ($i < $FieldLenght){
			$meta = mysql_fetch_field($result, $i);
			$Fields[$i] = $meta->name;
			$i++;
		}
			
		$countRow = 0;
		$res;
		while ($row = mysql_fetch_assoc($result)) {
			for($j=0;$j<$FieldLenght;$j++){
				switch($_type)
				{
					case "all":
						$res[$countRow][$j] = $row[$Fields[$j]];
						$res[$countRow][$Fields[$j]] = $row[$Fields[$j]];
						break;
					case "assoc":
						$res[$countRow][$Fields[$j]] = $row[$Fields[$j]];
						break;
					case "array":
						$res[$countRow][$j] = $row[$Fields[$j]];
						break;
					case "colume":
						$res[$Fields[$j]][$countRow] = $row[$Fields[$j]];
						break;
				}	
				//print_r($res[$countRow]); echo "<p>";		
			}
			$countRow++;
    	}
    	@mysql_close($conn );
		if( isset($res) ){
			return $res;
		}else{
			return NULL;
		}
	}	
	
	// 執行SQL Commamd
	function Query($str){
		$returnType = 'false';
		$conn = $this->getConnectDB();
		if(mysql_query($str)){ $returnType = 'true';}
		@mysql_close($conn);
		return $returnType;
	}
	// 執行並傳回insert id
	function QueryAndGetInertID($str)
	{
		//mysql_insert_id());
		$returnType = false;
		$InserID = 0;
		$conn = $this->getConnectDB();
		if(mysql_query($str))
		{ 
			$returnType = true;
			$InserID = mysql_insert_id();
		}
		@mysql_close($conn);
		return $InserID;
	}
}
?>