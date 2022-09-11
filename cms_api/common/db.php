<?php
class database_conn
{
 	private $_host;
	private $_username;
	private $_password;
	private $_database; 
	
	public function connection()
	{
		$this->_host='localhost';
		$this->_database='clientmanagement';
		$this->_username='root';
		$this->_password='';
		if (!isset($link)) 
		{
			$link = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
			if (!$link) {
				echo 'Cannot connect to database server';
				exit;
			}	
					
		}	
		return $link;
	}
}
?>