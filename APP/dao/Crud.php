<?php

class Crud {

    private $conn;

    function __construct() {
        $this->conn = $GLOBALS["conexion"];
    }

    public function create($table_name, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table_name ($columns) VALUES ($values)";
        $this->conn->query($sql);
        return $this->conn->insert_id;
    }

    public function read($table_name, $conditions = array(), $order_by = null, $limit = null) {
        $sql = "SELECT * FROM $table_name";

        if (!empty($conditions)) {
            $sql .= " WHERE ";

            $i = 0;
            foreach ($conditions as $key => $value) {
                if ($i > 0) {
                    $sql .= " AND ";
                }
                $sql .= "$key = '$value'";
                $i++;
            }
        }

        if (!is_null($order_by)) {
            $sql .= " ORDER BY $order_by";
        }

        if (!is_null($limit)) {
            $sql .= " LIMIT $limit";
        }

        $result = $this->conn->query($sql);

        $data = array();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public function update($table_name, $id, $data) {
        $columns = array();

        foreach ($data as $key => $value) {
            $columns[] = "$key = '$value'";
        }

        $columns = implode(", ", $columns);

        $sql = "UPDATE $table_name SET $columns WHERE id = $id";

        $result = $this->conn->query($sql);

        return $result;
    }

    public function delete($table_name, $id) {
        $sql = "DELETE FROM $table_name WHERE id = $id";
        $result = $this->conn->query($sql);
        return $result;
    }

}