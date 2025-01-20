<?php
require_once '../config/config.php';

class User
{
    public $id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $status;

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

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }


    // la fonction d'inscription
    public function signup()
    {
        $username = $this->getUsername();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $role = $this->getRole();

        // $status = ($role === 'enseignant') ? 'suspendue' : null; 
        if ($role === 'enseignant') {
            $status = 'suspendue';
        } else {
            $status = null;
        }

        if (empty($username) || empty($email) || empty($password) || empty($role)) {
            echo "Tous les champs sont obligatoires.";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Adresse email invalide.";
            return;
        }

        $dbConnection = (new Connection())->getConnection();

        if ($dbConnection) {
            try {

                $stmt = $dbConnection->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();

                if ($count > 0) {
                    echo "<script>alert('Cet email est déjà utilisé.')</script>";
                    return;
                }


                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


                if ($role === 'enseignant') {
                    $stmt = $dbConnection->prepare("
                        INSERT INTO Users (username, email, password, role, status)
                        VALUES (?, ?, ?, ?, ?)
                    ");
                    $stmt->bind_param("sssss", $username, $email, $hashedPassword, $role, $status);
                } else {
                    $stmt = $dbConnection->prepare("
                        INSERT INTO Users (username, email, password, role)
                        VALUES (?, ?, ?, ?)
                    ");
                    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
                }


                if ($stmt->execute()) {
                    echo "<script>alert('Inscription réussie. Vous pouvez maintenant vous connecter.')</script>";
                } else {
                    echo "<script>alert('Erreur lors de l'inscription.')</script> " . $stmt->error;
                }

                $stmt->close();
            } catch (Exception $e) {
                echo "Erreur: " . $e->getMessage();
            }
        } else {
            echo "Connexion à la base de données impossible.";
        }
    }

    function isAuthorized($requiredRole) {
        return isset($_SESSION['role']) && $_SESSION['role'] === $requiredRole;
    }

    public function signIn()
    {
        $email = $this->getEmail();
        $password = $this->getPassword();
        $dbConnection = (new Connection())->getConnection();
        $message = ''; // Initialisez le message d'erreur
    
        if ($dbConnection) {
            try {
                $stmt = $dbConnection->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
    
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
    
                    if (password_verify($password, $user['password'])) {
                        // Gestion des sessions
                        session_start();
                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['status'] = $user['status'];
    
                        if ($user['role'] == 'admin') {
                            header("Location: ../AdminPages/DashboardAdmin.php");
                            exit();
                        } elseif ($user['role'] == 'enseignant' && $user['status'] == 'active') {
                            header("Location: ../EnseignantPages/DashboardEnseignant.php");
                            exit();
                        } elseif ($user['role'] == 'enseignant' && $user['status'] != 'active') {
                            // Enregistrez un message d'erreur
                            $message = "Attendez l'activation de votre compte.";
                        } else {
                            header("Location: ../EtudiantPages/DashboardEtudiant.php");
                            exit();
                        }
                    } else {
                        $message = "Mot de passe incorrect.";
                    }
                } else {
                    $message = "Utilisateur non trouvé.";
                }
    
                $stmt->close();
            } catch (Exception $e) {
                $message = "Erreur lors de la connexion : " . $e->getMessage();
            }
        } else {
            $message = "Connexion à la base de données impossible.";
        }
    
        return $message; // Retournez le message d'erreur
    }
    
}
