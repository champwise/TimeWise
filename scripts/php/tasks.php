<?php


class Task
{
	
	// constructor to establish database connection if there isn't one already
	public function __construct($db=NULL)
	{
		if(is_object($db))
		{
			$this->_db = $db;
		}
		else
		{
			$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
			$this->_db = new PDO($dsn, DB_USER, DB_PASS);
		}
	}

    // function to create a new task
	public function createTask($username, $list, $task)
	{

	    //create digest of the form submission:
		$messageIdent = md5($list . $task );

		//if $_SESSION[messageindent] is set, set $sessionMessageIdent equal to it else set it as an empty string
		$sessionMessageIdent = isset($_SESSION['messageIdent'])?$_SESSION['messageIdent']:'';

		// check the session indent so the user doesnt create the task twice on refresh
		if($messageIdent!=$sessionMessageIdent){

	        //save the session var:
			$_SESSION['messageIdent'] = $messageIdent;


		    	// count the number of lists with the posted list name
			$sql = "SELECT COUNT(id) AS theCount
			FROM lists
			WHERE list_name = :list_name
			AND user_id = (SELECT id
			FROM users
			WHERE username = :username)";

		    	//  If sql statement is prepared by database without errors
			if($stmt = $this->_db->prepare($sql)) {
	                //  Bind $username object to :username parameter in sql statement
				$stmt->bindParam(":username", $username, PDO::PARAM_STR);
	                //  Bind $list object to :list_name parameter in sql statement
				$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
	                //  Execute sql statement
				$stmt->execute();
	                //  Fetches row from executed sql statement and stores it in array
				$row = $stmt->fetch();
	                // close cursor so another sql command can be issued
				$stmt->closeCursor();

				if($row['theCount']==0) {

	                	// create a list with the list name posted from form
					$sql = "INSERT INTO lists(user_id, list_name)
					SELECT id, :list_name
					FROM users
					WHERE username = :username";

	                	//  If sql statement is prepared by database without errors
					if($stmt = $this->_db->prepare($sql)) {
			                //  Bind $username object to :username parameter in sql statement
						$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			                //  Bind $list object to :list_name parameter in sql statement
						$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
			                //  Execute sql statement
						$stmt->execute();
			                // close cursor so another sql command can be issued
						$stmt->closeCursor();


			                // create a tas with the task text posted from form
						$sql = "INSERT INTO tasks(list_id, task_text)
						SELECT id, :task_text
						FROM lists
						WHERE user_id = (SELECT id
						FROM users
						WHERE username = :username)
						AND list_name = :list_name";

		                	//  If sql statement is prepared by database without errors
						if($stmt = $this->_db->prepare($sql)) {
					            //  Bind $username object to :username parameter in sql statement
							$stmt->bindParam(":username", $username, PDO::PARAM_STR);
					            //  Bind $task object to :task_text parameter in sql statement
							$stmt->bindParam(":task_text", $task, PDO::PARAM_STR);
					            //  Bind $list object to :list_name parameter in sql statement
							$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
					            //  Execute sql statement
							$stmt->execute();
					            // close cursor so another sql command can be issued
							$stmt->closeCursor();
						}
					}
				}

				else{

	                	// create a tas with the task text posted from form
					$sql = "INSERT INTO tasks(list_id, task_text)
					SELECT id, :task_text
					FROM lists
					WHERE user_id = (SELECT id
					FROM users
					WHERE username = :username)
					AND list_name = :list_name";

	                	//  If sql statement is prepared by database without errors
					if($stmt = $this->_db->prepare($sql)) {
				            //  Bind $username object to :username parameter in sql statement
						$stmt->bindParam(":username", $username, PDO::PARAM_STR);
				            //  Bind $task object to :task_text parameter in sql statement
						$stmt->bindParam(":task_text", $task, PDO::PARAM_STR);
				            //  Bind $list object to :list_name parameter in sql statement
						$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
				            //  Execute sql statement
						$stmt->execute();
				            // close cursor so another sql command can be issued
						$stmt->closeCursor();
					}
				}
			}		
		}
	}


	// function to delete
	public function deleteTask($username, $list, $task){

		// sql statement that get all the users tasks for the list name given
		$sql = "DELETE FROM tasks
		WHERE task_text = :task_text
		AND list_id = (SELECT id 
		FROM lists
		WHERE list_name = :list_name
		AND user_id = (SELECT id
		FROM users
		WHERE username = :username))";

		//  If sql statement is prepared by database without errors
		if($stmt = $this->_db->prepare($sql)) {
			//  Bind $username object to :username parameter in sql statement
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			//  Bind $list object to :list_name parameter in sql statement
			$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
			//  Bind $task object to :list_name parameter in sql statement
			$stmt->bindParam(":task_text", $task, PDO::PARAM_STR);
			//  Execute sql statement
			$stmt->execute();
			// close cursor so another sql command can be issued
			$stmt->closeCursor();
			// encode array as json and echo back to planner.js
		}
	}

