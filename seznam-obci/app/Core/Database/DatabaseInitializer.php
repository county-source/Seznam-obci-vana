<?php

declare(strict_types=1);

namespace App\Core\Database;

use Nette\Database\Explorer;
use PDO;
use RuntimeException;

final class DatabaseInitializer
{
        public function __construct(
                private readonly Explorer $database,
                private readonly string $schemaFile,
        ) {
        }

        public function initialize(): void
        {
                $pdo = $this->database->getConnection()->getPdo();
                if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) !== 'sqlite') {
                        return;
                }

                $statement = $pdo->query("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'regions'");
                if ($statement !== false && $statement->fetchColumn() !== false) {
                        return;
                }

                $sql = file_get_contents($this->schemaFile);
                if ($sql === false) {
                        throw new RuntimeException(sprintf('Soubor se schématem databáze %s se nepodařilo načíst.', $this->schemaFile));
                }

                $pdo->exec($sql);
        }
}
