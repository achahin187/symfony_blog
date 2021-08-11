<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements  UserInterface,\Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $password;

        /**
     * @ORM\Column(type="string", length=200)
     */
    private $fullName;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getfullName(): ?string
    {
        return $this->fullName;
    }

    public function setfullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
        return null;

    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
        $this->id,
        $this->username,
        $this->password,
         
        ));
    }

        /** @see \Serializable::unserialize() */


        public function unserialize($serialized)
        {
            list (
            $this->id,
            $this->username,
            $this->password,
             
            ) = unserialize($serialized,array('allowed_classes'=> false));
        }


}
