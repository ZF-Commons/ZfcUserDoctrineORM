<?php

namespace ZfcUserDoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\User;

/**
 * User
 *
 * @ORM\MappedSuperclass
 * @ORM\Table(name="user")
 */
abstract class MappedSuperclassUser extends User
{
	/**
	 * @var int
	 * 
	 * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="username", type="string", length=100, nullable=false) 
	 */
	protected $username;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="email", type="string", length=100, nullable=false) 
	 */
	protected $email;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="displayName", type="string", length=100, nullable=false)
	 */
	protected $displayName;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="password", type="string", length=100, nullable=false)
	 */
	protected $password;
	
	/**
	 * @var int
	 * 
	 * @ORM\Column(name="state", type="integer")
	 */
	protected $state;
	
	/**
	 * Get id.
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set id.
	 *
	 * @param int $id
	 * @return UserInterface
	 */
	public function setId($id)
	{
		$this->id = (int) $id;
		return $this;
	}
	
	/**
	 * Get username.
	 *
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}
	
	/**
	 * Set username.
	 *
	 * @param string $username
	 * @return UserInterface
	 */
	public function setUsername($username)
	{
		$this->username = $username;
		return $this;
	}
	
	/**
	 * Get email.
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * Set email.
	 *
	 * @param string $email
	 * @return UserInterface
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}
	
	/**
	 * Get displayName.
	 *
	 * @return string
	 */
	public function getDisplayName()
	{
		return $this->displayName;
	}
	
	/**
	 * Set displayName.
	 *
	 * @param string $displayName
	 * @return UserInterface
	 */
	public function setDisplayName($displayName)
	{
		$this->displayName = $displayName;
		return $this;
	}
	
	/**
	 * Get password.
	 *
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}
	
	/**
	 * Set password.
	 *
	 * @param string $password
	 * @return UserInterface
	 */
	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}
	
	/**
	 * Get state.
	 *
	 * @return int
	 */
	public function getState()
	{
		return $this->state;
	}
	
	/**
	 * Set state.
	 *
	 * @param int $state
	 * @return UserInterface
	 */
	public function setState($state)
	{
		$this->state = $state;
		return $this;
	}
}
