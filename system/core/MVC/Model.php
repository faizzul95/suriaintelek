<?php

class Model
{
    public function __construct()
    {
        $currentClass = get_called_class();
        $this->db = db();
        $this->serversideDt = serverSideDT($this->db);
        $this->getInstanceDB = $this->db->getInstance();
    }

    // all() takes all data in a model. If no matching model exist, it returns null
    public static function all($condition = NULL)
    {
        $className = get_called_class();
        $obj = new $className;
        $db = db();

        if (!empty($condition)) {
            foreach ($condition as $con => $value) {
                $db->where($con, escape($value));
            }
        }

        $data = $db->get($obj->table);
        return (!empty($data)) ? $data : NULL;
    }

    // find($id) takes an id and returns a single model. If no matching model exist, it returns null
    public static function find($id = NULL, $columnName = NULL, $with = NULL)
    {
        $id = escape($id);

        $className = get_called_class();
        $obj = new $className;

        $columnName = (!empty($columnName)) ? escape($columnName) : $obj->primaryKey;

        $data = db()->where($columnName, $id)->fetchRow($obj->table);

        if (!empty($with)) {
            if (isset($obj->with)) {
                $data = (new self)->with($obj, $with, $data);
            }
        }

        return (!empty($data)) ? $data : NULL;
    }

    // findOrFail($id) takes an id and returns a single model. If no matching model exist, it throws an error1
    public static function findOrFail($id = NULL)
    {
        $id = escape($id);

        $className = get_called_class();
        $obj = new $className;

        try {
            $data = db()->where($obj->primaryKey, $id)->fetchRow($obj->table);
            if (empty($data)) {
                throw new Exception("Data $id not found.");
            }
        } catch (Exception $e) {
            $data = $e->getMessage();
        }

        return $data;
    }

    // where($conditions, $type) takes the condition (using AND method) and returns all/single data related in model
    public static function where($conditions = NULL, $type = 'get', $with = NULL)
    {
        $className = get_called_class();
        $obj = new $className;
        $db = db();

        if (!empty($conditions)) {
            foreach ($conditions as $con => $value) {
                $db->where($con, escape($value));
            }
        }

        $result = $db->$type($obj->table);

        if (!empty($with)) {
            if (isset($obj->with)) {
                $result = (new self)->with($obj, $with, $result, $type);
            }
        }

        return $result;
    }

    // orWhere($conditions, $type) takes the condition (using OR method) and returns all/single data related in model
    public static function orWhere($conditions = NULL, $type = 'get')
    {
        $className = get_called_class();
        $obj = new $className;
        $db = db();

        $count = 0;
        if (!empty($conditions)) {
            foreach ($conditions as $con => $value) {
                if ($count == 0) {
                    $db->where($con, escape($value));
                } else if ($count > 0) {
                    $db->orWhere($con, escape($value));
                }
                $count++;
            }
        }

        if ($type == 'get') {
            return $db->get($obj->table);
        } else {
            return $db->fetchRow($obj->table);
        }
    }

    // first() returns the first record found in the database. If no matching model exist, it returns null
    public static function first()
    {
        $className = get_called_class();
        $obj = new $className;
        $data = db()->rawQuery("SELECT * FROM $obj->table ORDER BY $obj->primaryKey ASC LIMIT 1");
        return (!empty($data)) ? $data : NULL;
    }

    // last() returns the last record found in the database. If no matching model exist, it returns null
    public static function last()
    {
        $className = get_called_class();
        $obj = new $className;
        $data = db()->rawQuery("SELECT * FROM $obj->table ORDER BY $obj->primaryKey DESC LIMIT 1");
        return (!empty($data)) ? $data : NULL;
    }

    public static function save($data = array())
    {
        $className = get_called_class();
        $obj = new $className;

        if (isset($obj->fillable)) {
            $id = (isset($data[$obj->primaryKey])) ? escape($data[$obj->primaryKey]) : NULL;
            $dataArr = array(); // reset array

            foreach ($obj->fillable as $columnName) {
                if (isset($data[$columnName])) {
                    $dataArr[$columnName] = escape($data[$columnName]);
                }
            }

            $dataArr[$obj->primaryKey] = $id; // add id PK

            $data = $dataArr;

            // validate data
            if (isset($obj->rules) && !empty($obj->rules)) {
                $validation = validator()->make($data, $obj->rules);
                if (isset($obj->messages) && !empty($obj->messages)) {
                    $validation->setAliases($obj->messages);
                }
                $validation->validate(); // validate input

                if ($validation->fails()) {
                    $errors = $validation->errors();
                    http_response_code(422);
                    return $errors->all(':message');
                }
            }
        }

        return save($obj->table, $data);
    }

