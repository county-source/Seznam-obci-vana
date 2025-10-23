<?php

declare(strict_types=1);

namespace App\Core\Repository;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

final class RegionsRepository
{
        public function __construct(
                private readonly Explorer $database,
        ) {
        }

        /**
         * @return Selection<ActiveRow>
         */
        public function findAll(): Selection
        {
                return $this->database->table('regions')
                        ->order('name');
        }

        public function findById(int $regionId): ?ActiveRow
        {
                return $this->database->table('regions')->get($regionId);
        }
}
