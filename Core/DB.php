<?php

namespace PhpMvcFramework\Core;

class DB
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
     * @return DB
     */
    public static function table(string $name): DB
    {
        self::$table = $name;
        return new self();
    }

    public function where($column, $value, $operation = '=')
    {
        $this->where[] = $column . ' ' . $operation . ' "' . $value . '"';
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