    public static function insert($data = array())
    {
        $className = get_called_class();
        $obj = new $className;

        if (isset($obj->fillable)) {
            $dataInsert = array(); // reset array
            foreach ($obj->fillable as $columnName) {
                if (isset($data[$columnName])) {
                    $dataInsert[$columnName] = escape($data[$columnName]);
                }
            }

            // validate data
            if (isset($obj->rules) && !empty($obj->rules)) {
                $validation = validator()->make($dataInsert, $obj->rules);
                if (isset($obj->messages) && !empty($obj->messages)) {
                    $validation->setAliases($obj->messages);
                }
                $validation->validate(); // validate input

                if ($validation->fails()) {
                    $errors = $validation->errors();
                    http_response_code(422);
                    return $errors->all(':message');
                } else {
                    return insert($obj->table, $dataInsert, true);
                }
            } else {
                return insert($obj->table, $dataInsert, true);
            }

            exit();
        }

        return updateOrInsert($obj->table, $data);
    }

    public static function updateOrInsert($data = array())
    {
        $className = get_called_class();
        $obj = new $className;

        if (isset($obj->fillable)) {
            $id = (isset($data[$obj->primaryKey])) ? escape($data[$obj->primaryKey]) : NULL;
            $dataArr = array(); // reset array

            foreach ($obj->fillable as $columnName) {
                if (isset($data[$columnName])) {
                    $dataArr[$columnName] = escape($data[$columnName]);
                }
            }

            $dataArr[$obj->primaryKey] = $id; // add id PK

            $data = $dataArr;

            // validate data
            if (isset($obj->rules) && !empty($obj->rules)) {
                $validation = validator()->make($data, $obj->rules);
                if (isset($obj->messages) && !empty($obj->messages)) {
                    $validation->setAliases($obj->messages);
                }
                $validation->validate(); // validate input

                if ($validation->fails()) {
                    $errors = $validation->errors();
                    http_response_code(422);
                    return $errors->all(':message');
                }
            }
        }

        return updateOrInsert($obj->table, $data);
    }

    public static function update($data = array())
    {
        $className = get_called_class();
        $obj = new $className;

        if (isset($obj->fillable)) {
            $id = escape($data[$obj->primaryKey]);
            $dataUpdate = array(); // reset array
            foreach ($obj->fillable as $columnName) {
                if (isset($data[$columnName])) {
                    $dataUpdate[$columnName] = escape($data[$columnName]);
                }
            }
            $dataUpdate[$obj->primaryKey] = $id; // add id PK

            // validate data
            if (isset($obj->rules) && !empty($obj->rules)) {
                $validation = validator()->make($dataUpdate, $obj->rules);

                if (isset($obj->messages) && !empty($obj->messages)) {
                    $validation->setAliases($obj->messages);
                }

                $validation->validate(); // validate input

                if ($validation->fails()) {
                    $errors = $validation->errors();
                    http_response_code(422);
                    return $errors->all(':message');
                } else {
                    return update($obj->table, $dataUpdate, $id);
                }
            } else {
                return update($obj->table, $dataUpdate, $id);
            }

            exit();
        }

        return save($obj->table, $data);
    }

    public static function bulkData($data = array())
    {
        $className = get_called_class();
        $obj = new $className;
        return insertMulti($obj->table, $data);
    }

    public static function delete($id = NULL, $pkTable = NULL)
    {
        $id = escape($id);
        $className = get_called_class();
        $obj = new $className;
        return delete($obj->table, $id, $pkTable);
    }

    public static function bulkDeleteData($data = NULL, $pkTable = NULL)
    {
        $className = get_called_class();
        $obj = new $className;

        $countError = $countSuccess = 0;

        foreach ($data as $bulkData) {
            foreach ($bulkData as $id) {
                $delete = delete($obj->table, $id, $pkTable);
                ($delete == 200) ? $countSuccess++ : $countError++;
            }
        }

        return ($countError < 1) ? 200 : 400;
    }

    public static function countData($dataToCount = NULL, $columnToCount = NULL)
    {
        $className = get_called_class();
        $obj = new $className;
        return countValue($obj->table, $columnToCount, $dataToCount);
    }

    public static function countAllData($condition = NULL)
    {
        $className = get_called_class();
        $obj = new $className;
        return countAllData($obj->table, $condition);
    }

    public static function validate($data)
    {
        $className = get_called_class();
        $obj = new $className;

        if (isset($obj->rules) && !empty($obj->rules)) {
            $validation = validator()->make($data, $obj->rules);
            if (isset($obj->messages) && !empty($obj->messages)) {
                $validation->setAliases($obj->messages);
            }
            $validation->validate(); // validate input

            if ($validation->fails()) {
                $errors = $validation->errors();
                return json($errors->all(':message'));
                // $errors = $validation->errors();
                // echo "<pre>";
                // print_r($errors->firstOfAll());
                // echo "</pre>";
                // exit;
            } else {
                return true;
            }
        }

        return true;
    }

