<?php
    class database{
        private $host_name = "localhost";
        private $user_name = "root";
        private $password = "nitesh123";
        private $db_name = "student_management_system";
        private $conn = false;
        private $mysqli = "";
        private $result = array();

        //  Function for stablish connection
        public function __construct(){
            if(!$this->conn){
                $this->mysqli = new mysqli($this->host_name, $this->user_name, $this->password, $this->db_name);
                $this->conn = true;

                if($this->mysqli->connect_error){
                    array_push($this->result, $this->mysqli->connect_error);
                    return false;
                }
            }else{
                return true;
            }
        }

        //  function to insert signin form data in database
        public function registeration($table, $params = array()){
            if($this->tableExit($table)){
                $first_name = $params['fname'];
                $last_name = $params['lname'];
                $email = $params['email'];
                $phone = $params['phone'];
                $password = password_hash($params['password'],PASSWORD_DEFAULT);
                $type = $params['typeuser'];
                if($params['image'] != 0){
                    $image = $params['image'];
                }else{
                    $image = "";
                }                

                $sql = "SELECT email FROM users WHERE email='$email'";
                
                $stmt = $this->mysqli->query($sql);
                
                $count = $stmt->num_rows;

                if($count > 0){
                    return 0;
                }else{
                    $sql = "INSERT INTO $table (first_name, last_name, email,password, phone, type_user, image) VALUES ('$first_name', '$last_name', '$email','$password','$phone', $type, '$image')";
                    
                    $stmt = $this->mysqli->query($sql);

                    if($stmt){
                        return 1;
                    }else{
                        return 0;
                    }   
                }                
            }else{
                return false;
            }
        }

        //  function for select user type
        public function select($table, $row = '*', $join = null, $where = null){
            if($this->tableExit($table)){
                $sql = "SELECT $row FROM $table ";

                if($join != NULL){
                    $sql .= " JOIN $join";
                }
                if($where != NULL){
                    $sql .= " WHERE $where";
                }
                $query = $this->mysqli->query($sql);
                if($query){
                    $this->result = $query->fetch_all(MYSQLI_ASSOC);
                    return true;
                }else{
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }
            }else{  
                return false;
            }
        }

        //  function for get result
        public function getResult(){
            $value = $this->result;
            $this->result = array();
            return $value;
        }

        //  function to check table exists or not
        public function tableExit($table){
            $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";

            $tableInDb = $this->mysqli->query($sql);
            if($tableInDb){
                if($tableInDb->num_rows == 1){
                    return true;
                }
            }else{
                array_push($this->result, $table . " does not exist in this database");
                return false;
            }
        }
        // Upload images
        public function uploadPhoto($file){
            if(!empty($file)){
                $fileTempPath = $file['tmp_name'];
                $fileName = $file['name'];
                $fileSize = $file['size'];
                $fileType = $file['type'];

                $fileNameCmps = explode('.',$fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // New File Name 
                $newFileName = md5(time().$fileName).'.'.$fileExtension;

                $allowedExtensions = ["jpg","jpeg", "png", "gif"];

                if(in_array($fileExtension, $allowedExtensions)){
                    $uploadFileDir = getcwd().'/images/';
                    $destFilePath = $uploadFileDir.$newFileName;
                    if(move_uploaded_file($fileTempPath, $destFilePath)){
                        return $newFileName;
                    }else{
                        return 0;
                    }
                }else{
                    return 0;
                }
            }
        }
        // validation for login page
        public function login($username, $pass, $typeuser, $action){
            $sql = "SELECT * FROM login WHERE email='$username' AND type_user=$typeuser";

            $stmt = $this->mysqli->query($sql);

            if($stmt){
                if($stmt->num_rows == 1){
                    $row = $stmt->fetch_all(MYSQLI_ASSOC);
                    if(password_verify($pass, $row[0]['password'])){
                        array_push($this->result, $row[0]['email']);
                        array_push($this->result, $row[0]['type_user']);
                        array_push($this->result, $row[0]['id']);
                        array_push($this->result, $action);
                        $data = $this->getResult();
                        $this->loginActivity($data);
                        return true;
                    }else{
                        return 0;
                    }
                }
                else{
                    return 0;
                }
            }else{
                return 0;
            }
        }

        public function active_user($username){
            $sql = "SELECT first_name, last_name, image FROM users WHERE email='$username';";
            
            $stmt = $this->mysqli->query($sql);

            if($stmt){
                if($stmt->num_rows == 1){
                    $row = $stmt->fetch_all(MYSQLI_ASSOC);
                    array_push($this->result, $row[0]['first_name']." ".$row[0]['last_name']);
                    array_push($this->result, $row[0]['image']);
                    return true;
                }else{
                    echo 0;
                }
            }
        }

        // Login Activity
        public function loginActivity($data){
            $username = $data[0];
            $type_user = $data[1];
            $id = $data[2];
            $action = $data[3];

            $sql = "INSERT INTO activity_log(user_id,action,type_user) VALUES($id, '$action', $type_user)";

            $stmt = $this->mysqli->query($sql);

            if($stmt){
                array_push($this->result, $username);
                array_push($this->result, $type_user);
            }
        }
        // Logout Activity
        public function logoutActivity($username, $type_user){
            $sql = "SELECT id FROM login WHERE email = '$username' AND type_user = $type_user";
            $stmt = $this->mysqli->query($sql); 
            $row = $stmt->fetch_all(MYSQLI_ASSOC);
            $id = $row[0]['id'];
            
            $sql = "INSERT INTO activity_log(user_id,action,type_user) VALUES($id, 'Logout', $type_user)";
            
            $stmt = $this->mysqli->query($sql);

            if($stmt){
                return true;
            }
        }
        // Activity Log View 
        public function viewActivity($type_user){
            $sql = "SELECT action, created_at FROM activity_log WHERE type_user = '$type_user' ORDER BY id DESC LIMIT 0, 5;";
            
            $stmt = $this->mysqli->query($sql);

            if($stmt){
                $row = $stmt->fetch_all(MYSQLI_ASSOC);
                $sn = 0;
                foreach ($row as $value1) {
                    array_push($this->result, $value1);
                    array_push($this->result[$sn], ++$sn);
                }
            }
        }
        // View Pending User
        public function pendingUser($type_user){
            $sql = "SELECT first_name, last_name, email, phone, image FROM users WHERE type_user = '$type_user' AND status = 'Pending'";
            
            $stmt = $this->mysqli->query($sql);

            if($stmt){
                if($stmt->num_rows > 0){
                    $this->result = $stmt->fetch_all(MYSQLI_ASSOC);
                    return true;
                }else{
                    $this->result = 0;
                    return true;
                }
                
            }
        }
        // View Rejected User
        public function rejectedUser($type_user){
            $sql = "SELECT first_name, last_name, email, phone, image FROM users WHERE type_user = '$type_user' AND status = 'Reject'";

            $stmt = $this->mysqli->query($sql);

            if($stmt){
                if($stmt->num_rows > 0){
                    $this->result = $stmt->fetch_all(MYSQLI_ASSOC);
                    return true;
                }else{
                    $this->result = 0;
                    return true;
                }
                
            }
        }
        // View Approved User
        public function approvedUser($type_user){
            $sql = "SELECT first_name, last_name, email, phone, image FROM users WHERE type_user = '$type_user' AND status = 'Approve'";
            $stmt = $this->mysqli->query($sql);

            if($stmt){
                if($stmt->num_rows > 0){
                    $this->result = $stmt->fetch_all(MYSQLI_ASSOC);
                    return true;
                }else{
                    $this->result = 0;
                    return true;
                }
                
            }
        }
        public function fetchRecordUpadte($email, $type_user){
            $sql = "SELECT first_name, last_name, email, phone, image FROM users WHERE email='$email' AND type_user = $type_user";

            $stmt = $this->mysqli->query($sql);
            
            $this->result = $stmt->fetch_all(MYSQLI_ASSOC);
            return true;
        }
        // Approve Specific User
        public function approve($email, $type){
            $sql = "SELECT id, email, password, type_user FROM users WHERE email='$email'";
            
            $stmt = $this->mysqli->query($sql);

            if($stmt){
                $data = $stmt->fetch_all(MYSQLI_ASSOC);
                $id = $data[0]['id'];
                $email = $data[0]['email'];
                $password = $data[0]['password'];
                $type_user = $data[0]['type_user'];
                $sql = "UPDATE users SET status ='Approve' WHERE email='$email'";
                $stmt = $this->mysqli->query($sql);
                if($stmt){
                    $sql = "INSERT INTO login(email, password, type_user) VALUES('$email','$password','$type_user')"; 
                    $stmt = $this->mysqli->query($sql);
                    if($stmt){
                        $sql = "INSERT INTO activity_log(user_id,action,type_user) VALUES($id, 'Approve', $type)";
                        $stmt = $this->mysqli->query($sql);
                        return 1;
                    }else{
                        return 0;
                    }
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
        }
        // Reject Specific User
        public function reject($email,$type_user){
            $sql = "UPDATE users SET status ='Reject' WHERE email='$email'";
            
            $stmt = $this->mysqli->query($sql);
            if($stmt){
                $sql = "DELETE FROM login WHERE email = '$email'";
                $stmt = $this->mysqli->query($sql);
                if($stmt){
                    $sql = "SELECT id FROM users WHERE email='$email'";
                    $stmt = $this->mysqli->query($sql);
                    $data = $stmt->fetch_all(MYSQLI_ASSOC);
                    $id = $data[0]['id'];
                    $sql = "INSERT INTO activity_log(user_id,action,type_user) VALUES($id, 'Reject', $type_user)";
                    $stmt = $this->mysqli->query($sql);
                    return 1;
                }
            }else{
                return 0;
            }
        }
        // Update Specific User
        public function updateRecord($data = array()){
            $fname = $data['fname'];
            $lname = $data['lname'];
            $email = $data['email'];
            $phone = $data['phone'];
            $image = $data['image'];
            $type_user = $data['type_user'];
            $update_at = date('Y-m-d H:i:s');

            if(empty($image)){
                $sql = "UPDATE users SET first_name ='$fname', last_name = '$lname', phone = '$phone', updated_at='$update_at' WHERE email = '$email'";
            }else{
                $sql = "UPDATE users SET first_name ='$fname', last_name = '$lname', phone='$phone', image='$image', updated_at='$update_at' WHERE email = '$email'";
            }
            
            $stmt = $this->mysqli->query($sql);
            if($stmt){
                $sql = "SELECT id FROM users WHERE email='$email'";
                $stmt = $this->mysqli->query($sql);
                $data = $stmt->fetch_all(MYSQLI_ASSOC);
                $id = $data[0]['id'];
                $sql = "INSERT INTO activity_log(user_id,action,type_user) VALUES($id, 'Update', $type_user)";
                $stmt = $this->mysqli->query($sql);
                return 1;
            }else{
                return 0;
            }
        }
        // Delete Specific User
        public function deleteRecord($email, $type_user){
            $sql = "SELECT id FROM users WHERE email='$email'";
            $stmt = $this->mysqli->query($sql);
            $data = $stmt->fetch_all(MYSQLI_ASSOC);
            $id = $data[0]['id'];
            
            $sql = "DELETE FROM login WHERE email='$email'";
            $stmt = $this->mysqli->query($sql);

            if($stmt){
                $sql = "DELETE FROM activity_log WHERE user_id='$id'";
                $stmt = $this->mysqli->query($sql);
                if($stmt){
                    $sql = "DELETE FROM users WHERE email='$email'";
                    $stmt = $this->mysqli->query($sql);
                    if($stmt){
                        $this->loginActivity([$email,$id,"4","Delete"]);
                        return 1;
                    }else{
                        return 0;
                    } 
                }else{
                    return 0;
                }
            }else{
                return 0;
            }
            
        }
        //  Function to update profile in database
        public function update($table, $row = null, $where = null){
            if($this->tableExit($table)){
                $update_at = date('Y-m-d H:i:s');
                $sql = "UPDATE $table SET $row, updated_at='$update_at'";
                if($where != null){
                    $sql .= " WHERE $where";
                }
                if($this->mysqli->query($sql)){
                    array_push($this->result, $this->mysqli->affected_rows);
                    return true;
                }else{
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }
            }else{
                return false;
            }
        }
        //  function for activity log
        public function activitys($table, $params= array()){
            if($this->tableExit($table)){
                $user_id = $params['user_id'];
                $action = $params['action'];
                $type_user = $params['type_user'];

                $sql = "INSERT INTO $table (user_id, action, type_user) VALUES ('$user_id', '$action', $type_user)";
                if($this->mysqli->query($sql)){
                    return true;
                }else{
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }
            }else{
                return false;
            }
        }
        //  function for select user type
        public function selects($table, $row = '*', $join = null, $where = null, $order = null, $limit = null){
            if($this->tableExit($table)){
                $sql = "SELECT $row FROM $table ";
                if($join != NULL){
                    $sql .= " JOIN $join";
                }
                if($where != NULL){
                    $sql .= " WHERE $where";
                }
                if($order != NULL){
                    $sql .= " ORDER BY $order";
                }
                if($limit != NULL){
                    $sql .= " LIMIT $limit";
                }
                // array_push($this->result, $sql);
                $query = $this->mysqli->query($sql);
                if($query){
                    $this->result = $query->fetch_all(MYSQLI_ASSOC);
                    return true;
                }else{
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }
            }else{  
                return false;
            }
        }

        // function for forget password
        public function validPassword($table, $password, $where = null){
            if($this->tableExit($table)){
                $sql = "SELECT password FROM $table";
                if($where != null){
                    $sql .= " WHERE $where";
                }
                $query = $this->mysqli->query($sql);
                if($query){
                    if($query->num_rows == 1){
                        $result1 = $query->fetch_all(MYSQLI_ASSOC);
                        if(password_verify($password, $result1[0]['password'])){
                            array_push($this->result, 1);
                            return true;
                        }else{
                            array_push($this->result, 0);
                            return false;
                        }
                    }else{
                        array_push($this->result, 0);
                        return false;
                    }
                }else{
                    array_push($this->result, $query->error);
                    return false;
                }
            }
        }
        public function validEmail($table, $row, $where){
            if($this->tableExit($table)){
                $sql = "SELECT $row FROM $table WHERE $where";
                $stmt = $this->mysqli->query($sql);
                if($stmt){
                    if($this->mysqli->affected_rows == 1){
                        $id = rand(1000,9999);
                        $sql = "UPDATE login SET reset_code = '$id' WHERE $where";
                        $stmt = $this->mysqli->query($sql);
                        array_push($this->result, $id);
                        $sql = "SELECT email, first_name, last_name FROM users WHERE $where";
                        $stmt = $this->mysqli->query($sql);
                        $result = $stmt->fetch_all(MYSQLI_ASSOC);
                        foreach ($result as $key => $value) {
                            array_push($this->result, $value);
                        }
                        return true;
                    }
                }else{
                    array_push($this->result, $this->mysqli->error);
                    return false;
                }
            }
        }
        //  function for close connection
        public function __destruct(){
            if($this->conn){
                if($this->mysqli->close()){
                    $this->conn = false;
                    return true;
                }
            }else{
                return false;
            }
        }
    }
    
?>