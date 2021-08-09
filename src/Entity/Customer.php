<?php
/**
 * Created by PhpStorm.
 * User: Aram
 * Date: 05/08/2021
 * Time: 20:08
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "customers")
 */
class Customer
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type = "string", length = 100)
     */
    private $firstName;

    /**
     * @ORM\Column(type = "string", length = 100)
     */
    private $lastName;

    /**
     * @ORM\Column(type = "string", length = 100)
     */
    private $email;

    /**
     * @ORM\Column(type = "string", length = 2)
     */
    private $countryCode;

    /**
     * @ORM\Column(type = "string", length = 100)
     */
    private $username;

    /**
     * @ORM\Column(type = "string", length = 100)
     */
    private $gender;

    /**
     * @ORM\Column(type = "string", length = 100)
     */
    private $city;

    /**
     * @ORM\Column(type = "string", length = 100)
     */
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
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

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}