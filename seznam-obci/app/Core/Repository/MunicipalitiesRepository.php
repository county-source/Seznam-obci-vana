<?php

declare(strict_types=1);

namespace App\Core\Repository;

use Nette\Database\Explorer;
use Nette\Database\Table\Selection;

final class MunicipalitiesRepository
{
        public function __construct(
                private readonly Explorer $database,
        ) {
        }

        /**
         * @return Selection<\Nette\Database\Table\ActiveRow>
         */
        public function findByDistrict(int $districtId): Selection
        {
                return $this->database->table('municipalities')
                        ->where('district_id', $districtId)
                        ->order('name');
        }
}
