<?php
require_once "BaseService.php";
require_once __DIR__ . "/../dao/UserDao.php";
class UserService extends BaseService
{
    public function __construct()
    {
        $this->dao = new UserDao();
    }
    public function getUserById($userId)
    {
        $user = $this->dao->get_by_id($userId);
        if (!$user) {
            throw new Exception("User not found");
        }
        return $user;
    }
    public function getUserByEmail($userEmail)
    {
        $user = $this->dao->get_by_email($userEmail);
        if (!$user) {
            throw new Exception("User not found");
        }
        return $user;
    }
    public function createUser($data)
    {
        $emailRegex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

        if (!preg_match($emailRegex, $data['email'])) {
            throw new Exception("Invalid email. Try again please.");
        }

        if (empty($data['username'])) {
            throw new Exception("Username cannot be empty");
        }

        if (empty($data['email'])) {
            throw new Exception("Email cannot be empty");
        }

        if (empty($data["password"])) {
            throw new Exception("Password cannot be empty");
        }
        $existingUser = $this->dao->get_by_email($data["email"]);
        if ($existingUser) {
            throw new Exception("Username or email is already taken.");
        }
        $hashed_password = password_hash(password: $data["password"], algo: PASSWORD_DEFAULT);
        $new_user = [
            "username" => $data["username"],
            "password" => $hashed_password,
            "e-mail" => $data["e-mail"],
            "personality_type_id" => $data["personality_type_id"],
            "review_id" => $data["personality_type_id"]
        ];

        $this->dao->create_user($new_user);
    }
    public function deleteUser($id)
    {
        $user = $this->dao->get_by_id($id);
        if (!$user)
            throw new Exception("User not found");
        $this->dao->delete_user($id);

    }
    public function updateUser($id, $data)
    {
        $user = $this->dao->get_by_id($id);
        if (!$user)
            throw new Exception("User not found");
        if (empty($data["username"])) {
            throw new Exception("Username cannot be empty!");
        }

        if (empty($data["e-mail"])) {
            throw new Exception("E-mail cannot be empty!");
        }

        if (empty($data["personality_type_id"])) {
            throw new Exception("Personality type cannot be empty!");
        }

        if (empty($data["review_id"])) {
            throw new Exception("Review cannot be empty!");
        }

        if (empty($data["password"])) {
            throw new Exception("Password cannot be empty!");
        }

        if (!empty($data['username'])) {
            $conflictingUser = $this->dao->get_by_id($id);

            if ($conflictingUser && $conflictingUser['id'] !== $id) {
                throw new Exception("Username or email is already taken!");
            }
        }
        $this->dao->update_user($id, $data);
    }
}
?>