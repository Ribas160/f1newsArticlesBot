<?php 

namespace App\Core;

use SQLite3;

class Db extends SQLite3 
{
    

    /**
     * Db constructor
     */
    public function __construct()
    {
        $config = App::getConfig();
        foreach ($config['databases'] as $database) {
            $this->open(dirname(__FILE__, 3) . '/' . $database['name']);
            $this->create($database['tables']);
        }
    }


    /**
     * @param array $tables
     * @return void
     */
    private function create(array $tables): void
    {
        foreach ($tables as $table => $rows) {
            $query = "CREATE TABLE IF NOT EXISTS " . $table .  " (id INTEGER PRIMARY KEY, ";
            foreach ($rows as $title => $row) {
                $query .= "$title " . strtoupper($row['type']);
                if ($row['default']) $query .= " DEFAULT " . strtoupper($row['default']);
                $query .= ', ';
            }

            $query = substr($query, 0, -2) . ')';
            $this->exec($query);
        }
    }


    /**
     * @param string $queryString
     * @param array $placeholders
     * @return array|void
     */
    public function request(string $queryString, array $placeholders = []): ?array
    {
        $query = $this->prepare($queryString);
        if ($placeholders) foreach ($placeholders as $key => $value) $query->bindValue(":$key", $value);
        $rows = $query->execute();

        if (strpos($queryString, 'SELECT') !== false) {
            $respose = [];

            while ($row = $rows->fetchArray()) {
                $respose[] = $row;
            }

            return $respose;
        } else return NULL;
    }
}