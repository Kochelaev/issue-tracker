<?php

namespace Models;

use App\Database;

abstract class BaseModel
{
    protected $db;
    protected $table;
    protected $fillables;
    protected $sorters;

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

    public function getCount(): ?int
    {
        $query = "SELECT COUNT(id) FROM $this->table;";
        return $this->db->query($query)->fetch()[0];
    }

    public function getForPage(?int $page = 1, ?string $order = 'id', int $perPage = null): array
    {
        $page = $page ?: 1;
        if (is_array($this->sorters))
            $order = in_array($order, $this->sorters) ? $order : 'id';
        else $order = 'id';
        $perPage = $perPage ?: getenv('PER_PAGE');
        $start = $perPage * ($page - 1);

        $query =  "SELECT * FROM $this->table
        ORDER BY `$order`            -- `` подходят только для MySQL?
        LIMIT $start, $perPage;";

        $result = $this->db->query($query);
        if ($result)
            return $result->fetchAll();
        else return [];
    }

    public function find($id): array
    {
        $query = "SELECT * FROM $this->table WHERE id = '$id';";

        $response = $this->db->query($query);
        $result = $response->fetch();
        if ($result === false)
            $result = [];
        return $result;
    }

    public function insert(array $modelData): self
    {
        $modelData = array_intersect_key($modelData, array_flip($this->fillables));
        $preparedKeys = implode(', :', array_keys($modelData));
        $keys = implode(',', array_keys($modelData));

        $query = "INSERT INTO $this->table ($keys) VALUES (:$preparedKeys);";

        $prepare = $this->db->prepare($query);
        $prepare->execute($modelData);
        return $this;
    }

    public function update(int $id, $modelData)
    {
        $modelData = array_intersect_key($modelData, array_flip($this->fillables));
        $setString = '';
        foreach ($modelData as $key => $value) {
            $setString .= " `$key` =:$key,";
        }
        $setString = rtrim($setString, ',');
        
        $query = "UPDATE $this->table 
            SET $setString
            WHERE id = '$id';";

        $prepare = $this->db->prepare($query);
        return $prepare->execute($modelData);
    }
}
