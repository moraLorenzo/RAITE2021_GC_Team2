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

}
