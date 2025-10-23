<?php

declare(strict_types=1);

namespace App\Core\Repository;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

final class DistrictsRepository
{
        public function __construct(
                private readonly Explorer $database,
        ) {
        }

        /**
         * @return Selection<ActiveRow>
         */
        public function findByRegion(int $regionId): Selection
        {
                return $this->database->table('districts')
                        ->where('region_id', $regionId)
                        ->order('name');
        }

        public function findById(int $districtId): ?ActiveRow
        {
                return $this->database->table('districts')->get($districtId);
        }
}
