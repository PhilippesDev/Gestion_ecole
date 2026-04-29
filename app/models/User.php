<?php

require_once "./core/Model.php";

class User extends Model
{
    public $id;
    public $username;
    protected $email;
    private $password;
   
    public function createUser($username, $email, $password)
     {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);  

        $request = $this->db->prepare("INSERT INTO users(nom, email, mot_de_passe) VALUES (?, ?, ?)");
        $request->execute([$this->username, $this->email, $this->password]);
     }

     public function updateUser($id, $username, $email, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);  

        $request = $this->db->prepare("UPDATE users SET nom =?, email =?, mot_de_passe =? WHERE id =?");
        $request->execute([$this->username, $this->email, $this->password, $this->id]);
     }

     public function deleteUser($id)
     {
        $this->id = $id;
        $request = $this->db->prepare("DELETE FROM users WHERE id =?");
        $request->execute([$this->id]);
     }

      public function getAllUsers()
      {
         $request = $this->db->prepare("SELECT * FROM users");
         $request->execute([]);
         return $request->fetchAll();
      }

      public function searchUser($keyword)
      {
         $request = $this->db->prepare("SELECT * FROM users WHERE CONCAT(nom, email) LIKE ?");
         $request->execute(["%$keyword%"]);
         return $request->fetchAll();
      }

      public function login($usernameOremail, $password)
      {
         if($usernameOremail  == null || $usernameOremail == "") return false;

         $request = $this->db->prepare("SELECT mot_de_passe FROM users WHERE nom =? OR email=?");
         $request->execute([$usernameOremail, $usernameOremail]);
         $passworhashed =  $request->fetch()["mot_de_passe"];

         if($passworhashed == null)   return false;

         if(password_verify($password, $passworhashed))
         {
            return true;
         }
         else
         {
            return false;
         }
      }
}
