<?php 
namespace model;
use MySQLi;
/**
* 
*/
class MySQLiCore extends MySQLi {
	private $configmain = array('host' => "localhost", "login" => "root", "password"=> "1234", "database"=> "hosting");
	private $configloc = array('host' => "localhost", "login" => "root", "password"=> "", "database"=> "htcrm");
	protected $connect;
    private $pefix = PR_DB;
	public function __construct()
	{
		@$this->connect = new mysqli($this->configmain["host"], $this->configmain["login"], $this->configmain["password"], $this->configmain["database"]);
		if ($this->connect->connect_error) {
			$this->connect = new mysqli($this->configloc["host"], $this->configloc["login"], $this->configloc["password"], $this->configloc["database"]);
			if($this->connect->connect_error){
				die('Ошибка подключения (' . $this->connect->connect_errno . ') '. $this->connect->connect_error);
			}
		}
		$this->connect->set_charset("utf8");
	}
	public function esc($str){
		return $this->connect->real_escape_string($str);
	}
	public function base_exec($str){
		return $this->connect->query($str);
	}
	public function getID(){
		return $this->connect->insert_id();
	}
	public function __destruct(){
		// $this->connect->close();
	}

	/* Регистрация нового пользователя 
	*	Входящие данные массив
	*/
    public function RegistrationUser($data){

        $query = $this->base_exec("INSERT INTO `accounts` (`login`, `pass`) VALUES ('$email','$password')");
        // var_dump($query);
		if(!$query){
			return false;
		}
    }
	public function AuthUser($email, $password){
		$query = $this->base_exec("SELECT * FROM `accounts` WHERE `login` = '{$email}' AND `pass` = '{$password}' LIMIT 1");
		if($query->num_rows > 0){
			return $query->fetch_assoc();
		}else{
			return false;
		}
	}
	public function GetAllPersons($id_acc){
		$q = "SELECT * FROM `".PR_DB."person` WHERE id_acc = '{$id_acc}'";
		$query = $this->base_exec($q);
		if($query->num_rows > 0){
			return $query;
		}else{
	    		return false;
		}
	}
    public function GetOnlyOnePersons($id_acc,$id_person){
		$q = "SELECT * FROM `".PR_DB."person` WHERE id_acc = '{$id_acc}' AND `id` = '{$id_person}'";
		$query = $this->base_exec($q);
		if($query->num_rows > 0){
			return $query;
		}else{
	    		return false;
		}
	}
    public function AddNewPerson($id_acc,$firstname,$lastname,$title,$note,$email,$phone,$address,$PersonalNote,$interests,$periodicity){
         $dateadd = time();
        
          $query = $this->base_exec("INSERT INTO `".PR_DB."person`
                                                        (`id_acc`, `firstname`, `lastname`, `title`, `note`, `email`, `phone`, `address`, `PersonalNote`, `interests`, `dateadd`, `lastmessage`, `periodicity`) 
                                                    VALUES 
                                                    ('$id_acc','$firstname','$lastname','$title','$note','$email','$phone','$address','$PersonalNote','$interests','$dateadd','0','$periodicity')");
		if(!$query){
			return false;
		}
    }
    public function EditPerson($id,$id_acc,$firstname,$lastname,$title,$note,$email,$phone,$address,$PersonalNote,$interests,$periodicity){
        $query = $this->base_exec("UPDATE `".PR_DB."person` SET 
                                                            `firstname`='{$firstname}',
                                                            `lastname`='{$lastname}',
                                                            `title`='{$title}',
                                                            `note`='{$note}',
                                                            `email`='{$email}',
                                                            `phone`='{$phone}',
                                                            `address`='{$address}',
                                                            `PersonalNote`='{$PersonalNote}',
                                                            `interests`='{$interests}',
                                                            `periodicity`='{$periodicity}'
                                                                          WHERE `id`='{$id}' AND `id_acc`='{$id_acc}'");
        
        if(!$query){
			return false;
		}
    }
}
?>
