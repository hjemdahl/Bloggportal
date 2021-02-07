<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Class for blogposts
class Blogpost {
    private $db;
    private $header;
    private $content;

    // Connect to database
    public function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
        if ($this->db->connect_errno > 0) {
        die ("Fel vid anslutning till databas: " . $this->db->connect_error);
        }
    }

    // New blogpost
    public function newBlogpost($header, $content, $writer) {
        if(!$this->setHeader($header)) {
            return false;
        }
        if(!$this->setContent($content)) {
            return false;
        }
        
        $sql = "INSERT INTO blogpost (header, content, writer) VALUES ('$header', '$content', '$writer')";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Edit blogpost
    public function editBlogpost($header, $content, $id) {
        if(!$this->setHeader($header)) {
            return false;
        }
        if(!$this->setContent($content)) {
            return false;
        }
        $id = intval($id);
        
        $sql = "UPDATE blogpost SET header='" . $this->header . "', content='" . $this->content . "' WHERE post_id=$id";
        $reslut = $this->db->query($sql);
        return $reslut;
    }

    // Delete blogpost
    function deleteBlogpost($id) {
        $id = intval($id);

		$sql = "DELETE FROM blogpost WHERE post_id=$id";
        $result = $this->db->query($sql);
        return $result;
    }

    // Get all bloggers bloggposts
    public function getBloggersPosts($id) {
        $sql = "SELECT * FROM blogpost WHERE writer = (SELECT username FROM user WHERE user_id=$id) ORDER BY post_date DESC";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Get logged in users blogposts
    public function getWritersPosts($writer) {
        $sql = "SELECT * FROM blogpost WHERE writer='$writer' ORDER BY post_date DESC";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Get blogpost for editing
    public function getWritersPost($id) {
        $id = intval($id);

		$sql = "SELECT * FROM blogpost WHERE post_id=$id";
        $result = $this->db->query($sql);
        $row = mysqli_fetch_array($result);
        return $row;
    }

    // Get five most recent blogposts
    public function getRecentPosts() {
        $sql = "SELECT * FROM blogpost ORDER BY post_date DESC LIMIT 5";
        $result = $this->db->query($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Set header
    public function setHeader($header) {
		if($header != "") {
			$this->header = $this->db->real_escape_string(strip_tags($header));
			return true;
		} else {
			return false;
		}
    }
    
    // Set content
    public function setContent($content) {
		if($content != "") {
			$this->content = $this->db->real_escape_string(strip_tags($content));
			return true;
		} else {
			return false;
		}
	}
}