    public function with($obj, $with, $dataArr = NULL, $callType = 'fetchRow')
    {
        $dataRelation = $objStore = array(); // reset array

        if ($callType == 'get') {
            foreach ($dataArr as $key => $data) {
                foreach ($with as $functionName) {
                    if (in_array($functionName, $obj->with)) {
                        $functionCall = $functionName . 'Relation';

                        // check if function up is exist
                        if (method_exists($obj, $functionCall)) {
                            $dataRelation = $obj->$functionCall($data);
                            $dataStore = [
                                $functionName => [
                                    'data' => $dataRelation['data'],
                                    'objData' => $dataRelation['obj'],
                                ]
                            ];
                            array_push($objStore, $dataStore);
                            $dataArr[$key][$functionName] = $dataRelation['data'];
                        }
                    } else {

                        $withArr = explode(".", $functionName);

                        if (count($withArr) > 1) {
                            $previousArr = $withArr[count($withArr) - 2];
                            $functionReq = $withArr[count($withArr) - 1];

                            foreach ($objStore as $store) {
                                if (array_key_exists($previousArr, $store)) {
                                    $previousData = $store[$previousArr]['data'];
                                    $previousObj = $store[$previousArr]['objData'];
                                }
                            }

                            if (in_array($functionReq, $previousObj->with)) {
                                $functionCall = $functionReq . 'Relation';

                                foreach ($previousData as $key => $data) {
                                    // check if function up is exist
                                    if (method_exists($previousObj, $functionCall)) {

                                        if (isAssociative($previousData)) {
                                            $dataRelation = $previousObj->$functionCall($previousData);
                                        } else {
                                            $dataRelation = $previousObj->$functionCall($data[$key]);
                                        }

                                        $dataStore = [
                                            $functionReq => [
                                                'data' => $dataRelation['data'],
                                                'objData' => $dataRelation['obj'],
                                            ]
                                        ];

                                        array_push($objStore, $dataStore);

                                        if (isset($dataArr[$previousArr])) {
                                            if (isAssociative($dataArr[$previousArr])) {
                                                $dataArr[$previousArr][$functionReq] = $dataRelation['data'];
                                            } else {

                                                $dataArr[$previousArr][$key][$functionReq] = $dataRelation['data'];
                                            }
                                        } else {
                                            if (isAssociative($dataArr)) {
                                                $dataArr[$functionReq] = $dataRelation['data'];
                                            } else {
                                                foreach ($dataArr as $index => $data) {
                                                    $dataArr[$index][$previousArr][$functionReq] = $dataRelation['data'];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            foreach ($with as $functionName) {
                if (in_array($functionName, $obj->with)) {
                    $functionCall = $functionName . 'Relation';

                    // check if function up is exist
                    if (method_exists($obj, $functionCall)) {
                        $dataRelation = $obj->$functionCall($dataArr);
                        $dataStore = [
                            $functionName => [
                                'data' => (isset($dataRelation['data'])) ? $dataRelation['data'] : NULL,
                                'objData' => (isset($dataRelation['obj'])) ? $dataRelation['obj'] : NULL,
                            ]
                        ];
                        array_push($objStore, $dataStore);
                        $dataArr[$functionName] = (isset($dataRelation['data'])) ? $dataRelation['data'] : NULL;
                    }
                } else {
                    $withArr = explode(".", $functionName);

                    if (count($withArr) > 1) {
                        $previousArr = $withArr[count($withArr) - 2];
                        $functionReq = $withArr[count($withArr) - 1];

                        $previousData = $previousObj = array();

                        foreach ($objStore as $store) {
                            if (array_key_exists($previousArr, $store)) {
                                $previousData = $store[$previousArr]['data'];
                                $previousObj = $store[$previousArr]['objData'];
                            }
                        }

                        if (!empty($previousData)) {

                            if (in_array($functionReq, $previousObj->with)) {
                                $functionCall = $functionReq . 'Relation';

                                foreach ($previousData as $key => $data) {
                                    // check if function up is exist
                                    if (method_exists($previousObj, $functionCall)) {

                                        if (isAssociative($previousData)) {
                                            $dataRelation = $previousObj->$functionCall($previousData);
                                        } else {
                                            $dataRelation = $previousObj->$functionCall($previousData[$key]);
                                        }

                                        $dataStore = [
                                            $functionReq => [
                                                'data' => $dataRelation['data'],
                                                'objData' => $dataRelation['obj'],
                                            ]
                                        ];
                                        array_push($objStore, $dataStore);

                                        if (isAssociative($dataArr[$previousArr])) {
                                            $dataArr[$previousArr][$functionReq] = $dataRelation['data'];
                                        } else {
                                            $dataArr[$previousArr][$key][$functionReq] = $dataRelation['data'];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $dataArr;
    }
}
