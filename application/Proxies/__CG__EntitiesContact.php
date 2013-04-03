<?php

namespace Proxies\__CG__\Entities;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Contact extends \Entities\Contact implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setPhone($phone)
    {
        $this->__load();
        return parent::setPhone($phone);
    }

    public function getPhone()
    {
        $this->__load();
        return parent::getPhone();
    }

    public function setMobile($mobile)
    {
        $this->__load();
        return parent::setMobile($mobile);
    }

    public function getMobile()
    {
        $this->__load();
        return parent::getMobile();
    }

    public function setFacilityaccess($facilityaccess)
    {
        $this->__load();
        return parent::setFacilityaccess($facilityaccess);
    }

    public function getFacilityaccess()
    {
        $this->__load();
        return parent::getFacilityaccess();
    }

    public function setMayauthorize($mayauthorize)
    {
        $this->__load();
        return parent::setMayauthorize($mayauthorize);
    }

    public function getMayauthorize()
    {
        $this->__load();
        return parent::getMayauthorize();
    }

    public function setLastupdated($lastupdated)
    {
        $this->__load();
        return parent::setLastupdated($lastupdated);
    }

    public function getLastupdated()
    {
        $this->__load();
        return parent::getLastupdated();
    }

    public function setLastupdatedby($lastupdatedby)
    {
        $this->__load();
        return parent::setLastupdatedby($lastupdatedby);
    }

    public function getLastupdatedby()
    {
        $this->__load();
        return parent::getLastupdatedby();
    }

    public function setCreator($creator)
    {
        $this->__load();
        return parent::setCreator($creator);
    }

    public function getCreator()
    {
        $this->__load();
        return parent::getCreator();
    }

    public function setCreated($created)
    {
        $this->__load();
        return parent::setCreated($created);
    }

    public function getCreated()
    {
        $this->__load();
        return parent::getCreated();
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setCustomer(\Entities\Customer $customer = NULL)
    {
        $this->__load();
        return parent::setCustomer($customer);
    }

    public function getCustomer()
    {
        $this->__load();
        return parent::getCustomer();
    }

    public function setPosition($position)
    {
        $this->__load();
        return parent::setPosition($position);
    }

    public function getPosition()
    {
        $this->__load();
        return parent::getPosition();
    }

    public function setUser(\Entities\User $user)
    {
        $this->__load();
        return parent::setUser($user);
    }

    public function getUser()
    {
        $this->__load();
        return parent::getUser();
    }

    public function addGroup(\Entities\ContactGroup $groups)
    {
        $this->__load();
        return parent::addGroup($groups);
    }

    public function removeGroup(\Entities\ContactGroup $groups)
    {
        $this->__load();
        return parent::removeGroup($groups);
    }

    public function getGroups()
    {
        $this->__load();
        return parent::getGroups();
    }

    public function setNotes($notes)
    {
        $this->__load();
        return parent::setNotes($notes);
    }

    public function getNotes()
    {
        $this->__load();
        return parent::getNotes();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'name', 'position', 'email', 'phone', 'mobile', 'facilityaccess', 'mayauthorize', 'notes', 'lastupdated', 'lastupdatedby', 'creator', 'created', 'id', 'User', 'Customer', 'Groups');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}