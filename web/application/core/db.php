<?
class Db
{
	protected $dbc;

	protected $result;

	function __construct(){

		$this->dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
		if ($this->dbc->connect_error) {
			die();
		}
		$this->dbc->set_charset('utf8');
		
	}

	public function makeQuery($query){

		$this->result = $this->dbc->query($query);

		if (!$this->result) {
			var_dump($query);
			die();
		}
		return (is_bool($this->result)) ? $this->result : Lib::mysqli_fetch_all_my($this->result);
	} 
	
	public function makeOnceQuery($query){

		$this->result = $this->dbc->query($query);

		if (!$this->result) {
//			var_dump($query);
			die();
		}
		return (is_bool($this->result)) ? $this->result : Lib::mysqli_fetch_all_my_one($this->result);
	} 
	public function insert_id(){
		
		return $this->dbc->insert_id;
	} 

	function __destruct(){
		$this->dbc->close();
	}
}

?>