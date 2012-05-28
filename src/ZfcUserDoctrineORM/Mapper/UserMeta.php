<?php

namespace ZfcUserDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use ZfcUser\Model\UserMetaInterface;
use ZfcUser\Module as ZfcUser;
use ZfcBase\Mapper\DoctrineMapperProxy;
use ZfcUser\Mapper\UserMetaInterface as UserMetaMapperInterface;

class UserMeta extends DoctrineMapperProxy implements UserMetaMapperInterface
{

    public function get($userId, $metaKey)
    {
        $om = $this->getObjectManager();
        $repository = $om->getRepository($this->getClassName());
        $userMeta = $repository->findOneBy(array('user' => $userId, 'meta_key' => $metaKey));
        $this->events()->trigger(__FUNCTION__, $this, array('model' => $userMeta, 'em' => $om));
        return $userMeta;
    }

    public function persist($userMeta)
    {
        $om = $this->getObjectManager();
        $this->events()->trigger(__FUNCTION__ . '.pre', $this, array('model' => $userMeta, 'om' => $om));
        $userMeta->setUser($om->merge($userMeta->getUser()));
        $om->persist($userMeta);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('model' => $userMeta, 'om' => $om));
        $om->flush();
    }

}
