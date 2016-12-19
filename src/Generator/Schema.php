<?php

namespace Bank\Generator;

use Bank\Bank;

/**
 * Class Schema
 * @package Generator
 */
class Schema
{

    /**
     * @var \Bank\DataStore\ConnectionInterface
     */
    private $conn;

    /**
     * Schema constructor.
     */
    public function __construct()
    {
        $adapter = Bank::adapter();
        $this->conn = $adapter->getConnection();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function run(): bool
    {
        $tables = $this->getTable();

        if (!$tables) {
            return true;
        }

        $schema = Bank::getConfig('schema');

        foreach ($tables as $table) {
            $name = $table . '.php';
            $columns = $this->getColumns($table);
            $this->output($schema . $name, $this->getTemplate($columns), true);
        }

        return true;
    }

    /**
     * @return array
     */
    private function getTable(): array
    {
        /** @var \PDOStatement $result */
        $result = $this->conn->query('SHOW TABLES');

        return array_map(function ($row) {
            return array_shift($row);
        }, $result->fetchAll());
    }

    /**
     * @param $table
     * @return array
     */
    private function getColumns($table)
    {
        return array_map(function ($row) {
            return [
                'field' => $row['Field'],
                'key' => $row['Key']
            ];
        }, $this->conn->query("SHOW FULL COLUMNS FROM {$table}")->fetchAll());
    }

    /**
     * @param $columns
     * @return string
     */
    private function getTemplate($columns): string
    {
        list($primaryKey, $record) = $this->build($columns);

        return <<<EOD
<?php

return [
    'primary_key' => '{$primaryKey}',
    'record' => ['{$record}']
];
EOD;

    }

    /**
     * @param $columns
     * @return array
     */
    private function build($columns)
    {
        $primaryKey = null;
        $record = [];

        foreach ($columns as $row) {

            if ($row['key'] == 'PRI') {
                $primaryKey = $row['field'];
            }

            $record[] = $row['field'];
        }

        return [
            $primaryKey,
            implode("','", $record)
        ];

    }

    /**
     * @param $file
     * @param $code
     * @param bool|false $override
     */
    private function output($file, $code, $override = false)
    {
        if (file_exists($file) && $override === false) {
            return;
        }
        $fp = fopen($file, 'w+');
        fwrite($fp, $code);
        fclose($fp);
    }


}