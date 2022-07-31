<?php

date_default_timezone_set(TIMEZONE);

function db($db = NULL)
{
    if (empty($db)) {
        $db = new Database;
    } else {
        return Database::getInstance();
    }

    return $db;
}

function db_name($debug = false)
{
    if ($debug)
        dd(DB_NAME);
    else
        return DB_NAME;
}

function escape($str)
{
    return db()->escape_data(trim($str));
}

function insert($table, $data)
{
    $data['created_at'] = timestamp();
    $data = sanitizeInput($data);
    $id = db()->insert($table, $data);
    $resCode = ($id) ? 200 : 400;

    return [
        "resCode" => $resCode,
        "message" =>  message($resCode, 'added'),
        "id" => $id,
        "data" => $data
    ];
}

function update($table, $data, $pkValue, $pkTable = NULL)
{
    if (empty($pkTable)) {
        $getPKTable = rawQuery("SHOW KEYS FROM {$table} WHERE Key_name = 'PRIMARY'");
        $pkTable = $getPKTable[0]['Column_name'];
    }

    $data['updated_at'] = timestamp();
    $data = sanitizeInput($data);
    $resCode = (db()->where($pkTable, escape($pkValue))->update($table, $data)) ? 200 : 400;

    return [
        "resCode" => $resCode,
        "message" =>  message($resCode, 'update'),
        "id" => $pkValue,
        "data" => $data
    ];
}

function delete($table, $pkValue, $pkTable = NULL)
{
    if (empty($pkTable)) {
        $getPKTable = rawQuery("SHOW KEYS FROM {$table} WHERE Key_name = 'PRIMARY'");
        $pkTable = $getPKTable[0]['Column_name'];
    }

    $data = rawQuery("SELECT * FROM {$table} WHERE {$pkTable} = '{$pkValue}'");
    $resCode = (db()->where($pkTable, escape($pkValue))->delete($table)) ? 200 : 400;

    return [
        "resCode" => $resCode,
        "message" =>  message($resCode, 'delete'),
        "id" => $pkValue,
        "data" => $data
    ];
}

// The updateOrInsert method will attempt to locate a matching database record using the first argument's column and value pairs. If the record exists, it will be updated with the values in the second argument. If the record can not be found, a new record will be inserted with the merged attributes of both arguments
function updateOrInsert($table, $data = array(), $debug = false)
{
    $db =  db(); // initiate database
    $dataInsert = [];
    $pkValue = $pkColumnName = $id = NULL; // set to NULL

    // get primary key
    $getPKTable = primary_field($table, $debug);
    $pkTable = $getPKTable[0]['COLUMN_NAME'];

    // check if data is associative or sequential array
    if (isAssociative($data)) {
        if (isset($data[$pkTable])) {
            if (!empty($data[$pkTable])) {
                $db->where($pkTable, $data[$pkTable]); // get condition value from primary key
            } else {
                $db->where($pkTable, 0); // set to 0 
            }
        } else {
            $db->where(key($data), reset($data)); // get condition value from first key
        }
    } else {
        foreach ($data[0] as $key => $value) {
            $db->where("$key", "$value");
        }
    }

    $exist = $db->fetchRow($table);

    $dataInsert = (isAssociative($data)) ?  $data : ((!empty($exist)) ? $data[1] : merge($data[0], $data[1]));

    // remove all column field that does't exist in db
    foreach ($dataInsert as $key => $value) {
        if (!isColumnExist($table, $key)) {
            unset($dataInsert[$key]);
        }
    }

    if (isset($dataInsert[$pkTable])) {
        unset($dataInsert[$pkTable]); // auto increment, no need to update or insert
    }

    if (!empty($exist)) {
        $id = $exist[$pkTable]; // get pk from table
        return update($table, $dataInsert, $id, $pkTable);
    } else {
        return insert($table, $dataInsert);
    }
}

function save($table, $data)
{
    $db =  db(); // initiate database
    $dataInsert = [];
    $pkValue = $pkColumnName = NULL;

    // get primary key
    $getPKTable = primary_field($table);
    $pkColumnName = $getPKTable[0]['COLUMN_NAME'];

    // search if data exist using PK
    $db->where($pkColumnName, $data[$pkColumnName]);
    $exist = $db->fetchRow($table);

    $dataInsert = (isAssociative($data)) ?  $data : ((!empty($exist)) ? $data[1] : merge($data[0], $data[1]));

    // remove all column field that does't exist in db
    foreach ($dataInsert as $key => $value) {
        if (!isColumnExist($table, $key)) {
            unset($dataInsert[$key]);
        }
    }

    $pkValue = (isset($data[$pkColumnName])) ? $data[$pkColumnName] : NULL; //set pk value

    if (isset($dataInsert[$pkColumnName])) {
        unset($dataInsert[$pkColumnName]); // auto increment, no need to update or insert
    }

    if (!empty($exist)) {
        $id = $exist[$pkColumnName]; // get pk from table
        return update($table, $dataInsert, $id, $pkColumnName);
    } else {
        return insert($table, $dataInsert);
    }
}

function rawQuery($query)
{
    return db()->rawQuery($query);
}

function countValue($table, $columnToCount, $dataToCount)
{
    $db = db(); // initiate database
    $db->where($columnToCount, $dataToCount);
    return $db->getValue($table, "count(*)");
}