	public function getTasks($username, $list){
					// sql statement that get all the users tasks for the list name given
		$sql = "SELECT task_text, task_done
		FROM tasks
		WHERE list_id = (SELECT id 
		FROM lists
		WHERE list_name = :list_name
		AND user_id = (SELECT id
		FROM users
		WHERE username = :username))";

		//  If sql statement is prepared by database without errors
		if($stmt = $this->_db->prepare($sql)) {
			//  Bind $u object to :username parameter in sql statement
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			//  Bind $l object to :list_name parameter in sql statement
			$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
			//  Execute sql statement
			$stmt->execute();
			// save all returned data into array
			$array = array_values($stmt->fetchAll());
			// close cursor so another sql command can be issued
			$stmt->closeCursor();
			// encode array as json and echo back to planner.js
			echo json_encode($array);
		}
	}


	public function editTask($username, $list, $task, $edited){

		// sql statement that get all the users tasks for the list name given
		$sql = "UPDATE tasks
		SET task_text = :edited
		WHERE task_text = :task_text
		AND list_id = (SELECT id 
		FROM lists
		WHERE list_name = :list_name
		AND user_id = (SELECT id
		FROM users
		WHERE username = :username))";

		//  If sql statement is prepared by database without errors
		if($stmt = $this->_db->prepare($sql)) {
			//  Bind $u object to :username parameter in sql statement
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
			//  Bind $l object to :list_name parameter in sql statement
			$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
			//  Bind $task object to :list_name parameter in sql statement
			$stmt->bindParam(":task_text", $task, PDO::PARAM_STR);
			//  Execute sql statement
			$stmt->bindParam(":edited", $edited, PDO::PARAM_STR);
			//  Execute sql statement
			$stmt->execute();
			// close cursor so another sql command can be issued
			$stmt->closeCursor();
		}


	}


	public function markAsComplete($username, $list, $task){


		// returns the vale of the task_done column of the task
		$sql = "SELECT task_done 
		FROM tasks
		WHERE task_text = :task_text
		AND list_id = (SELECT id 
		FROM lists
		WHERE list_name = :list_name
		AND user_id = (SELECT id
		FROM users
		WHERE username = :username))";

		//  If sql statement is prepared by database without errors
		if($stmt = $this->_db->prepare($sql)) {
            //  Bind $u object to :username parameter in sql statement
			$stmt->bindParam(":username", $username, PDO::PARAM_STR);
            //  Bind $l object to :list_name parameter in sql statement
			$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
			//  Bind $task object to :list_name parameter in sql statement
			$stmt->bindParam(":task_text", $task, PDO::PARAM_STR);
            //  Execute sql statement
			$stmt->execute();
            //  Fetches row from executed sql statement and stores it in array
			$row = $stmt->fetch();
            // close cursor so another sql command can be issued
			$stmt->closeCursor();
		}


		if($row['task_done']== 0){

			// sql statement that get all the users tasks for the list name given
			$sql = "UPDATE tasks
			SET task_done = 1
			WHERE task_text = :task_text
			AND list_id = (SELECT id 
			FROM lists
			WHERE list_name = :list_name
			AND user_id = (SELECT id
			FROM users
			WHERE username = :username))";

			//  If sql statement is prepared by database without errors
			if($stmt = $this->_db->prepare($sql)) {
				//  Bind $u object to :username parameter in sql statement
				$stmt->bindParam(":username", $username, PDO::PARAM_STR);
				//  Bind $l object to :list_name parameter in sql statement
				$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
				//  Bind $task object to :list_name parameter in sql statement
				$stmt->bindParam(":task_text", $task, PDO::PARAM_STR);
				//  Execute sql statement
				$stmt->execute();
				// close cursor so another sql command can be issued
				$stmt->closeCursor();
			}
		}

		else{

			// sql statement that get all the users tasks for the list name given
			$sql = "UPDATE tasks
			SET task_done = 0
			WHERE task_text = :task_text
			AND list_id = (SELECT id 
			FROM lists
			WHERE list_name = :list_name
			AND user_id = (SELECT id
			FROM users
			WHERE username = :username))";

			//  If sql statement is prepared by database without errors
			if($stmt = $this->_db->prepare($sql)) {
				//  Bind $u object to :username parameter in sql statement
				$stmt->bindParam(":username", $username, PDO::PARAM_STR);
				//  Bind $l object to :list_name parameter in sql statement
				$stmt->bindParam(":list_name", $list, PDO::PARAM_STR);
				//  Bind $task object to :list_name parameter in sql statement
				$stmt->bindParam(":task_text", $task, PDO::PARAM_STR);
				//  Execute sql statement
				$stmt->execute();
				// close cursor so another sql command can be issued
				$stmt->closeCursor();
			}
		}
	}
}



?>