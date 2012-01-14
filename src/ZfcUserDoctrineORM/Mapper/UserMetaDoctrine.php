<?php

namespace ZfcUserDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager,
    ZfcUser\Module as ZfcUser,
    ZfcUser\Model\UserMeta as UserMetaModel,
    ZfcUser\Model\Mapper\UserMeta as UserMetaMapper,
    ZfcBase\EventManager\EventProvider;

class UserMetaDoctrine extends EventProvider implements UserMetaMapper
{

    public function add(UserMetaModel $userMeta)
    {
        return $this->persist($userMeta);
    }

    public function update(UserMetaModel $userMeta)
    {
        return $this->persist($userMeta);
    }

    public function get($userId, $metaKey)
    {
        $em = $this->getEntityManager();
        $userMeta = $this->getUserMetaRepository()->findOneBy(array('user' => $userId, 'metaKey' => $metaKey));
        $this->events()->trigger(__FUNCTION__, $this, array('userMeta' => $userMeta, 'em' => $em));
        return $userMeta;
    }

    public function persist(UserMetaModel $userMeta)
    {
        $em = $this->getEntityManager();
        $this->events()->trigger(__FUNCTION__ . '.pre', $this, array('userMeta' => $userMeta, 'em' => $em));
        $userMeta->setUser($em->merge($userMeta->getUser()));
        $em->persist($userMeta);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('userMeta' => $userMeta, 'em' => $em));
        $em->flush();
    }

    public function getEntityManager()
    {
        return $this->em;
    }

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
        return $this;
    }

    public function getUserMetaRepository()
    {
    	$class = ZfcUser::getOption('usermeta_model_class');
        return $this->getEntityManager()->getRepository($class);
    }
}
