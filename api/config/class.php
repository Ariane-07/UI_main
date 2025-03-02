<?php
include ('dbconnect.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }


    public function FetchComments($UserID, $postId) {
        // Query to fetch comments for a specific post, joining user details
        $query = "
            SELECT 
                post_comments.comments_id,
                post_comments.comments_text,
                post_comments.comments_date,
                users.Username,
                users.ProfilePic
            FROM post_comments
            LEFT JOIN users ON post_comments.comments_user_id = users.UserID
            WHERE post_comments.comments_post_id = ?
            ORDER BY post_comments.comments_date DESC
        ";
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo json_encode(['error' => 'Database error: ' . $this->conn->error]);
            return;
        }
    
        // Bind parameter (corrected)
        $stmt->bind_param("i", $postId);
        
        // Execute and fetch results
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result) {
            $comments = [];
            while ($row = $result->fetch_assoc()) {
                $comments[] = [
                    'comment_id' => $row['comments_id'],
                    'comment_text' => $row['comments_text'],
                    'comment_date' => $row['comments_date'],
                    'username' => $row['Username'] ?? 'Unknown User',
                    'profilePic' => $row['ProfilePic'] ?? 'https://ui-avatars.com/api/?name=User&background=random'
                ];
            }
            echo json_encode($comments);
        } else {
            echo json_encode(['error' => 'Failed to retrieve comments']);
        }
    
        $stmt->close();
    }
    


    public function FetchUserPost($UserID, $offset, $limit) {
        // Query to fetch user posts with user details, sorted by latest first with pagination
        $query = "
            SELECT * FROM post_content
            LEFT JOIN users ON post_content.post_user_id = users.UserID
            ORDER BY post_content.post_date DESC
            LIMIT ? OFFSET ?
        ";
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo json_encode(['error' => 'Database error: ' . $this->conn->error]);
            return;
        }
    
        // Bind parameters and execute
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            echo json_encode($rows);
        } else {
            echo json_encode(['error' => 'Failed to retrieve posts']);
        }
    
        $stmt->close();
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

    
    
    

    public function AddComment($UserID, $postId, $commentText)
    {
        // Proceed with insertion if email does not exist
        $stmt = $this->conn->prepare("INSERT INTO `post_comments` (`comments_user_id`,`comments_post_id`,`comments_text`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$UserID, $postId,$commentText);
    
        if ($stmt->execute()) {
            $response = array(
                'status' => 'success'
            );
            echo json_encode($response);
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Unable to sent'));
        }
    }



    public function SignUp($email,$username,$password,$role)
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
        $stmt = $this->conn->prepare("INSERT INTO `users` (`Username`, `Email`, `Password`,`Role`) VALUES (?, ?, ?,?)");
        $stmt->bind_param("ssss",$username, $email,$hashedPassword,$role);
    
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
         $query = $this->conn->prepare("SELECT * FROM `users` WHERE `Username` = ? AND `Password` = ?");
     
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