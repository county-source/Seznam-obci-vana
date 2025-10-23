<?php

declare(strict_types=1);

namespace App\Presentation\Regions;

use App\Core\Repository\RegionsRepository;
use Nette;

final class RegionsPresenter extends Nette\Application\UI\Presenter
{
        public function __construct(
                private readonly RegionsRepository $regions,
        ) {
                parent::__construct();
        }

        public function renderDefault(): void
        {
                $this->template->regions = $this->regions->findAll();
        }
}
