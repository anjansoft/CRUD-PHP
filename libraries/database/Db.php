<?php
Class _Db{
	private $user;
	private $pass;
	private $host;
	private $dbnm;
	private $cn;
	private $mysql_result;
	
	public function __construct()
	{
		$this->user = DB_USER;
		$this->pass = DB_PASS;
		$this->host = DB_HOST;
		$this->dbnm = DB_NAME;		
	}

	public function connect(){ 
		$this->cn = mysqli_connect( $this->host, $this->user, $this->pass,$this->dbnm ) or die('error connection'); 
	}
	
	public function query( $str , $assoc_type = 'assoc' ){
		$this->connect();
		if( strpos(strtolower($str), 'select') === 0 ){
		
		$this->mysqli_free_result = mysqli_query($this->cn, $str );
			if ( $this->mysqli_free_result && mysqli_connect_error() == '' ){
					switch ( $assoc_type )
					{
						case 'assoc':
							while( $row= mysqli_fetch_assoc( $this->mysqli_free_result ) ) {
								$result[] =  $row;
							}
						break;
						
						case 'fetch_row':
							$result = mysqli_fetch_row( $this->mysqli_free_result );
						break;
					}
			}else{
				return mysqli_connect_error();
			}
		}else{
			mysqli_query( $str );
		}
		if ( isset($result) ) return $result;		
	}
	
	public function insert( $table, $values ) {
		$fields = implode(",", array_keys($values) );
		$val = implode("," , array_values($values) ); 		
		//echo "INSERT INTO ".$table. "(".$fields.") VALUES (".$val .")"; die;
		$this->query("INSERT INTO ".$table. "(".$fields.") VALUES (".$val .")");
	}
	 
	public function delete( $table, $where = null ){
		$this->query("DELETE FROM {$table} {$where}");
	}

	public function fetch_all_rows( $sql, $assoc_type = 'assoc' ){
		return $this->query($sql, $assoc_type);
	}
}
?>