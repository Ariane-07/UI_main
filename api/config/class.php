<?php
include ('dbconnect.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }


    public function PostContent($post_user_id,$postInput, $postFilesJson)
    {
        // Proceed with insertion if email does not exist
        $stmt = $this->conn->prepare("INSERT INTO `post_content` (`post_user_id`, `post_content`, `post_images`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$post_user_id, $postInput,$postFilesJson);
    
        if ($stmt->execute()) {
            $response = array(
                'status' => 'success'
            );
            echo json_encode($response);
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Unable to register'));
        }
    }



    public function SignUp($email,$username,$password)
    {
      
    
        // Check if the email already exists
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `Email` = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Email already exists, return error response
            echo json_encode(array('status' => 'email_already', 'message' => 'Email already exists'));
            return;  // Stop further execution
        }
        
        // Hash the password using SHA-256
        $hashedPassword = hash('sha256', $password);
    
        // Proceed with insertion if email does not exist
        $stmt = $this->conn->prepare("INSERT INTO `users` (`Username`, `Email`, `Password`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$username, $email,$hashedPassword);
    
        if ($stmt->execute()) {
            session_start();
            $userId = $this->conn->insert_id;
            $_SESSION['UserID'] = $userId;
            $response = array(
                'status' => 'success',
                'id' => $userId
            );
            echo json_encode($response);
        } else {
            // Return an error status with the error code
            echo json_encode(array('status' => 'error', 'message' => 'Unable to register'));
        }
    }



    public function LogIn($username, $password)
    {
         // Hash the input password using SHA-256
         $hashedPassword = hash('sha256', $password);
         // Prepare the SQL query
         $query = $this->conn->prepare("SELECT * FROM `users` WHERE `Username` = ? AND `Password` = ? AND Role = 'pet_owner'");
     
         // Bind the email and the hashed password
         $query->bind_param("ss", $username, $hashedPassword);
         
         // Execute the query
         if ($query->execute()) {
             $result = $query->get_result();
             if ($result->num_rows > 0) {
                 $user = $result->fetch_assoc();
                 session_start();
                 $_SESSION['UserID'] = $user['UserID'];
     
                 return $user;
             } else {
                 return false;
             }
         } else {
             return false;
         }
    }


    public function check_account($UserID) {
      
        $query = "SELECT * FROM users WHERE UserID = $UserID";
    
        $result = $this->conn->query($query);

        // Prepare ang array para sa result
        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items; 
    }










}