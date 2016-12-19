<?php

namespace Bank\Generator;

use Bank\Bank;
use Bank\DataStore\AdapterInterface;

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
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->conn = $adapter->getConnection();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function run($schema): bool
    {
        $tables = $this->getTable();

        if (!$tables) {
            return true;
        }

        foreach ($tables as $table) {
            $name = $table . '.php';
            $columns = $this->getColumns($table);
            $this->output($schema . $name, $this->getTemplate($columns));
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
     */
    private function output($file, $code)
    {

        $filePoint = fopen($file, 'w+');
        fwrite($filePoint, $code);
        fclose($filePoint);
    }


}