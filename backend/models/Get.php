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
		accounts_tbl.username_fld,
		employees_tbl.fname_fld,
		employees_tbl.mname_fld,
		employees_tbl.lname_fld,
		schedules_tbl.id,
		schedules_tbl.accountId_fld,
		schedules_tbl.empId_fld,
		schedules_tbl.scheDate_fld,
		schedules_tbl.scheStatus_fld
		FROM schedules_tbl
		INNER JOIN accounts_tbl
			ON accounts_tbl.id =  schedules_tbl.accountId_fld
		INNER JOIN employees_tbl
			ON  employees_tbl.id =  schedules_tbl.empId_fld WHERE schedules_tbl.isDeleted_fld = '0'";

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
		$id = $d;
		$payload = [];
		$remarks = 'Success';
		$message = 'Successfully retrived schedule data';

		$sql = "SELECT
		accounts_tbl.username_fld,
		employees_tbl.fname_fld,
		employees_tbl.mname_fld,
		employees_tbl.lname_fld,
		schedules_tbl.id,
		schedules_tbl.accountId_fld,
		schedules_tbl.empId_fld,
		schedules_tbl.scheDate_fld,
		schedules_tbl.scheStatus_fld
		FROM schedules_tbl
		INNER JOIN accounts_tbl
			ON accounts_tbl.id =  schedules_tbl.accountId_fld
		INNER JOIN employees_tbl
			ON  employees_tbl.id =  schedules_tbl.empId_fld 
		WHERE schedules_tbl.accountId_fld = '$id' AND schedules_tbl.isDeleted_fld = '0'";
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
