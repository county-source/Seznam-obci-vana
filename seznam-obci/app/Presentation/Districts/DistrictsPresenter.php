<?php

declare(strict_types=1);

namespace App\Presentation\Districts;

use App\Core\Repository\DistrictsRepository;
use App\Core\Repository\RegionsRepository;
use Nette;

final class DistrictsPresenter extends Nette\Application\UI\Presenter
{
        #[Nette\Application\Attributes\Persistent]
        public ?int $regionId = null;

        public function __construct(
                private readonly DistrictsRepository $districts,
                private readonly RegionsRepository $regions,
        ) {
                parent::__construct();
        }

        public function actionDefault(): void
        {
                if ($this->regionId === null) {
                        $this->flashMessage('Nejprve vyberte kraj.', 'warning');
                        $this->regionId = null;
                        $this->redirect('Regions:default', ['regionId' => null]);
                }

                $region = $this->regions->findById($this->regionId);
                if ($region === null) {
                        $this->flashMessage('Zvolený kraj nebyl nalezen.', 'danger');
                        $this->regionId = null;
                        $this->redirect('Regions:default', ['regionId' => null]);
                }

                $this->template->region = $region;
                $this->template->districts = $this->districts->findByRegion((int) $region->id);
        }
}
