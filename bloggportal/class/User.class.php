<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Class for users

class User {
    private $db;
    private $username;
    private $password;
    private $first_name;
    private $last_name;
    private $email;

    // Connect to database
    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die ("Fel vid anslutning till databas: " . $this->db->connect_error);
        }
    }

    // Register new user
    public function registerUser($username, $password, $first_name, $last_name, $email) {
        if(!$this->setUsername($username)) {
			return false;
		}
		if(!$this->setPassword($password)) {
			return false;
        }        
        if(!$this->setfirstName($first_name)) {
			return false;
        }
        if(!$this->setlastName($last_name)) {
			return false;
		}
		if(!$this->setEmail($email)) {
			return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, password, first_name, last_name, email) VALUES ('$username', '$password', '$first_name', '$last_name', '$email')";
        $result = $this->db->query($sql);
        return $result;
    }

    // Is username available
    public function availableUsername($username) {
        $sql = "SELECT username FROM user WHERE username = '$username'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Log in user
    public function loginUser($username, $password) {
        $sql = "SELECT password FROM user WHERE username='$username'";
        $result = $this->db->query($sql);

        if(!$this->setUsername($username)) {
			return false;
		}
		if(!$this->setPassword($password)) {
			return false;
        }

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed = $row['password'];

            if(password_verify($password, $hashed)) {
                $_SESSION['username'] = $username;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Get all users
    public function getUsers() {
        $sql = "SELECT * FROM user ORDER BY username";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    //Get user
    public function getUser($id) {
        $sql = "SELECT username FROM user WHERE user_id=$id";
        $result = $this->db->query($sql);

        $row = mysqli_fetch_array($result);
        return $row;
    }

    //Set username
    public function setUsername($username) {
		if($username != "") {
			$this->username = $this->db->real_escape_string(strip_tags($username));
			return true;
		} else {
			return false;
		}
    }
    
    //Set password
    public function setPassword($password) {
		if($password != "") {
			$this->password = $this->db->real_escape_string(strip_tags($password));
			return true;
		} else {
			return false;
		}
    }
    
    //Set first name
    public function setfirstName($first_name) {
		if($first_name != "") {
			$this->first_name = $this->db->real_escape_string(strip_tags($first_name));
			return true;
		} else {
			return false;
		}
    }

    //Set last name
    public function setlastName($last_name) {
        if($last_name != "") {
            $this->last_name = $this->db->real_escape_string(strip_tags($last_name));
            return true;
        } else {
            return false;
        }
    }
    
    //Set email
    public function setEmail($email) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->email = $this->db->real_escape_string(strip_tags($email));
			return true;
		} else {
			return false;
		}
    }
}