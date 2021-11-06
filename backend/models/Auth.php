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
			$pw = $d->password;
			// print_r($un);
			$sql = "SELECT * FROM accounts_tbl WHERE username_fld = '$un'LIMIT 1";
			$res = $this->gm->execute_query($sql, 'Username or Password Incorrect');

			if($res['code'] == 200){
				if($this->pword_check($pw,$res['data']['0']['password_fld'])){
					$id = $res['data']['0']['id'];
					$username = $res['data']['0']['username_fld'];
					$email = $res['data']['0']['emailadd_fld'];
					$role = $res['data']['0']['role_fld'];

					$tk = $this->generateToken($res['code'],$email, $username);
					// print_r($tk);
					$sql = "UPDATE accounts_tbl SET token_fld = '$tk' WHERE id = '$id'";
					
					$this->gm->execute_query($sql,'token updated');

					$payload = array("id"=> $id, "username"=> $username ,"email"=> $email, "token"=> $tk, "role"=> $role);
					$remarks = "Success";
					$message = "Login Successful";
					$code = 200;
					return $this->gm->api_result($payload,$remarks,$message,$code);
				}else{
					$remarks = "Failed";
					$message = "Wrong Password";
					$code = 404;
					return $this->gm->api_result("", $remarks,$message ,$code);
				}
			}else{
				$remarks = "Failed";
				$message = "Login failed";
				$code = 500;
				return $this->gm->api_result("", $remarks,$message ,$code);
			}

		}

		public function register($d){
			$un = $d->username;
			$em = $d->email;
			$pw = $d->password;
			$role = 1;

			$sql = "SELECT * FROM accounts_tbl WHERE emailadd_fld = '$em' LIMIT 1";
		
			if($result = $this->pdo->query($sql)->fetchAll()){
				$code = 400;
				$remarks = "Failed";
				$message = "Registration Failed";
				return $this->gm->api_result("",$remarks, $message, $code);
			
			}else{
				$sql = "INSERT INTO accounts_tbl (username_fld, emailadd_fld, password_fld, role_fld) VALUES (?, ?, ?, ?)";
				$sql= $this->pdo->prepare($sql);
				$sql->execute([
					$un,
					$em,
					$this->encrypt_password($pw),
					$role
				]);
			$code = 200;
			$remarks = "Success";
			$message = "Registration Successful";
			return $this->gm->api_result("",$remarks, $message, $code);
			}		
		}
	}
	?>
