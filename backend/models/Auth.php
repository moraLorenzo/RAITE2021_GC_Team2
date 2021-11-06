<?php  
	class Auth {
		protected $pdo; 
		protected $gm;

		public function __construct(\PDO $pdo) {
			$this->gm = new GlobalMethods($pdo);
			$this->pdo = $pdo;
		}

		
		########################################
		# 	USER AUTHORIZATION RELATED METHODS
		########################################
		
		protected function generateHeader() {
			$h=[
				"typ"=>"JWT",
				"alg"=>'HS256',
				"app"=>"GC_Team2",
				"dev"=>"Tagle, Gerald B., Lorenzo Mora"
			];
			return str_replace(['+','/','='],['-','_',''], base64_encode(json_encode($h)));
		}
		
		
		protected function generatePayload($uc, $ue, $ito) {
			$p = [   
				'uc'=>$uc,
				'ue'=>$ue,
				'ito'=>$ito,
				'iby'=>'Tagle, Gerald B.',
				'ie'=>'GC_Team2@gmail.com',
				'idate'=>date_create()
			];
			return str_replace(['+','/','='],['-','_',''], base64_encode(json_encode($p)));
		}

		protected function generateToken($code, $course, $fullname) {
			$header = $this->generateHeader();
			$payload = $this->generatePayload($code, $course, $fullname);
			$signature = hash_hmac('sha256', "$header.$payload", "www.gordoncollege.edu.ph");
			return str_replace(['+','/','='],['-','_',''], base64_encode($signature));
		}

		public function isAuthorized($dt) {
			// print_r($dt);
			$authUser = $dt->userid;
			$authHeader = $dt->token;
			$sql = "SELECT id, User_token FROM accounts_tbl WHERE id='$authUser'";
			$res = $this->gm->execute_query($sql, "Unauthorized User");
			if($res['code'] == 200) {
				if ($res['data'][0]['User_token']==$authHeader) { return true; }
			}
			return false;
		}

		########################################
		# 	USER AUTHENTICATION RELATED METHODS
		########################################

		public function encrypt_password($pword) {
			$hashFormat="$2y$10$";
			$saltLength=22;
			$salt=$this->generate_salt($saltLength);
			return crypt($pword, $hashFormat.$salt);
		}

		protected function generate_salt($len) {
			$urs=md5(uniqid(mt_rand(), true));
			$b64String = base64_encode($urs);
			$mb64String = str_replace('+', '.', $b64String);
			return substr($mb64String, 0, $len);
		}

		public function pword_check($pword, $existingHash) {
			$hash=crypt($pword, $existingHash);
			if($hash===$existingHash) {
				return true;
			} 
			return false;
		}

		public function login($d){
			$un = $d->username;
			// $pw = $d->password;
			print_r($un);
			// $sql = "SELECT * FROM accounts_tbl WHERE username_fld = $un";
			// $res = $this->gm->execute_query($sql, 'Username or Password Incorrect');
			// if($res['200']){
			// 	$email = $res['0']['emailadd_fld'];
			// 	$password = $res['0']['emailadd_fld'];

			// 	if($this->pword_check())
			// }

		}
	}
	?>
