<?php

namespace Rizalmovic\Core\Repositories;

use Rizalmovic\Core\Contracts\SettingInterface;
use Rizalmovic\Core\Entities\Setting;

class SettingRepository extends BaseRepository implements SettingInterface
{
    public function __construct(Setting $model)
    {
        parent::__construct();
        $this->model = $model;
    }
}