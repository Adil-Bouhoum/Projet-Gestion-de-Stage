<?php

class major{

    public $id;
    public $majorName;
    private $tableName = "majors";

    public static function selectAllMajors($tableName, $conn) {
        $sql = "SELECT id, majorName FROM $tableName";
        $result = mysqli_query($conn, $sql);
        $table = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $table[] = $row;
            }
        }
        return $table;
    }


        static function selectMajorById($tableName,$conn,$id){
            //select a client by id, and return the row result
            $sql = "SELECT majorName FROM $tableName WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
        return $row;
        
        }}}

}

?>