<?
ini_set("display_errors",1);
require 'Slim/Slim.php';


\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->get('/playlists', 'getPlayLists');
$app->get('/playlistsInDex', 'getPlayListsIndex');
$app->get('/playlists/:id', 'getPlayList');
$app->get('/user/playlists/:id', 'getPlayListUser');
$app->get('/playlist/:id', 'getPlayListName');
$app->get('/playlist/search/:query', 'findPlaylist');
$app->post('/playlist', 'addPlayList');
$app->post('/playlistNonUser', 'addPlayListNonUserID');
$app->post('/playlist/:id', 'editPlayList');
// $app->post('/user', 'createUser');
// $app->get('/user/:id', 'userPlayLists');
// $app->post('/user/:Email/:Password', 'getUser');


$app->run();

function getPlayLists() {
  $sql_query = "SELECT Playlist.ID,Playlist.PlayListName,Playlist.UserID,Playlist.Cover,users.name FROM Playlist LEFT JOIN users ON users.user_id = Playlist.UserID WHERE Status != '0' AND Playlist.UserID !='5' ORDER BY ID DESC LIMIT 50";
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

function getPlayListUser($id) {
  $sql = "SELECT * FROM Playlist WHERE UserID=:id ORDER BY ID DESC LIMIT 50";
    try {
      $dbCon = getConnection();
      $stmt = $dbCon->prepare($sql);
      $stmt->bindParam("id", $id);
      $stmt->execute();
      $Playlist = $stmt->fetchAll(PDO::FETCH_OBJ);
      $dbCon = null;
      // echo json_encode($Playlist);
      echo '{"PlayList": ' . json_encode($Playlist) . '}';
  } catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getPlayListsIndex() {
  $sql_query = "SELECT Playlist.ID,Playlist.PlayListName,Playlist.UserID,Playlist.Cover,users.name FROM Playlist LEFT JOIN users ON users.user_id = Playlist.UserID WHERE Status='2' ORDER BY ID DESC LIMIT 12";
  //$sql_query = "SELECT * FROM Playlist ORDER BY ID DESC LIMIT 6";
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

function getPlayList($id) {
  $sql = "SELECT * FROM YoutubePlaylist LEFT JOIN Playlist ON Playlist.ID = YoutubePlaylist.PlayListID WHERE PlayListID=:id";
    try {
      $dbCon = getConnection();
      $stmt = $dbCon->prepare($sql);
      $stmt->bindParam("id", $id);
      $stmt->execute();
      $Playlist = $stmt->fetchAll(PDO::FETCH_OBJ);
      $dbCon = null;
      // echo json_encode($Playlist);
      echo '{"VideoID": ' . json_encode($Playlist) . '}';
  } catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getPlayListName($id) {
    $sql = "SELECT * FROM Playlist LEFT JOIN users ON Playlist.UserID = users.user_id WHERE ID=:id";
    try {
      $dbCon = getConnection();
      $stmt = $dbCon->prepare($sql);
      $stmt->bindParam("id", $id);
      $stmt->execute();
      $Playlist = $stmt->fetchAll(PDO::FETCH_OBJ);
      $dbCon = null;
      echo '{"PlayListInfo": ' . json_encode($Playlist) . '}';
  } catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function findPlaylist($query) {
    $sql = "SELECT * FROM PlayList WHERE PlayListName LIKE :query ORDER BY PlayListName";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);
        $query = "%".$query."%";
        $stmt->bindParam("query", $query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo '{"playlist": ' .json_encode($users) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function addPlayList() {
  global $app;
  $req = $app->request();
  $paramPlayListName = $req->params('PlayListName');
  $paramUserID = $req->params('UserID');
  $paramStatus = $req->params('Status');
  $paramSID = $req->params('SID');
  $paramDateCreate = $req->params('DateCreate');
  $paramView = $req->params('View');
  $paramYoutubeID = $req->params('YoutubeID');
  $paramYoutubeTitle = $req->params('YoutubeTitle');
  $sql = "INSERT INTO Playlist (PlayListName,UserID,DateCreate,View,Cover,Status,SID) VALUES (:PlayListName, :UserID, :DateCreate, :View, :Cover, :Status, :SID)";
  $sqlYoutube = "INSERT INTO YoutubePlaylist (PlayListID,YoutubeID,YoutubeTitle) VALUES (:PlayListID, :YoutubeID,:YoutubeTitle)";

  try {
      $dbCon = getConnection();
      $stmt = $dbCon->prepare($sql);
      $stmt->bindParam("PlayListName", $paramPlayListName);
      $stmt->bindParam("UserID", $paramUserID);
      $stmt->bindParam("Status", $paramStatus);
      $stmt->bindParam("SID", $paramSID);
      $stmt->bindParam("DateCreate",$paramDateCreate);
      $stmt->bindParam("View",$paramView);
      for($i=0; $i<sizeof($paramYoutubeID); $i++){
        $stmt->bindParam("Cover",$paramYoutubeID[0]);
         if ($i == 1)
          break;
      }
      $dbCon->beginTransaction();
      $stmt->execute();
      $lastInsertId = $dbCon->lastInsertId();
      $PlayList->ID = $dbCon->lastInsertId();
      $dbCon->commit();
       // echo json_encode($PlayList);
      for($i=0; $i<sizeof($paramYoutubeID); $i++){
        $stmt2 = $dbCon->prepare($sqlYoutube);
        $stmt2->bindParam("PlayListID",$lastInsertId);
        $stmt2->bindParam("YoutubeID",$paramYoutubeID[$i]);
        $stmt2->bindParam("YoutubeTitle",$paramYoutubeTitle[$i]);
        $stmt2->execute();
        
       }
      $dbCon = null;
     echo '{"PlayListID": ' . json_encode($PlayList) . '}';
  } catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }


}

function addPlayListNonUserID() {
  global $app;
  $req = $app->request();
  $paramPlayListName = $req->params('PlayListName');
  $paramUserID = $req->params('UserID');
  $paramStatus = $req->params('Status');
  $paramDateCreate = $req->params('DateCreate');
  $paramView = $req->params('View');
  $paramYoutubeID = $req->params('YoutubeID');
  $paramYoutubeTitle = $req->params('YoutubeTitle');
  $sql = "INSERT INTO Playlist (PlayListName,UserID,DateCreate,View,Cover,Status) VALUES (:PlayListName,:UserID,:DateCreate,:View,:Cover,:Status)";
  $sqlYoutube = "INSERT INTO YoutubePlaylist (PlayListID,YoutubeID,YoutubeTitle) VALUES (:PlayListID, :YoutubeID,:YoutubeTitle)";

  try {
      $dbCon = getConnection();
      $stmt = $dbCon->prepare($sql);
      $stmt->bindParam("PlayListName", $paramPlayListName);
      $stmt->bindParam("UserID", $paramUserID);
      $stmt->bindParam("Status", $paramStatus);
      $stmt->bindParam("DateCreate",$paramDateCreate);
      $stmt->bindParam("View",$paramView);
      for($i=0; $i<sizeof($paramYoutubeID); $i++){
        $stmt->bindParam("Cover",$paramYoutubeID[0]);
         if ($i == 1)
          break;
      }
      $dbCon->beginTransaction();
      $stmt->execute();
      $lastInsertId = $dbCon->lastInsertId();
      $dbCon->commit();
      for($i=0; $i<sizeof($paramYoutubeID); $i++){
        $stmt2 = $dbCon->prepare($sqlYoutube);
        $stmt2->bindParam("PlayListID",$lastInsertId);
        $stmt2->bindParam("YoutubeID",$paramYoutubeID[$i]);
        $stmt2->bindParam("YoutubeTitle",$paramYoutubeTitle[$i]);
        $stmt2->execute();
       }
      $dbCon = null;
      echo $stmt;
      echo $stmt2;
  } catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}
function editPlayList($id) {
  global $app;
  $req = $app->request();
  $paramPlayListID = $req->params('PlayListID');
  $paramPlayListName = $req->params('PlayListName');
  $paramUserID = $req->params('UserID');
  $paramDateCreate = $req->params('DateCreate');
  $paramView = $req->params('View');
  $paramYoutubeID = $req->params('YoutubeID');
  $paramYoutubeTitle = $req->params('YoutubeTitle');
  $sql = "UPDATE Playlist SET PlayListName=:PlayListName, Cover=:Cover WHERE ID=:id ";
  $sqlYoutube = "INSERT INTO YoutubePlaylist (PlayListID,YoutubeID,YoutubeTitle) VALUES (:PlayListID, :YoutubeID,:YoutubeTitle)";

  try {
      $dbCon = getConnection();
      $stmt = $dbCon->prepare($sql);
      $stmt->bindParam("id", $id);
      $stmt->bindParam("PlayListName", $paramPlayListName);
      for($i=0; $i<sizeof($paramYoutubeID); $i++){
        $stmt->bindParam("Cover",$paramYoutubeID[0]);
         if ($i == 1)
          break;
      }
      $dbCon->beginTransaction();
      $stmt->execute();
      $lastInsertId = $dbCon->lastInsertId();
      $dbCon->commit();
      for($i=0; $i<sizeof($paramYoutubeID); $i++){
        $stmt2 = $dbCon->prepare($sqlYoutube);
        // $stmt2->bindParam("id", $paramPlayListID);
        $stmt2->bindParam("PlayListID",$id);
        $stmt2->bindParam("YoutubeID",$paramYoutubeID[$i]);
        $stmt2->bindParam("YoutubeTitle",$paramYoutubeTitle[$i]);
        $stmt2->execute();
       }
      $dbCon = null;
      // echo json_encode($stmt);
       //echo json_encode($stmt2);
  } catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

// Sign In Function

function createUser() {
  global $app;
  $req = $app->request();
  $paramName = $req->params('Name');
  $paramEmail = $req->params('Email');
  $paramPassword = $req->params('Password');
  $paramDateCreate = $req->params('DateCreate');
  $sql = "INSERT INTO users (Email, Password, Name, DateCreate) VALUES (:Email, :Password, :Name, :DateCreate)";
  try {
    $dbCon = getConnection();
    $stmt = $dbCon->prepare($sql);
    $stmt->bindParam("Email", $paramEmail);
    $stmt->bindParam("Password",$paramPassword);
    $stmt->bindParam("Name", $paramName);
    $stmt->bindParam("DateCreate",$paramDateCreate);
    $stmt->execute();
    // $user->id = $dbCon->lastInsertId();
    $dbCon = null;
    $response = "done";
  } catch(PDOException $e) {
    echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getUser($Email,$Password) {
  $sql = "SELECT Email,Password FROM USer WHERE Email=:Email AND Password=:Password";
  try {
      $dbCon = getConnection();
      $stmt = $dbCon->prepare($sql);
      $stmt->bindParam("Email", $Email);
      $stmt->bindParam("Password", $Password);
      $stmt->execute();
      $user = $stmt->fetchObject();
      $dbCon = null;
      echo json_encode($user);
  } catch(PDOException $e) {
      echo '{"error":{"text":'. $e->getMessage() .'}}';
  }
}

function getConnection() {
  try {
    $db_username = "youmixm_2015";
    $db_password = "SW8wvGgIjv";
    $conn = new PDO('mysql:host=localhost;dbname=youmixm_2015', $db_username, $db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }
  return $conn;
}

?>
