<?php


require_once '../config/config.php';

class Admin
{
    public $id;
    private $username;
    private $email;
    private $password;
    private $role;

    public function __construct($username = null, $email = null, $password = null, $role = null)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    // public function getAllUsers() {
    //     $dbConnection = (new Connection())->getConnection();
    //     if ($dbConnection) {
    //         try {
    //             $query = "SELECT * FROM users";
    //             $stmt = $dbConnection->prepare($query);
    //             $stmt->execute();
    //             return $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // Fetch all results
    //         } catch (Exception $e) {
    //             echo "<script>alert('Erreur lors de la connexion : " . $e->getMessage() . "');</script>";
    //         }
    //     }
    // }


    public function getAllUsers()
    {

        $dbConnection = (new Connection)->getConnection();

        if ($dbConnection) {
            $query = "SELECT * FROM users";
            $stmt = $dbConnection->prepare($query);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "<script> alert ('error de connextion a la base de donne </script> ";
        }
    }


    public function changeStatus($id, $status)
    {
        $dbConnection = (new Connection)->getConnection();

        $query = 'UPDATE users SET status = ? WHERE user_id = ?';

        $stmt = $dbConnection->prepare($query);

        if (!$stmt) {
            die('Prepare failed: ' . $dbConnection->error);
        }

        $stmt->bind_param('si', $status, $id);

        if ($stmt->execute()) {
            echo 'Status updated successfully';
            // header ('location : ../AdminPages/users.php');
        } else {
            echo 'Error updating status: ' . $stmt->error;
        }

        $stmt->close();

        $dbConnection->close();
    }

    public function supprimerUser($id){
        $dbConnection = (new Connection)->getConnection();

        $query = "DELETE FROM users WHERE user_id=?";

        $stmt = $dbConnection->prepare($query);
        if(!$stmt){
            die('preparr failed' . $dbConnection->error);
        }

        $stmt->bind_param('i', $id);


        if($stmt->execute()){
            // die ('utilisateur supprimer avec succes');
        }else{
            echo "erreur". $stmt->error;
        }

        $stmt->close();
        $dbConnection->close();
    }


































}
