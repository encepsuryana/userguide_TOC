<?php
/**
 * @package User_guide class
 *
 * @author Encep Suryana
 *
 * @email  encep.suryanajr@gmail.com
 *   
 */

// include connection class
include("DBConnection.php");
// User_guide
class User_guide {
    protected $db;
    private $_userguideID;
    private $_featName;
    private $_featLink;
    private $_featContent;
    private $_lastUpdate;

    public function setUserguideID($userguideID) {
        $this->_userguideID = $userguideID;
    }
    public function setFeatName($featName) {
        $this->_featName = $featName;
    }
    public function setFeatLink($featLink) {
        $this->_featLink = $featLink;
    }
    public function setFeatContent($featContent) {
        $this->_featContent = $featContent;
    }
    public function setLastUpdate($lastUpdate) {
        $this->_lastUpdate = $lastUpdate;
    }
    
    // __construct
    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    // create record in database
    public function create() {
		try {
    		$sql = 'INSERT INTO tbl_userguide (featName, featLink, featContent, lastUpdate)  VALUES (:featName, :featLink, :featContent, :lastUpdate)';
    		$data = [
			    'featName'    => $this->_featName,
                'featLink'    => $this->_featLink,
                'featContent' => $this->_featContent,
			    'lastUpdate'  => $this->_lastUpdate,
			];
	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute($data);
			$status = $this->db->lastInsertId();
            return $status;

		} catch (Exception $err) {
    		die("Oh tidak! Ada kesalahan dalam kueri! ".$err);
		}
    }

    // update record in database
    public function update() {
        try {
		    $sql = "UPDATE tbl_userguide SET featName=:featName, featLink=:featLink, featContent=:featContent, lastUpdate=:lastUpdate WHERE id=:userguide_id";
		    $data = [
			    'featName'     => $this->_featName,
                'featLink'     => $this->_featLink,
                'featContent'  => $this->_featContent,
                'lastUpdate'   => $this->_lastUpdate,
                'userguide_id' => $this->_userguideID,
			];
			$stmt = $this->db->prepare($sql);
			$stmt->execute($data);
			$status = $stmt->rowCount();
            return $status;
		} catch (Exception $err) {
			die("Oh tidak! Ada kesalahan dalam kueri! " . $err);
		}
    }
   
    // get records from database
    public function getList() {
    	try {
    		$sql = "SELECT id, featName, featLink, featContent, lastUpdate FROM tbl_userguide";
		    $stmt = $this->db->prepare($sql);
		    $stmt->execute();
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $err) {
		    die("Oh tidak! Ada kesalahan dalam kueri! " . $err);
		}
    }
    // 
    public function getUserguide() {
        try {
            $sql = "SELECT id, featName, featLink, featContent, lastUpdate FROM tbl_userguide WHERE id=:userguide_id";
            $stmt = $this->db->prepare($sql);
            $data = [
                'userguide_id' => $this->_userguideID
            ];
            $stmt->execute($data);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die("Oh tidak! Ada kesalahan dalam kueri!");
        }
    }

    // delete record from database
    public function delete() {
    	try {
	    	$sql  = "DELETE FROM tbl_userguide WHERE id=:userguide_id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'userguide_id' => $this->_userguideID
			];
	    	$stmt->execute($data);
            $status = $stmt->rowCount();
            return $status;
	    } catch (Exception $err) {
		    die("Oh tidak! Ada kesalahan dalam kueri! " . $err);
		}
    }
}
?>