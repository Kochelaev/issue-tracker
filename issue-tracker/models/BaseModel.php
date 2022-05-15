<?php

namespace Models;

use App\Database;

abstract class BaseModel
{
    protected $db;
    protected $table;
    protected $fillables;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM $this->table ORDER BY 'id' DESC";
        if ($response = $this->db->query($query))
            return $response->fetchAll();
        else return [];
    }

    public function insert(array $modelData): self
    {
        $modelData = array_intersect_key($modelData, array_flip($this->fillables));
        $preparedKeys = implode(', :', array_keys($modelData));
        $keys = implode(',', array_keys($modelData));
        $query = "INSERT INTO $this->table ($keys) VALUES (:$preparedKeys);"; //;
        $prepare = $this->db->prepare($query);
        $prepare->execute($modelData);
        return $this;
    }

    public function getForPage($page = 1, $perPage = null): array
    {
        $page = $page?:1;
        $perPage = $perPage?: getenv('PER_PAGE');
        $start = $perPage * ($page - 1);
        $query = "SELECT * FROM $this->table LIMIT $start, $perPage;";
        if ($response = $this->db->query($query))
            return $response->fetchAll();
        else return [];
    }

    public function getCount(): ?int
    {
        $query = "SELECT COUNT(id) FROM $this->table;";
        return $this->db->query($query)->fetch()[0];
    }
}
