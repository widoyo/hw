<?php

class UserMapper extends Mapper
{
    public function getUser() {
        $sql = "SELECT username,password, nama
            from user";
        $stmt = $this->db->query($sql);

        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new UserEntity($row);
        }
        return $results;
    }
	
	  public function save(UserEntity $user) {
        $sql = "insert into user
            (username, password, nama) values
            (:username, :password, :nama)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            "username" => $user->getUsername(),
            "password" => $user->getPassword(),
			"nama" 	   => $user->getNama(),
        ]);

        if(!$result) {
            throw new Exception("could not save record");
        }
    }

  public function getUserByUsername($username_id) {
        $sql = "SELECT *
            from user where username = :username_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["username_id" => $username_id]);

        return new UserEntity($stmt->fetch());
    }
	
	public function delete(UserEntity $user) {
		 $sql = "DELETE FROM user WHERE username=:username";
		 
				 $stmt = $this->db->prepare($sql);
				 $result = $stmt->execute([
				 "username" => $user->getUsername(),
				 ]);
				$db = null;
		}
	
}	
	

