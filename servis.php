<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}
function rest_get($request, $data) 
{
//	$veza = new PDO("mysql:dbname=hayii;host=localhost;charset=utf8", "root", "");
	//$veza->exec("set names utf8");
    $x = $data['x'];
	$username = $data['autor'];
	 include ('includes/db_config.php');
         $query ="SELECT p.* FROM users u ,posts p WHERE p.authorid = u.id AND u.username= '".mysqli_real_escape_string($connection,$username)."'";
    $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result)  <$x) {
        print "{ \"error\":Preveliko X. Autor ima ukupno ".mysqli_num_rows($result)." novosti!}";
        }
        else 
        {
            $rezultat=mysqli_fetch_all($result,MYSQLI_ASSOC);
        
		$niz = array();
		for ($i = 0; $i < $x; $i++)
			array_push($niz, $rezultat[$i]);
		
		print "{ \"novosti\": " . json_encode($niz) . "}";
	}	
}
function rest_post($request, $data) { }
function rest_delete($request) { }
function rest_put($request, $data) { }
function rest_error($request) { }
$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];
switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>