<?php
function connect($host, $db, $username, $pass){
    try {
        $Database = new PDO("mysql:host=$host;dbname=$db;charset=UTF8",$username, $pass);
        return $Database;
    }catch (PDOException $err){
        echo "Connect Error".$err->getMessage();
        die();
    }
}
function getDatas($sql, ...$params){
    if(arrayIsNull($params)){
        return false;
    }else{
        global $db;
        $query = $db->prepare($sql);
        $query->execute($params);
        $queryCount = $query->rowCount();
        $datas = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($queryCount > 0){
            return autoFetch($sql, $datas);
        }else{
            return false;
        }
    }
}
function getDatasNoAutoFetch($sql, ...$params){
    if(arrayIsNull($params)){
        return false;
    }else{
        global $db;
        $query = $db->prepare($sql);
        $query->execute($params);
        $queryCount = $query->rowCount();
        $datas = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($queryCount > 0){
            return $datas;
        }else{
            return false;
        }
    }
}
function autoFetch($sql, $arr){
    if (count($arr) == 1){
        if (strpos(strtolower($sql), 'limit 1')){
            if ((strpos(strtolower($sql), 'limit 1,')) or (strpos(strtolower(str_replace(" ", "", $sql)), 'limit1,'))){
                return $arr;
            }else{
                $limitOne = true;
                for ($x = 0; $x < 10; $x++) {
                    if (strpos(strtolower($sql), 'limit 1' . $x)){
                        $limitOne = false;
                    }
                }
                if($limitOne){
                    return $arr[0];
                }else{
                    return $arr;
                }
            }
        }else{
            return $arr;
        }
    }else{
        return $arr;
    }
}
function addData($table, $columns, ...$datas){
    if (arrayIsNull($datas)){
        return false;
    }else{
        global $db;
        $values = str_repeat("?,", substr_count($columns, ",")) . " ?";
        $query = $db->prepare("insert into ". $table ." (". security($columns) .") values (". $values .")");
        $query->execute($datas);
        $success = $query->rowCount();
        if ($success > 0){
            return true;
        }else{
            return false;
        }
    }
}
function addDataReturnAI($table, $columns, ...$datas){
    if (arrayIsNull($datas)){
        return false;
    }else{
        global $db;
        $values = str_repeat("?,", substr_count($columns, ",")) . "?";
        $query = $db->prepare("insert into ". $table ." (". security($columns) .") values (". $values .")");
        $query->execute($datas);
        $success = $query->rowCount();
        if ($success > 0){
            return $db->lastInsertId();
        }else{
            return false;
        }
    }
}
function deleteData($table, $id){
    if (!empty($id)){
        global $db;
        $query = $db->prepare("delete from ". $table ." where ". AutoIncrementColumn ." = ? limit 1");
        $query->execute([$id]);
        $success = $query->rowCount();
        if ($success > 0){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function editData($table, $columns, $id, ...$datas){
    if ((empty($id)) or (arrayIsNull($datas))){
        return false;
    }else{
        global $db;
        $columns = str_replace(",", "=?,", $columns). "=?";
        $query = $db->prepare("update ". $table ." set ". $columns ." where ". AutoIncrementColumn ." = ? limit 1");
        $datas[] = $id;
        $query->execute($datas);
        $success = $query->rowCount();
        if ($success > 0){
            return true;
        }else{
            return false;
        }
    }
}
function runSql($sql, ...$datas){
    global $db;
    $query = $db->prepare($sql);
    $query->execute($datas);
    $success = $query->rowCount();
    if ($success > 0){
        return true;
    }else{
        return false;
    }
}
function multiAdd($table, $columns, $datas){
    if (arrayIsNull($datas)){
        return false;
    }else{
        global $db;
        $values = "(".str_repeat("?,", substr_count($columns, ",")) . " ?),";
        $repeatCount = (count($datas) / (substr_count($values, "?")));
        $query = $db->prepare("insert into ". $table ." (". security($columns) .") values ". rtrim(str_repeat($values, $repeatCount), ","));
        $query->execute($datas);
        $success = $query->rowCount();
        if ($success > 0){
            return true;
        }else{
            return false;
        }
    }
}
?>