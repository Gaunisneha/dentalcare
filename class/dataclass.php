<?php 

class dataclass
{
    private $conn;

    public function __construct()
    {
        $this->conn=mysqli_connect('localhost','root','','dental_db');
    }
    public function gettable($query)
    {
        $tb=mysqli_query($this->conn,$query);
        return $tb;
    }
    public function getrow($query)
    {
        $tb=mysqli_query($this->conn,$query);
        $rw=mysqli_fetch_array($tb);
        return $rw;
    }

    public function insertrecord($query)
    {
        $result=mysqli_query($this->conn,$query);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updaterecord($query)
    {
        $result=mysqli_query($this->conn,$query);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleterecord($query)
    {
        $result=mysqli_query($this->conn,$query);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>