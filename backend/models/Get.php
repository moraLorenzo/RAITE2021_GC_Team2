<?php
class Get
{
	protected $gm;

	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
		$this->gm = new GlobalMethods($pdo);
	}


	public function get_sched()
	{	
		$payload = [];
		$remarks = 'Success';
		$message = 'Successfully retrived schedule data';

		$sql = "SELECT * FROM schedules_tbl";
		$res = $this->gm->execute_query($sql, "No records found");

		if($res['code'] == 200){
			$payload = $res['data'];

		}else{
			$payload = null;
			$remakrs = "Failed";
			$message = $res['errmsg'];
		}

		return $this->gm->api_result($payload,$remarks,$message,$res['code']);
	}

	public function get_schedById($d)
	{
		$payload = [];
		$remarks = 'Success';
		$message = 'Successfully retrived schedule data';

		$sql = "SELECT * FROM schedules_tbl WHERE accountId_fld = $d->userId";
		$res = $this->gm->execute_query($sql, "No records found");
		
		if($res['code'] == 200){
			$payload = $res['data'];

		}else{
			$payload = null;
			$remakrs = "Failed";
			$message = $res['errmsg'];
		}

		return $this->gm->api_result($payload,$remarks,$message,$res['code']);
	}
}
