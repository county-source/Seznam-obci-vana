<?php

declare(strict_types=1);

namespace App\Presentation\Municipalities;

use App\Core\Repository\DistrictsRepository;
use App\Core\Repository\MunicipalitiesRepository;
use App\Core\Repository\RegionsRepository;
use Nette;

final class MunicipalitiesPresenter extends Nette\Application\UI\Presenter
{
        #[Nette\Application\Attributes\Persistent]
        public ?int $regionId = null;

        #[Nette\Application\Attributes\Persistent]
        public ?int $districtId = null;

        public function __construct(
                private readonly MunicipalitiesRepository $municipalities,
                private readonly DistrictsRepository $districts,
                private readonly RegionsRepository $regions,
        ) {
                parent::__construct();
        }

        public function actionDefault(): void
        {
                if ($this->regionId === null) {
                        $this->flashMessage('Nejprve vyberte kraj.', 'warning');
                        $this->districtId = null;
                        $this->redirect('Regions:default', ['regionId' => null]);
                }

                if ($this->districtId === null) {
                        $this->flashMessage('Nejprve vyberte okres.', 'warning');
                        $this->redirect('Districts:default', ['regionId' => $this->regionId]);
                }

                $region = $this->regions->findById($this->regionId);
                if ($region === null) {
                        $this->flashMessage('Zvolený kraj nebyl nalezen.', 'danger');
                        $this->regionId = null;
                        $this->districtId = null;
                        $this->redirect('Regions:default', ['regionId' => null]);
                }

                $district = $this->districts->findById($this->districtId);
                if ($district === null) {
                        $this->flashMessage('Zvolený okres nebyl nalezen.', 'danger');
                        $this->districtId = null;
                        $this->redirect('Districts:default', ['regionId' => $region->id]);
                }

                if ((int) $district->region_id !== (int) $region->id) {
                        $this->flashMessage('Zadaný okres do vybraného kraje nepatří.', 'danger');
                        $this->districtId = null;
                        $this->redirect('Districts:default', ['regionId' => $region->id]);
                }

                $this->template->region = $region;
                $this->template->district = $district;
                $this->template->municipalities = $this->municipalities->findByDistrict((int) $district->id);
        }
}
