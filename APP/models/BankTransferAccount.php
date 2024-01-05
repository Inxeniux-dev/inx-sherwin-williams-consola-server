<?php 

class BankTransferAccount {

    private $conexion;

    public function __construct()
    {
        $this->conexion = $GLOBALS["conexion"];
    }

    public function all()
    {
        $sql = "SELECT idcuenta, cuenta, banco FROM cuenta_bancaria_deposito;";
        return $this->conexion->query($sql);
    }


}


?>