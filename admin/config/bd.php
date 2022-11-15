<?PHP 

class Conexion
{
    private $servidor="localhost";
    private $user="root";
    private $password="";
    private $db="albun";
    private $con;

    public function __construct()
    {
        try 
        {
            $this->con= new PDO("mysql:host=$this->servidor;dbname=$this->db",$this->user,$this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
         catch (PDOException $e) 
        {
            return "falla de coneccion".$e;
        }
    }

    public function ejecutar($sql){ //delete-update-insert
        $this->con->exec($sql);
        return $this->con->lastInsertId();
    }

    public function consultar($sql){
        $sentencia=$this->con->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
    public function consultarid($sql){
        $sentencia=$this->con->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetch(PDO::FETCH_LAZY);
    }

}

?>