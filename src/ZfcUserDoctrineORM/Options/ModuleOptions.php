<?php

namespace ZfcUserDoctrineORM\Options;

use ZfcUser\Options\ModuleOptions as BaseModuleOptions;

class ModuleOptions extends BaseModuleOptions
{
    /**
     * @var string
     */
    protected $userEntityClass = 'ZfcUserDoctrineORM\Entity\User';

    /**
     * @var bool
     */
    protected $enableDefaultEntities = true;

    /**
     * @var bool
     */
    protected $enableEntities = true;

    /**
     * @param boolean $enableDefaultEntities
     */
    public function setEnableDefaultEntities($enableDefaultEntities)
    {
        $this->enableDefaultEntities = $enableDefaultEntities;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getEnableDefaultEntities()
    {
        return $this->enableDefaultEntities;
    }

    /**
     * @param boolean $enableEntities
     */
    public function setEnableEntities($enableEntities)
    {
        $this->enableEntities = $enableEntities;
    }

    /**
     * @return boolean
     */
    public function getEnableEntities()
    {
        return $this->enableEntities;
    }
}
