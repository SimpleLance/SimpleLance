<?php

namespace SimpleLance;

use PDOException;

/**
 * Class Projects
 * @package SimpleLance
 */
class Projects extends Mailer
{
    /**
     * @var
     */
    private $db;

    /**
     * @param $database
     */
    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * @param $name
     * @param $description
     * @param $owner
     * @param $status
     */
    public function newProject($name, $description, $owner, $status)
    {
        $query = $this->db->prepare("INSERT INTO projects (name, description, created_on, owner, status) VALUES (?, ?, ?, ?, ?)");

        $query->bindValue(1, $name);
        $query->bindValue(2, $description);
        $query->bindValue(3, date('Y-m-d H:i:s'));
        $query->bindValue(4, $owner);
        $query->bindValue(5, $status);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function listProjects()
    {
        $query = $this->db->prepare("SELECT * FROM projects ORDER BY ID DESC");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    /**
     * @param $id
     */
    public function deleteProject($id)
    {
        $query = $this->db->prepare("DELETE from projects where id = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProject($id)
    {
        $query = $this->db->prepare ("SELECT * from projects WHERE id = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die ($e->getMessage());
        }

        return $query->fetch();
    }

    /**
     * @param $name
     * @param $description
     * @param $owner
     * @param $status
     * @param $id
     */
    public function updateProject($name, $description, $owner, $status, $id)
    {
        $query = $this->db->prepare ("UPDATE projects SET name = ?, description = ?, owner = ?, status = ? WHERE id = ?");

        $query->bindValue(1, $name);
        $query->bindValue(2, $description);
        $query->bindValue(3, $owner);
        $query->bindValue(4, $status);
        $query->bindValue(5, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function listProjectTasks($id)
    {
        $query = $this->db->prepare ("SELECT * FROM project_tasks WHERE project = ? ORDER BY id DESC");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function listProjectNotes($id)
    {
        $query = $this->db->prepare ("SELECT * FROM project_notes WHERE project = ? ORDER BY id DESC");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    /**
     * @param $project_id
     * @param $name
     * @param $description
     * @param $status
     */
    public function newTask($project_id, $name, $description, $status)
    {
        $query = $this->db->prepare("INSERT INTO project_tasks (project, name, description, created_on, status) VALUES (?, ?, ?, ?, ?)");

        $query->bindValue(1, $project_id);
        $query->bindValue(2, $name);
        $query->bindValue(3, $description);
        $query->bindValue(4, date('Y-m-d H:i:s'));
        $query->bindValue(5, $status);

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTask($id)
    {
        $query = $this->db->prepare ("SELECT * from project_tasks WHERE id = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die ($e->getMessage());
        }

        return $query->fetch();
    }

    /**
     * @param $name
     * @param $description
     * @param $status
     * @param $id
     */
    public function updateTask($name, $description, $status, $id)
    {
        $query = $this->db->prepare ("UPDATE project_tasks SET name = ?, description = ?, status = ? WHERE id = ?");

        $query->bindValue(1, $name);
        $query->bindValue(2, $description);
        $query->bindValue(3, $status);
        $query->bindValue(4, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $project_id
     * @param $title
     * @param $details
     */
    public function newNote($project_id, $title, $details)
    {
        $query = $this->db->prepare("INSERT INTO project_notes (project, title, details, created_on) VALUES (?, ?, ?, ?)");

        $query->bindValue(1, $project_id);
        $query->bindValue(2, $title);
        $query->bindValue(3, $details);
        $query->bindValue(4, date('Y-m-d H:i:s'));;

        try {
            $query->execute();

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNote($id)
    {
        $query = $this->db->prepare ("SELECT * from project_notes WHERE id = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die ($e->getMessage());
        }

        return $query->fetch();
    }

    /**
     * @param $title
     * @param $details
     * @param $id
     */
    public function updateNote($title, $details, $id)
    {
        $query = $this->db->prepare ("UPDATE project_notes SET title = ?, details = ? WHERE id = ?");

        $query->bindValue(1, $title);
        $query->bindValue(2, $details);
        $query->bindValue(3, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $id
     */
    public function closeProject($id)
    {
        $query = $this->db->prepare ("UPDATE projects SET status = 'Closed' WHERE id = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $id
     */
    public function deleteProjectTasks($id)
    {
        $query = $this->db->prepare ("DELETE FROM project_tasks WHERE project = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $id
     */
    public function deleteProjectNotes($id)
    {
        $query = $this->db->prepare ("DELETE FROM project_notes WHERE project = ?");

        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $owner
     * @return mixed
     */
    public function showUserProjects($owner)
    {
        $query = $this->db->prepare ("SELECT * FROM projects WHERE owner = ?");

        $query->bindValue(1, $owner);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id= ?");
        $query->bindValue(1, $id);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetch();
    }
}