function countAllData($table, $condition = NULL)
{
    $db = db(); // initiate database
    if (!empty($condition)) {
        foreach ($condition as $columnToCount => $dataToCount) {
            $db->where($columnToCount, $dataToCount);
        }
    }
    return $db->getValue($table, "count(*)");
}

function insertMulti($table, $data)
{
    $ids = db()->insertMulti($table, $data);
    $resCode = ($ids) ? 200 : 400;

    return [
        "resCode" => $resCode,
        "message" =>  message($resCode, 'insert'),
        "id" => $ids,
        "data" => $data
    ];
}

function updateMulti($table, $data)
{
    $ids = db()->updateMulti($table, $data);
    $resCode = ($ids) ? 200 : 400;

    return [
        "resCode" => $resCode,
        "message" =>  message($resCode, 'update'),
        "id" => $ids,
        "data" => $data
    ];
}

function table_list()
{
    $dbName = db_name();
    return rawQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$dbName'");
}

function primary_field($table, $debug = false)
{
    $dbName = db_name($debug);
    return rawQuery("SELECT COLUMN_NAME, COLUMN_KEY, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
}

function not_primary_field($table, $debug = false)
{
    $dbName = db_name($debug);
    $data = rawQuery("SELECT COLUMN_NAME, COLUMN_KEY, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");

    foreach ($data as $row) {
        $fields[] = array('column_name' => $row['COLUMN_NAME'], 'column_key' => $row['COLUMN_KEY'], 'data_type' => $row['DATA_TYPE']);
    }

    return $fields;
}

function all_field($table, $debug = false)
{
    $dbName = db_name($debug);
    $data = rawQuery("SELECT COLUMN_NAME, COLUMN_KEY, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table'");

    foreach ($data as $row) {
        $fields[] = array('column_name' => $row['COLUMN_NAME'], 'column_key' => $row['COLUMN_KEY'], 'data_type' => $row['DATA_TYPE']);
    }

    return $fields;
}

function enum_field($table, $columnName)
{
    $dbName = db_name();
    $data = rawQuery("SELECT
              TRIM(TRAILING ')' FROM TRIM(LEADING '(' FROM TRIM(LEADING 'enum' FROM column_type))) column_type
            FROM
              information_schema.columns
            WHERE
              TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table' AND column_name = '$columnName'");

    return explodeArr($data[0]['column_type']);
}

function sanitizeInput($dataArr)
{
    $sanitize = [];

    if (isAssociative($dataArr)) {
        foreach ($dataArr as $key => $value) {
            // check if empty field
            if ($value == '') {
                $sanitize[$key] = NULL;
            } else {
                $sanitize[$key] = (!isJson($value)) ? escape($value) : $value;
            }
        }
    } else {
        foreach ($dataArr[0] as $key => $value) {
            // check if empty field
            if ($value == '') {
                $sanitize[$key] = NULL;
            } else {
                $sanitize[$key] = (!isJson($value)) ? escape($value) : $value;
            }
        }
    }

    return $sanitize;
}

function isTableExist($table)
{
    $dbName = db_name();
    $result = rawQuery("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table'");

    if (empty($result))
        return false;
    else
        return true;
}

function isColumnExist($table, $columnName)
{
    $dbName = db_name();

    // check table
    if (isTableExist($table)) {
        $result = rawQuery("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME='$table' AND COLUMN_NAME='$columnName'");
    }

    if (empty($result))
        return false;
    else
        return true;
}

function hasMany($modelRef, $columnRef, $condition, $option = NULL)
{
    $dbName = db_name();
    $result = $obj = $tableRef = '';

    if (!empty($condition)) {
        $fileName = "../app/models/" . $modelRef . ".php";
        if (file_exists($fileName)) {

            $className = getClassNameFromFile($fileName);
            $obj = new $className;

            $tableRef = $obj->table;
            $tableRefPK = $obj->primaryKey;

            // check table
            if (isTableExist($tableRef)) {

                $whereCon = NULL;
                if (!empty($option)) {
                    foreach ($option as $key => $value) {
                        $whereCon .= "AND {$key}='$value'";
                    }
                }

                $result = rawQuery("SELECT * FROM $tableRef WHERE {$columnRef}='$condition' $whereCon");
            }
        }
    }

    $data = [
        'obj' => $obj,
        'table' => $tableRef,
        'column' => $columnRef,
        'id' => $condition,
        'data' => $result,
    ];

    return $data;
}

function hasOne($modelRef, $columnRef, $condition, $option = NULL)
{
    $dbName = db_name();
    $result = $obj = $tableRef = '';

    if (!empty($condition)) {
        $fileName = "../app/models/" . $modelRef . ".php";
        if (file_exists($fileName)) {
            $className = getClassNameFromFile($fileName);
            $obj = new $className;

            $tableRef = $obj->table;
            $tableRefPK = $obj->primaryKey;

            // check table
            if (isTableExist($tableRef)) {

                $whereCon = NULL;
                if (!empty($option)) {
                    foreach ($option as $key => $value) {
                        $whereCon .= "AND {$key}='$value'";
                    }
                }

                $result = rawQuery("SELECT * FROM $tableRef WHERE {$columnRef}='$condition' $whereCon LIMIT 1");
            }
        }
    }

    $data = [
        'obj' => $obj,
        'table' => $tableRef,
        'column' => $columnRef,
        'id' => $condition,
        'data' => (!empty($result)) ? $result[0] : NULL,
    ];

    return $data;
}
