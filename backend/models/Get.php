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

		$sql = "SELECT
		accounts.username_fld,
		employees.fname_fld,
		employees.mname_fld,
		employees.lname_fld,
		FROM accounts_tbl
		FULL OUTER JOIN schedules_tbl
			ON schedules_tbl.accountId_fld = accounts_tbl.id
		FULL OUTER JOIN employees_tbl
			ON schedules_tbl.empId_fld =  employees_tbl.id";

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
		$id = $d->uId;
		$payload = [];
		$remarks = 'Success';
		$message = 'Successfully retrived schedule data';

		$sql = "SELECT * FROM schedules_tbl WHERE accountId_fld = '$id'";
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
