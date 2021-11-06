<?php


class Post
{
	protected $gm;
	protected $pdo;
	protected $get;
	protected $auth;


	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
		$this->gm = new GlobalMethods($pdo);
		$this->get = new Get($pdo);
		$this->auth = new Auth($pdo);
	}

	public function insert_sched($d){
		$uId = $d->userId;
		$empId = $d->employeeId;
		$date = $d->date;
		$status = $d->status;

		$sql = "SELECT * FROM schedules_tbl WHERE accountId_fld = '$uId' AND (scheStatus_fld = '$status' OR scheDate_fld = '$date')";

		if($result = $this->pdo->query($sql)->fetchAll()){
			$code = 400;
			$remarks = "Failed";
			$message = "Scheduling Failed";
			return $this->gm->api_result("",$remarks, $message, $code);
		
		}else{
			$sql = "INSERT INTO schedules_tbl (accountId_fld, empId_fld, scheDate_fld, scheStatus_fld) VALUES (?, ?, ?, ?)";
			$sql= $this->pdo->prepare($sql);
			$sql->execute([
				$uId,
				$empId,
				$date,
				$status
			]);
		$code = 200;
		$remarks = "Success";
		$message = "Scheduling Successful";
		return $this->get->get_schedById($uId);
		}		
	}


	public function update_sched($d){
		
		$id = $d->id;
		
		$status = $d->status;
		$sql = "SELECT * FROM schedules_tbl WHERE id = '$id' AND scheStatus_fld = '$status' ";

		if($result = $this->pdo->query($sql)->fetchAll()){
			$code = 400;
			$remarks = "Failed";
			$message = "Updating Schedule Failed";
			return $this->gm->api_result("",$remarks, $message, $code);
		
		}else{
			
			$sql = "UPDATE schedules_tbl SET scheStatus_fld = ? WHERE id =  ? ";
			$sql= $this->pdo->prepare($sql);
			$sql->execute([
				$status,
				$id
			]);
			return $this->get->get_sched();;
		}
	}

	public function delete_sched($d){

		$uId = $d->uId;
		$isDeleted = 1;
		$sql = "SELECT * FROM schedules_tbl WHERE accountId_fld = '$uId' AND isDeleted_fld = '1'";

		if($result = $this->pdo->query($sql)->fetchAll()){
			$code = 400;
			$remarks = "Failed";
			$message = "Deleting Schedule Failed";
			return $this->gm->api_result("",$remarks, $message, $code);
		
		}else{
			
			$sql = "UPDATE schedules_tbl SET isDeleted_fld = ? WHERE accountId_fld =  ? ";
			$sql= $this->pdo->prepare($sql);
			$sql->execute([
				$isDeleted,
				$uId
			]);
			$code = 200;
			$remarks = "Success";
			$message = "Deleting Scheduling Success";
			return $this->gm->api_result("",$remarks, $message, $code);
		}
	}
}
