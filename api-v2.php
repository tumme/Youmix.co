<?
ini_set("display_errors",1);
require 'Slim/Slim.php';


\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->get('/playlists', 'getPlayLists'); 
$app->post('/user', 'createUser'); 



$app->run();

function getPlayLists() {
  $sql_query = "SELECT tbl_playlist.playlist_id,
    tbl_playlist.playlist_name,
    tbl_playlist.playlist_user,
    tbl_playlist.playlist_cover,
    tbl_user.display_name,
    tbl_type_playlist.type_name 
    FROM tbl_playlist LEFT JOIN tbl_user ON tbl_user.user_id = tbl_playlist.playlist_user 
    INNER JOIN tbl_type_playlist ON tbl_type_playlist.type_id = tbl_playlist.playlist_type 
    WHERE playlist_status != 'unpublish' ORDER BY playlist_id DESC LIMIT 60";
    
  try {
    $dbCon = getConnection();
    $stmt   = $dbCon->query($sql_query);
    $Playlist  = $stmt->fetchAll(PDO::FETCH_OBJ);
    $dbCon = null;
    echo '{"PlayList": ' . json_encode($Playlist) . '}';
  }
  catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getConnection() {
  try {
    $db_username = "root";
    $db_password = "";
    // $db_username = "youmixm_2015";
    // $db_password = "SW8wvGgIjv";
    $conn = new PDO('mysql:host=localhost;dbname=youmix', $db_username, $db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
  return $conn;
}

?>
