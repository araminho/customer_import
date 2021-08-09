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
}