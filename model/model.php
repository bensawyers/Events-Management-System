<?php
  /**
   * Creates the database connection, and calls all of the queries
   * to the database.
   */
  class Model
  {
    private $db;
    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $dbname;

    /**
     * Initialises the database user and host.
     */
    function __construct()
    {
      $this->dbhost = "localhost";
      $this->dbuser = "sawyersb";
      $this->dbpass = "s4fgnuVPp/IJ5XPq";
      $this->dbname = "sawyersb_db";
    }

    /**
     * Creates the connection to the database.
     */
    function connect()
    {
      try{
      $this->db = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected to " . $this->dbname . " successful.<br />";
      } catch (PDOException $ex) {
        echo "ERROR: " . $ex->getMessage();
      }
    }

    /**
     * Gets all of the rows within the events table
     * and returns them.
     */
    function displayEvents()
    {
      $this->connect();
      try {
        $events = array();
        $query = "SELECT * FROM astonEvents";
        foreach ($this->db->query($query) as $row) {
          //array_push($events, $row);
          $events[] = $row;
        }
        return $events;
      } catch (PDOException $ex) {
        echo "ERROR: " . $ex->getMessage();
      }
    }

    /**
     * Get all of the events for a specific organiser
     * and returns them.
     */
    function displayOrgEvents()
    {
      $this->connect();
      try {
        $events = array();
        $id = $_SESSION["u_id"];
        $query = "SELECT * FROM astonEvents WHERE OrgId='$id'";
        foreach ($this->db->query($query) as $row) {
          //array_push($events, $row);
          $events[] = $row;
        }
        return $events;
      } catch (PDOException $ex) {
        echo "ERROR: " . $ex->getMessage();
      }
    }

    /**
     * Inserts the organisers information into
     * the corresponding table in the database.
     */
    function regOrganiser($data)
    {
      $response = array();
      $errors = array();
      $name = $data["name"];
      $pass = $data["password"];
      $email = $data["email"];
      $number = $data["number"];
      $this->connect();
      try {
        $query = "SELECT * FROM organisers WHERE Email='$email'";
        $count = $this->db->query($query);
        if ($count->rowCount()==0) {
          $pass = hash("sha384", $pass);
          $query = "INSERT INTO organisers(O_Name, Pass, Email, PhoneNum)";
          $query .= "VALUES('$name', '$pass', '$email', '$number')";
          $statement = $this->db->prepare($query);
          if ($statement->execute()) {
            $response["success"] = true;
          } else {
            $errors[] = "Failed to save details.";
          }

        }
        else {
          $errors[] = "Email already exists.";
        }
      } catch (PDOException $ex) {
        $errors[] = "ERROR: " . $ex->getMessage();
      }
      if (count($errors) >=1) {
        $response["errors"] = $errors;
        $response["success"] = false;
      }
      return $response;
    }

    /**
     * Check if the organiser exists and that their
     * credentials match those in the database.
     */
    function loginOrganiser($data)
    {
      $email = $data["email"];
      $pass = $data["password"];
      $response = array();
      $errors = array();
      $this->connect();

      try {
        $query = "SELECT * FROM organisers WHERE Email='$email'";
        $rows = $this->db->query($query);
        if ($rows->rowCount()==1) {
           $row = $rows->fetch(PDO::FETCH_ASSOC);
           $pass = hash("sha384", $pass);
           if($pass == $row["Pass"]){
             $_SESSION["u_user"] = $row["O_Name"];
             $_SESSION["u_id"] = $row["OrgId"];
             $response["success"] = true;
           }
           else {
             $row = $rows->fetch(PDO::FETCH_ASSOC);
             $errors[] = "Password not recognised.<br>" . $pass . " second " . $row["Pass"];
           }
        }
        else {
          $errors[] = "Email not recognised.";
        }
      } catch (PDOException $ex) {
        $errors[] = "ERROR: " . $ex->getMessage();
      }
      if (count($errors) >=1) {
        $response["errors"] = $errors;
        $response["success"] = false;
      }
      return $response;
    }

    /**
     * Adds the event information to the events table.
     */
    function addEvent($data)
    {
      $response = array();
      $errors = array();
      $name = $data["name"];
      $cat = $data["cat"];
      $date = $data["date"];
      $desc = $data["desc"];
      $place = $data["place"];
      $id = $_SESSION["u_id"];
      $this->connect();

      try {
        $query = "INSERT INTO astonEvents(Category, E_Name, Description, Place, EventDate, OrgId)";
        $query .= "VALUES('$cat', '$name', '$desc', '$place', '$date', '$id')";
        $statement = $this->db->prepare($query);
        if ($statement->execute()) {
          $response["success"] = true;
          $query = "SELECT LAST_INSERT_ID()";
          $row = $this->db->query($query);
          $e_id = $row->fetch(PDO::FETCH_ASSOC);
          $response["event"] = $e_id;
        } else {
          $errors[] = "Failed to save event.";
        }
      } catch (PDOException $ex) {
        $errors[] = "ERROR: " . $ex->getMessage();
      }
      if (count($errors) >=1) {
        $response["errors"] = $errors;
        $response["success"] = false;
      }
      return $response;

    }

    /**
     * Returns the event information for a
     * specific event.
     */
    function getEvent($data)
    {
      $this->connect();
      try {
        $events = array();
        $query = "SELECT Category, E_Name, Description, Place, EventDate, Rating, O_Name, Email, PhoneNum, organisers.OrgId ";
        $query .= "FROM astonEvents ";
        $query .= "JOIN organisers ON astonEvents.OrgId = organisers.OrgId WHERE EventId='$data'";
        $rows = $this->db->query($query);
        if ($rows->rowCount()==1) {
           $row = $rows->fetch(PDO::FETCH_ASSOC);
           //$events[] = $row;
           return $row;
        }
        else {
          echo "error retreiving";
        }
        //return $events;
      } catch (PDOException $ex) {
        $db_error = "ERROR: " . $ex->getMessage();
      }
    }

    /**
     * Updates the event information in the
     * event table.
     */
    function updateEvent($data)
    {
      $response = array();
      $errors = array();
      $id = $data["id"];
      $this->connect();

      try {
        $query = "UPDATE astonEvents SET";
        foreach ($data as $key => $value) {
          switch ($key) {
            case 'cat':
            $query .= " Category = '$value'";
            break;

            case 'name':
            $query .= " E_Name = '$value'";
            break;

            case 'desc':
            $query .= " Description = '$value'";
            break;

            case 'place':
            $query .= " Place = '$value'";
            break;

            case 'date':
            $query .= " EventDate = '$value'";
            break;
          }
        }
        $query .= " WHERE EventId = '$id'";
        $statement = $this->db->prepare($query);
        if ($statement->execute()) {
          $response["success"] = true;
        } else {
          $errors[] = "Failed to update event.";
        }
      } catch (PDOException $ex) {
        $errors[] = "ERROR: " . $ex->getMessage();
      }
      if (count($errors) >=1) {
        $response["errors"] = $errors;
        $response["success"] = false;
      }
      return $response;
    }

    /**
     * Checks that an event exists.
     */
    function checkEvent($data)
    {
      $this->connect();
      $success = "";
      try {
        $query = "SELECT * FROM astonEvents WHERE EventId = '$data'";
        $count = $this->db->query($query);
        if ($count->rowCount() == 1) {
          $success = true;
        }
        else {
          $success = false;
        }
        return $success;
      } catch (PDOException $ex) {
        $db_error = "ERROR: " . $ex->getMessage();
      }
    }

    /**
     * Deletes a specific event from the events table.
     */
    function deleteEvent($data)
    {
      $this->connect();
      try {
        $response;
        $query = "DELETE FROM astonEvents WHERE EventId='$data'";
        $statement = $this->db->prepare($query);
        if ($statement->execute()) {
          $response = true;
        }
        else {
          $response = false;
        }
        return $response;
      } catch (PDOException $ex) {
        echo "ERROR: " . $ex->getMessage();
      }
    }

    /**
     * Updates the likeness rating column in the events table.
     */
    function likeEvent($event, $like)
    {
      $this->connect();
      $rating = $like;
      $rating++;
      $response;
      try {
        $query = "UPDATE astonEvents SET Rating = '$rating' WHERE EventId = '$event'";
        $statement = $this->db->prepare($query);
        if ($statement->execute()) {
          $response = true;
          $_SESSION["rating"] = true;
        }
        else {
          $response = false;
        }
      } catch (PDOException $ex) {
        $response = false;
      }
      return $response;
    }

    /**
     * Adds an image to the pictures table for a specific event.
     */
    function addImage($images, $e_id)
    {
      $response = array();
      try {
        foreach ($images as $value) {
          $query = "INSERT INTO pictures(Name, EventId)";
          $query .= "VALUES('$value', '$e_id')";
          $statement = $this->db->prepare($query);
          if ($statement->execute()) {
            $response["success"] = true;
          }
          else {
            $response["success"] = false;
            $response["errors"] = "unable to save image(s).";
          }
        }
      } catch (PDOException $ex) {
        $response = false;
        $response["errors"] = $ex->getMessage();
      }
      return $response;
    }

    /**
     * gets the image from the pictures table for a specific
     * event.
     */
    function getImage($data)
    {
      $images = array();
      try {
        $query = "SELECT Name FROM pictures WHERE EventId = '$data'";
        foreach ($this->db->query($query) as $row){
          $images[] = $row;
        }
      } catch (PDOException $ex) {

      }
      return $images;
    }
  }

?>
