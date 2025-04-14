<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use ApiSkeletons\Doctrine\GraphQL\Annotation as GraphQL;

#[GraphQL\Entity]
#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    #[GraphQL\Field(type: "ID")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    #[GraphQL\Field(type: "String")]
    private string $userName;

    #[ORM\Column(type: "string", length: 255)]
    #[GraphQL\Field(type: "String")]
    private string $userSurname;

    #[ORM\Column(type: "string", length: 255)]
    #[GraphQL\Field(type: "String")]
    private string $email;

    #[ORM\Column(type: "string", length: 255)]
    #[GraphQL\Field(type: "String")]
    private string $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
        return $this;
    }

    public function getUserSurname(): string
    {
        return $this->userSurname;
    }

    public function setUserSurname(string $userSurname): self
    {
        $this->userSurname = $userSurname;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    
}