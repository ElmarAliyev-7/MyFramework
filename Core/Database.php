<?php

namespace PhpMvcFramework\Core;

class Database
{
    public \PDO $db;
    public static string $table;
    public array $where = [];
    protected string $sql = '';

    public function __construct()
    {
        $this->db = new \PDO('mysql:host=localhost;dbname=myframework', 'root', '');
    }

    /**
     * @param $name
     * @return Database
     */
    public static function table($name): Database
    {
        self::$table = $name;
        return new self();
    }

    public function where($column, $value, $operations = '=')
    {
        $this->where[] = $column . ' ' . $operations . ' *' . $value . '*';
        return $this;
    }

    protected function prepareSql()
    {
        $this->sql = sprintf('SELECT * FROM %s', self::$table);
        if (count($this->where)) {
            $this->sql .= ' WHERE ' . implode(' && ', $this->where);
        }
    }

    /**
     * @return array
     */
    public function get()
    {
        $this->prepareSql();
        $query = $this->db->prepare($this->sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        $this->prepareSql();
        $query = $this->db->prepare($this->sql);
        $query->execute();
        return $query->fetch(\PDO::FETCH_OBJ);
    }
}