<?php

$servername = "127.0.0.1";
$username = "root";
$password = "root";

$conn = mysqli_connect($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

class calculation {
    private $result;
    
    public function multiply($a, $b) {
        $this->result = $a * $b;
    }
    
    public function multiplyByTwo() {
        $this->result *= 2;
    }

    public function getResult() {
        return $this->result;
    }
}

$multiplier = new calculation();
$multiplier->multiply(3, 4); 
$multiplier->multiplyByTwo(); 
echo $multiplier->getResult();
?>