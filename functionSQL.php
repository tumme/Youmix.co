<?php

function connect()
{
  // $db = new PDO('mysql:host=localhost;dbname=youmix;charset=utf8mb4', 'root', '');
  $HOST="localhost";
  $PORT=""; 
  $DB_USER="root"; 
  $DB_PWD=""; 
  $DB_NAME="youmix_v2";  

  $DB_HOST=(!empty($PORT)) ? $HOST.":".$PORT : $HOST;
  if(@mysql_connect($DB_HOST,$DB_USER,$DB_PWD)){
    $conServ=@mysql_select_db($DB_NAME) or die("SQL Error: <br>".mysql_error());    
  }else{
    die("SQL Error: <br>".mysql_error());   
  }
}

function query($sql)
{
  if(@mysql_query($sql)) { return true; } 
  else { die("SQL Error: <br>".$sql."<br>".mysql_error()); return false; }
}

function select($sql)
{
  $result=array();
  $req =@mysql_query($sql) or die("SQL Error: <br>".$sql."<br>".mysql_error());
  while($data=@mysql_fetch_assoc($req)) {
    $result[]=$data;
  }
  return $result;	
}

function insert($table,$data)
{
  $fields=""; $values="";
  $i=1;
  foreach($data as $key=>$val)
  {
    if($i!=1) { $fields.=", "; $values.=", "; }
    $fields.="$key";
    $values.="'$val'";
    $i++;
  }
  $sql = "INSERT INTO $table ($fields) VALUES ($values)";
  if(@mysql_query($sql)) { return true; } 
  else { die("SQL Error: <br>".$sql."<br>".mysql_error()); return false;}
}

function update($table,$data,$where)
{

  $modifs="";
  $i=1;
  foreach($data as $key=>$val)
  {
    if($i!=1){ $modifs.=", "; }
    if(is_numeric($val)) { $modifs.=$key.'='.$val; }
    else { $modifs.=$key.' = "'.$val.'"'; }
    $i++;
  }
  $sql = ("UPDATE $table SET $modifs WHERE $where");
  if(@mysql_query($sql)) { return true; } 
  else { die("SQL Error: <br>".$sql."<br>".mysql_error()); return false; }
}

function delete($table, $where)
{
  $sql = "DELETE FROM $table WHERE $where";
  if(@mysql_query($sql)) { return true; } 
  else { die("SQL Error: <br>".$sql."<br>".mysql_error()); return false; }
}

function listfield($table)
{
	$req=@mysql_query("SELECT * FROM $table");
	$numberfields =@mysql_num_fields($req);
	$row_title="\$data=array(<br/>";
	for($i=0; $i<$numberfields ; $i++ ) {
		   $var=@mysql_field_name($req, $i);
		   $row_title.="\"$var\"=>\"value$i\",<br/>";
	}
	$row_title.=");<br/>";
	echo $row_title;
}
?>