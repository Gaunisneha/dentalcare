<?php 

class dataclass
{
    private $conn;

    public function __construct()
    {
        $this->conn=mysqli_connect('localhost','root','','dentcare');
    }
    public function getConnection(){
        return $this->conn;
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
    public function executeQuery($query) {
        return $this->conn->query($query);
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
    public function getrecord($query) {
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result); // Returns a single record
    }

//     function formvalidation()
//     {
//         $result=false;
//         if(lusername.innerHTML=="" && lpassword.innerHTML=="")
//         {   
//             $result=true;

//         }
//         return $result;
//     }
 




        function primarykey($query)
            {
                $tb=mysqli_query($this->conn,$query);
                $rw=mysqli_fetch_array($tb);
                $key=1;
                if($rw)
                {
                    $key=$rw[0]+1;
                }
                return $key;
            }
            function counter($query){
                $tb=mysqli_query($this->conn,$query);
                $rw=mysqli_fetch_array($tb);
                $count=$rw[0];
                return $count;
            }
        }
?>