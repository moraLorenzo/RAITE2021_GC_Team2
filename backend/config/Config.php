<?php  
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=utf-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, X-Auth-User");
	date_default_timezone_set("Asia/Manila");
	set_time_limit(1000);
	
	require_once("./vendor/autoload.php");
	require_once("main.php");
	require_once("./models/Global.php");
	require_once("./models/Procedural.php");
	require_once("./models/Get.php");
	require_once("./models/Post.php");
	require_once("./models/Auth.php");

	require_once 'vendor/autoload.php';

	use Dotenv\Dotenv;

	$dotenv = new Dotenv(__DIR__);
	$dotenv->load();
	
	define("SERVER", getenv("__SERVER_"));
	define("DBASE", getenv("__DBASE_"));
	define("USER", getenv("__USER_"));
	define("PW", getenv("__PASSWORD_"));
	define("HAYSTACK", getenv("__HAYSTACK_"));

	define("CHARSET", "utf8");
	define("SECRET", base64_encode("www.gordoncollege.edu.ph"));

	class Connection {
		protected $constring = "mysql:host=".SERVER.";dbname=".DBASE.";charset=".CHARSET;
		protected $options = [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
			\PDO::ATTR_EMULATE_PREPARES => false
		];

		public function connect() {
			return new \PDO($this->constring, USER, PW, $this->options);
		}
	}
?>