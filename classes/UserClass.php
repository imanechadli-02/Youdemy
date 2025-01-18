<?php
require_once '../config/config.php';

class User
{
    public $id;
    private $username;
    private $email;
    private $password;
    private $role;

    public function __construct($username = null , $email = null, $password = null, $role = null)
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

    public function signup()
    {
        $username = $this->getUsername();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $role = $this->getRole();

        if (empty($username) || empty($email) ||  empty($password) || empty($role)) {
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

                $stmt = $dbConnection->prepare("
                    INSERT INTO Users (username, email, password, role)
                    VALUES (?, ?, ?, ?)
                ");


                $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

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


    public function signIn()
    {
        $email = $this->getEmail();
        $password = $this->getPassword();

        $dbConnection = (new Connection())->getConnection();

        if ($dbConnection) {
            try {
                $stmt = $dbConnection->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    if (password_verify($password, $user['password'])) {
                        // session_start();

                        $_SESSION['user_id'] = $user['user_id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['status'] = $user['status'];

                        if ($user['role'] == 'admin') {
                            header("Location: ../AdminPages/DashboardAdmin.php");
                            exit(); // Ensure script stops after redirection
                        } elseif ($user['role'] == 'enseignant' && $user['status'] == 'active') {
                            header("Location: ../EnseignantPages/DashboardEnseignant.php");
                            exit();
                        } elseif ($user['role'] == 'enseignant' && $user['status'] != 'active') {
                            echo "<script>alert('Attendez l\'activation de votre compte');</script>";
                            exit(); // Optional: you can stop the script after showing the alert
                        } else {
                            // If the role is not 'admin' or 'enseignant'
                            header("Location: ../EtudiantPages/DashboardEtudiant.php");
                            exit();
                        }
                    } else {
                        echo "<script>alert('Mot de passe incorrect.');</script>";
                    }
                } else {
                    echo "<script>alert('Utilisateur non trouvé.');</script>";
                }

                $stmt->close();
            } catch (Exception $e) {
                echo "<script>alert('Erreur lors de la connexion : " . $e->getMessage() . "');</script>";
            }
        } else {
            echo "<script>alert('Connexion à la base de données impossible.');</script>";
        }
    }
}
