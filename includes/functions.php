<?php 

    function getFullnameByUsername($username) {
        include ('db_config.php');
         $query ="SELECT * FROM users WHERE username = '".mysqli_real_escape_string($connection,$username)."' LIMIT 1";
    $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);            
            return $user[2];
        }
        return false;

    }
  function getUsers() {
      $arr=array();
        include ('db_config.php');
         $query ="SELECT * FROM users WHERE role<>1";
    $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) != 0) {
       while( $user = mysqli_fetch_row($result))          
            array_push($arr,$user);
            
        }
      return $arr;

    }
function getPhoneNumber($username) {
      include ('db_config.php');
    $query ="SELECT phone FROM users WHERE username = '".mysqli_real_escape_string($connection,$username)."' AND phone IS NOT NULL LIMIT 1";
    $result = mysqli_query($connection, $query);
        if( mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);  
            
           return $user[0];
        }
   
        return false;
    
}

function dajOpis($username){
     include ('db_config.php');
    $query ="SELECT description FROM users WHERE username = '".mysqli_real_escape_string($connection,$username)."' AND description IS NOT NULL LIMIT 1";
    $result = mysqli_query($connection, $query);
        if( mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);  
            
           return $user[0];
        }
   
        return false;
    
    
}
function getObjave(){
          include ('db_config.php');
      $query ="SELECT u.username, p.content, p.dateposted,p.id,p.status,(SELECT count(*) from comments c where c.postid=p.id && c.procitan is NULL)  FROM users u, posts p WHERE u.id = p.authorid ORDER BY p.dateposted DESC ";
    $result = mysqli_query($connection, $query);
    
    
    return $result;
}
function getObjaveABC(){
          include ('db_config.php');
      $query ="SELECT u.username, p.content, p.dateposted,p.id,p.status,(SELECT count(*) from comments c where c.postid=p.id && c.procitan is NULL)  FROM users u, posts p WHERE u.id = p.authorid  ORDER BY p.content ";
    $result = mysqli_query($connection, $query);
    
    
    return $result;
}

function dajPost($postid){
    include ('db_config.php');
        $query ="SELECT u.username, p.content, p.dateposted,p.authorid,p.status FROM users u, posts p WHERE u.id = p.authorid  AND p.id =
        '".mysqli_real_escape_string($connection,$postid)."' LIMIT 1";
    $result = mysqli_query($connection, $query);
    $res=mysqli_fetch_row($result);
    return $res;
    
}
function dajIdUsera($username){
    
      include ('db_config.php');
         $query ="SELECT * FROM users WHERE username = '".mysqli_real_escape_string($connection,$username)."' LIMIT 1";
    $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);            
            return $user[0];
        }
        return false;

}
function oznaciProcitanim($post,$tip){
     include ('db_config.php');
    if($tip==1){
        $sql ='UPDATE `comments` SET `procitan`=1 WHERE postid='.$post.' AND procitan IS NULL AND commentid IS NULL';

if (mysqli_query($connection, $sql)) {
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}
    }
    
   else   if($tip==2){
        $sql ='UPDATE `comments` SET `procitan`=1 WHERE postid='.mysqli_real_escape_string($connection,$post).' AND procitan IS NULL AND commentid IS NOT NULL';

if (mysqli_query($connection, $sql)) {
   
} else {
    
}
    }
}
function obrisiUsera($userid){
    include ('db_config.php');
   

        $query ="DELETE from users WHERE id=".mysqli_real_escape_string($connection,$userid);
  if ($result = mysqli_query($connection, $query)) {

} else {
   
} 
  
}
function dajKomentare($idposta){
    $array=array();
      include ('db_config.php');
      $query ="SELECT u.username, p.content, p.date ,p.id, p.commentid,p.postid,(SELECT count(*) from comments cc where cc.commentid=p.id && cc.procitan is NULL)  FROM users u, comments p WHERE u.id = p.authorid AND p.commentid IS NULL AND p.status=0 AND p.postid=".mysqli_real_escape_string($connection,$idposta);

     $result = mysqli_query($connection, $query);
    
      while($komentar = mysqli_fetch_row($result)) {
          array_push($array,$komentar);
          
           $query ="SELECT u.username, p.content, p.date, p.id, p.commentid,p.postid FROM users u, comments p WHERE u.id = p.authorid AND status=0 AND  p.commentid=".mysqli_real_escape_string($connection,$komentar[3]);
          $result1 = mysqli_query($connection, $query);
         while($podkomentar = mysqli_fetch_row($result1))  {
             
                array_push($array,$podkomentar);
          }
      }
    return $array;
}
?>