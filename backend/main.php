<?php
	require_once("./config/Config.php");
	require_once("./models/Auth.php");


	$db = new Connection();
	$pdo = $db->connect();

	$get = new Get($pdo);
	$post = new Post($pdo);
	$auth = new Auth($pdo);

	if(isset($_REQUEST['request'])) {
		$req = explode('/', rtrim($_REQUEST['request'], '/'));
	} else {
		$req = array("errorcatcher");
	}
	switch($_SERVER['REQUEST_METHOD']) {
		case 'POST':
			// (base64_decode)
			switch($req[0]) {
				// jd(check_message())
				//AUTH METHOD
				case 'login':
					$d = json_decode(file_get_contents("php://input")); 
					// print_r($d);
					echo json_encode($auth->login($d));
				break;

				case 'register':
					$d = json_decode(file_get_contents("php://input")); 
					// print_r($d);
					echo json_encode($auth->register($d));
				break;

				# End WEB POST Operation
				default:
					echo "no endpoint";
				break;
			}
		break;

		default:
			echo "prohibited";
		break;

	}
?>