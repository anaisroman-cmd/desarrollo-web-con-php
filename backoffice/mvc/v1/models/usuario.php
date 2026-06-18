<?php

// DROP TABLE usuario; para eliminar la tabla.......

// CREATE TABLE usuario(
//    id INT PRIMARY KEY AUTO_INCREMENT,
//    firstname VARCHAR(30) NOT NULL,
//    lastname VARCHAR(30) NOT NULL,
//    username VARCHAR(50) NOT NULL UNIQUE,
//    password VARCHAR(32) NOT NULL,
//    rol INT NOT NULL,
//    datecrate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
//    dateupdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//    active BOOLEAN NOT NULL DEFAULT FALSE
//);

//INSERT INTO usuario(firstname, lastname, username, password, rol) VALUES ('Anaís', 'Román', 'anais.roman@mail.udp.cl', md5('holamundo'), 1);
//INSERT INTO usuario(firstname, lastname, username, password, rol) VALUES ('Ignacio', 'Espinoza', 'ignacio.espinoza@mail.udp.cl', md5('holamundo2'), 2);


//  CREATE TABLE usuario_codigo(
//    id INT PRIMARY KEY AUTO_INCREMENT,
//    usuarioID INT NOT NULL,
//    codigo VARCHAR(6) NOT NULL,
//	  datecrate TIMESTAMP NOT NULL,
//    active BOOLEAN NOT NULL DEFAULT TRUE,
//    CONSTRAINT fk_usucod_usu FOREIGN KEY (usuarioID) REFERENCES usuario(id)
//);

class Usuario
{
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $password;
    private $rol;
    private $datecreate;
    private $dateupdate;
    private $active;

    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->firstname;
    }
    public function getApellido()
    {
        return $this->lastname;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getRol()
    {
        return $this->rol;
    }
    public function getFechaCreado()
    {
        return $this->datecreate;
    }
    public function getFechaActualizado()
    {
        return $this->dateupdate;
    }
    public function isActive()
    {
        return $this->active;
    }

    public function setId($_n)
    {
        $this->id = $_n;
    }
    public function setNombre($_n)
    {
        $this->firstname = $_n;
    }
    public function setApellido($_n)
    {
        $this->lastname = $_n;
    }
    public function setUsername($_n)
    {
        $this->username = $_n;
    }
    public function setPassword($_n)
    {
        $this->password = md5($_n);
    }
    public function setRol($_n)
    {
        $this->rol = $_n;
    }
    public function setFechaCreado($_n)
    {
        $this->datecreate = $_n;
    }
    public function setFechaActualizado($_n)
    {
        $this->dateupdate = $_n;
    }
    public function setActive($_n)
    {
        $this->active = $_n;
    }

    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, firstname, lastname, username, password, rol, datecreate, dateupdate, active FROM usuario ORDER BY id ASC";
        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $objeto = new Usuario();
                $objeto->setId($registro['id']);
                $objeto->setNombre($registro['firstname']);
                $objeto->setApellido($registro['lastname']);
                $objeto->setUsername($registro['username']);
                $objeto->setRol($registro['rol']);
                $objeto->setFechaCreado($registro['datecreate']);
                $objeto->setFechaActualizado($registro['dateupdate']);
                $objeto->setActive($registro['active']);
                // $objeto = [
                //     "id" => $registro ['id'],
                //     "firstname" => $registro ['firstname'],                    
                // ];
                array_push($lista, $objeto);
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $lista;
    }

    public function addNew(Usuario $_nuevo)
    {
        $con = new Conexion();
        $conexionDB = $con->getConnection(); // Guardamos la conexión en una variable

        $var1 = $_nuevo->getNombre();
        $var2 = $_nuevo->getApellido();
        $var3 = $_nuevo->getUsername();
        $var4 = $_nuevo->getPassword();
        $var5 = $_nuevo->getRol();

        $sql = "INSERT INTO usuario(firstname, lastname, username, password, rol) VALUES (?, ?, ?, ?, ?)";

        // 1. Preparar la consulta
        $stmt = $conexionDB->prepare($sql);

        // DETECTOR 1: Si prepare() falla (ej: la tabla no existe o una columna se llama distinto)
        if (!$stmt) {
            die("<h2>Error SQL al preparar la consulta: " . $conexionDB->error . "</h2>");
        }

        // Vincular los parámetros (ssssi = 4 strings, 1 entero)
        $stmt->bind_param("ssssi", $var1, $var2, $var3, $var4, $var5);

        // 2. Ejecutar la consulta
        $rs = $stmt->execute();

        // DETECTOR 2: Si execute() falla (ej: el email ya existe y es UNIQUE)
        if (!$rs) {
            die("<h2>Error SQL al insertar los datos: " . $stmt->error . "</h2>");
        }

        $stmt->close();
        $con->closeConnection();

        return true;
    }

    public function powerON($_id)
    {
        $con = new Conexion();

        try {
            $query = "UPDATE usuario SET active = 1 WHERE id = ?";
            $stmt = $con->getConnection()->prepare($query);
            $stmt->bind_param("s", $_id);

            $rs = $stmt->execute();
            $stmt->close();
            $con->closeConnection();

            return $rs ? true : false;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }

    public function powerOFF($_id)
    {
        $con = new Conexion();

        try {
            $query = "UPDATE usuario SET active = 0 WHERE id = ?";
            $stmt = $con->getConnection()->prepare($query);
            $stmt->bind_param("s", $_id);

            $rs = $stmt->execute();
            $stmt->close();
            $con->closeConnection();

            return $rs ? true : false;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
}