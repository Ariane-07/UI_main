<?php


include ('dbconnect.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }






    public function petRegistration(
        $dateApplication, $nameApplicant, $age, $gender, $birthday, $telephone,
        $emailApplicant, $homeAddress,$barangay, $petName, $petAge, $petGender, $species,
        $breed, $petWeight, $petColor, $distinguishingMarks, $petBirthday,
        $vaccinationDate, $vaccinationExpiry, $vetClinic, $vetName, $vetAddress,
        $vetContact, $dateSigned, $userPhotoName,$ValidIDName, $ownerSignatureName, $qrCodeFileName
    ) {
        // Insert Data into Database
        $sql = "INSERT INTO pets_info (
            pet_photo_owner,ValidIDName, pet_date_application, pet_owner_name, pet_owner_age,
            pet_owner_gender, pet_owner_birthday, pet_owner_telMobile, pet_owner_email,
            pet_owner_home_address,pet_owner_barangay, pet_name, pet_age, pet_gender, pet_species, pet_breed,
            pet_weight, pet_color, pet_marks, pet_birthday, pet_antiRabies_vac_date,
            pet_antiRabies_expi_date, pet_vet_clinic, pet_vet_name, pet_vet_clinic_address,
            pet_vet_contact_info, pet_owner_signature, pet_date_signed, pet_qr_code
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
    
        $stmt->bind_param(
            "sssssssssssssssssssssssssssss", // Should match the number of placeholders in SQL (29)
            $userPhotoName, $ValidIDName, $dateApplication, $nameApplicant, $age, $gender, $birthday,
            $telephone, $emailApplicant, $homeAddress, $barangay, $petName, $petAge, $petGender,
            $species, $breed, $petWeight, $petColor, $distinguishingMarks, $petBirthday,
            $vaccinationDate, $vaccinationExpiry, $vetClinic, $vetName, $vetAddress,
            $vetContact, $ownerSignatureName, $dateSigned, $qrCodeFileName
        );
        
    
        if ($stmt->execute()) {
            $insertedId = $this->conn->insert_id; // Get the last inserted pet_id
            $stmt->close();
            return [
                'PET ID' => $insertedId,
                'date application' => $dateApplication,
                'name applicant' => $nameApplicant,
                'age' => $age,
                'gender' => $gender,
                'birthday' => $birthday,
                'telephone' => $telephone,
                'email applicant' => $emailApplicant,
                'home address' => $homeAddress,
                'pet name' => $petName,
                'pet age' => $petAge,
                'pet gender' => $petGender,
                'species' => $species,
                'breed' => $breed,
                'pet weight' => $petWeight,
                'pet color' => $petColor,
                'distinguishing_marks' => $distinguishingMarks,
                'pet birthday' => $petBirthday,
                'vaccination_date' => $vaccinationDate,
                'vaccination_expiry' => $vaccinationExpiry,
                'vet clinic' => $vetClinic,
                'vet name' => $vetName,
                'vet address' => $vetAddress,
                'vet contact' => $vetContact,
                'date signed' => $dateSigned
            ];
        } else {
            $error = "Error: " . $stmt->error;
            $stmt->close();
            return ['error' => $error];
        }
    }
    



    public function updatePetQRCode($petID, $qrCodeFileName) {
        $updateSQL = "UPDATE pets_info SET pet_qr_code = ? WHERE pet_id = ?";
    
        // Use $this->conn instead of $db->conn
        $stmt = $this->conn->prepare($updateSQL);
        
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
    
        $stmt->bind_param("si", $qrCodeFileName, $petID);
        
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    
        $stmt->close();
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
            ORDER BY post_comments.comments_date ASC
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
                    'username' => $row['Username'],
                    'profilePic' => $row['ProfilePic']
                ];
            }
            echo json_encode($comments);
        } else {
            echo json_encode(['error' => 'Failed to retrieve comments']);
        }
    
        $stmt->close();
    }
    


    public function FetchUserPost($UserID, $offset, $limit) {
        $query = "
            SELECT * FROM post_content
            LEFT JOIN users ON post_content.post_user_id = users.UserID
            WHERE post_status='1'
            ORDER BY post_content.post_date DESC
            LIMIT ? OFFSET ?
            
        ";
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


    public function FetchAllUsers($UserID) {
        $query = "SELECT UserID, Username FROM users WHERE UserID != ?";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bind_param("i", $UserID);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        $stmt->close();
        echo json_encode($users); 
    }


    public function fetchUserChats($sender_id, $receiver_id) {
        $sql = "SELECT cm.*, 
                       sender.UserID AS sender_id, sender.Name AS sender_name, sender.ProfilePic AS sender_profile, 
                       receiver.UserID AS receiver_id, receiver.Name AS receiver_name, receiver.ProfilePic AS receiver_profile
                FROM chat_messages cm
                LEFT JOIN users sender ON sender.UserID = cm.sender_id
                LEFT JOIN users receiver ON receiver.UserID = cm.receiver_id
                WHERE (cm.sender_id = ? AND cm.receiver_id = ?) 
                   OR (cm.sender_id = ? AND cm.receiver_id = ?)
                ORDER BY cm.chat_id ASC";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    
        return $messages;
    }
    
    
    



    public function UpdateProfile($profilePicName, $email, $owner_name, $username, $gender, $birthdate, $contact, $address, $link_address, $UserID)
    {
        // Start constructing the SQL statement
        $sql = "UPDATE users SET Email = ?, Name = ?, Username = ?, Gender = ?, BirthDate = ?, Contact = ?, Address = ?, Link_address = ?";
        
        // Array to store the parameters and their types
        $params = [$email, $owner_name, $username, $gender, $birthdate, $contact, $address, $link_address];
        $types = "ssssssss"; // Corresponding types for bind_param
    
        // Include ProfilePic in the update only if it's not null
        if ($profilePicName !== null) {
            $sql .= ", ProfilePic = ?";
            $params[] = $profilePicName;
            $types .= "s"; // Add one more string type
        }
    
        // Add the WHERE condition
        $sql .= " WHERE UserID = ?";
        $params[] = $UserID;
        $types .= "i"; // UserID is an integer
    
        // Prepare SQL statement
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            return json_encode(array('status' => 'error', 'message' => 'Failed to prepare statement.'));
        }
    
        // Bind parameters dynamically
        $stmt->bind_param($types, ...$params);
    
        // Execute the query
        if ($stmt->execute()) {
            $stmt->close();
            return json_encode(array('status' => 'success', 'message' => 'Profile updated successfully.'));
        } else {
            $stmt->close();
            return json_encode(array('status' => 'error', 'message' => 'Unable to update profile.'));
        }
    }
    





    public function DeletePost($deletepostid)
    {
        
            // Update query excluding post_images
            $stmt = $this->conn->prepare("UPDATE `post_content` SET `post_status` = '0' WHERE `post_id` = ?");
            $stmt->bind_param("s",$deletepostid);
        
        if ($stmt->execute()) {
            $response = array(
                'status' => 'success'
            );
            echo json_encode($response);
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Unable to delete post'));
        }
    }


    public function EditPost($editpostid, $postInput, $postFilesJson)
    {
        if (!empty($postFilesJson)) {
            // Update query including post_images
            $stmt = $this->conn->prepare("UPDATE `post_content` SET `post_content` = ?, `post_images` = ? WHERE `post_id` = ?");
            $stmt->bind_param("sss", $postInput, $postFilesJson, $editpostid);
        } else {
            // Update query excluding post_images
            $stmt = $this->conn->prepare("UPDATE `post_content` SET `post_content` = ? WHERE `post_id` = ?");
            $stmt->bind_param("ss", $postInput, $editpostid);
        }
    
        if ($stmt->execute()) {
            $response = array(
                'status' => 'success'
            );
            echo json_encode($response);
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Unable to update post'));
        }
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
            echo json_encode(array('status' => 'error', 'message' => 'Unable to post'));
        }
    }


    public function SentMessagge($sender_id, $reciever_id, $message, $uniqueFileName)
    {
        $stmt = $this->conn->prepare("INSERT INTO `chat_messages` (`sender_id`, `receiver_id`, `message_text`, `message_media`) VALUES (?, ?, ?, ?)");
    
        if (!$stmt) {
            return json_encode(array('status' => 'error', 'message' => 'SQL prepare failed: ' . $this->conn->error));
        }
    
        $stmt->bind_param("ssss", $sender_id, $reciever_id, $message, $uniqueFileName);
    
        if ($stmt->execute()) {
            return json_encode(array('status' => 'success'));
        } else {
            return json_encode(array('status' => 'error', 'message' => 'Unable to post: ' . $stmt->error));
        }
    }
    
    
    
    

    

    
    public function fetch_pending_pets($status)
    {
        $query = $this->conn->prepare("SELECT * from pets_info where pet_status='$status'");

        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
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




    public function SignUp($email, $username, $password, $role)
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
    
        // Check if the username already exists
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `Username` = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Username already exists, return error response
            echo json_encode(array('status' => 'username_already', 'message' => 'Username already exists'));
            return;  // Stop further execution
        }
    
        // Hash the password using SHA-256
        $hashedPassword = hash('sha256', $password);
    
        // Proceed with insertion if email and username do not exist
        $stmt = $this->conn->prepare("INSERT INTO `users` (`Username`, `Email`, `Password`, `Role`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
    
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
    
    // Bind the username and the hashed password
    $query->bind_param("ss", $username, $hashedPassword);
    
    // Execute the query
    if ($query->execute()) {
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            session_start();
            $_SESSION['UserID'] = $user['UserID'];
            $_SESSION['Role'] = $user['Role'];
            
            // Return user data along with role
            return [
                'UserID' => $user['UserID'],
                'Username' => $user['Username'],
                'Role' => $user['Role']
            ];
        } else {
            return false; // No user found
        }
    } else {
        return false; // Query execution failed
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