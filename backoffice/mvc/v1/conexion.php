<?php


if(!isset($_SESSION['user_id'])){
    //si no hay SESSION es pq no hay usuario
    header("Location: ../../../");
    exit();
}
class Conexion
{
    private $connection;
    private $host;
    private $username;
    private $password;
    private $bd;
    private $port;
    private $server;

    public function __construct()
    {
        $this->connection = null;
        $this->server = $_SERVER['SERVER_NAME'];
        $this->host = '127.0.0.1';
        $this->port = '3306';
        $this->bd = 'coningen_funev1';
        $this->username = 'coningen_funev1';
        $this->password = 'h0l4.mund0.2026';
    }

    public function getConnection()
    {
        try {
            $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->bd, $this->port);
            mysqli_set_charset($this->connection, "utf8");
            if (!$this->connection) {
                throw new Exception("Error de conexión: " . mysqli_connect_error());
            }
            return $this->connection;
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            die("Error al conectar a la base de datos. Por favor, inténtelo de nuevo más tarde.");
        }
    }

    public function closeConnection()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
            return 1;
        }
        return 0;
    }

}

?>