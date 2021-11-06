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

	// public function insert_sched($d){
	// 	$uId = $d->userId;
	// 	$empId = $d->employeeId;
	// 	$date = $d->date;
	// 	$status = $d->status;

	// 	$sql = "SELECT * schedules_tbl WHERE scheDate_fld = $date AND  accountId_fld = $uId"
	// }

}
