<?php
    namespace Hcode\DB;

    class Sql {
        // Parâmetros de conexão com o banco
        const HOSTNAME = "localhost";
        const USERNAME = "root";
        const PASSWORD = "";
        const DBNAME = "db_ecommerce";

        private $conn;

        public function __construct()
        {
            $this->conn = new \PDO(
                "mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME,
                Sql::USERNAME,
                Sql::PASSWORD
            );
        }

        private function setParams($statement, $parameters = array())
        {
            foreach ($parameters as $key => $value)
                {
                    $this->bindParam($statement, $key, $value);
                }
        }

        private function bindParam($statement, $key, $value)
        {
            $statement->bindParam($key, $value);
        }

        // Método que executa a query
        public function query($rawQuery, $params = array())
        {
            $stmt = $this->conn->prepare($rawQuery);
            $this->setParams($stmt, $params);
            $stmt->execute();
        }

        // Método Select
        public function select($rawQuery, $params = array()):array
        {
            $stmt = $this->conn->prepare($rawQuery);
            $this->setParams($stmt, $params);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>