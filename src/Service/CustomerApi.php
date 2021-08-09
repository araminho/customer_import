<?php
/**
 * Created by PhpStorm.
 * User: Aram
 * Date: 09/08/2021
 * Time: 12:39
 */

namespace App\Service;

use App\Entity\Customer;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Doctrine\ORM\EntityManagerInterface;

class CustomerApi
{
    const URL = 'https://randomuser.me/api';

    private $client;
    private $em;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $em)
    {
        $this->client = $client;
        $this->em = $em;
    }

    public function import(int $count, string $countryCode): bool
    {
        try {
            $response = $this->client->request(
                'GET',
                self::URL,
                [
                    'query' => [
                        'results' => $count,
                        'nat' => $countryCode,
                    ]
                ]
            );
            $content = json_decode($response->getContent(), true);
            if (!empty($content['error'])) {
                echo $content['error'];
                return false;
            }
            $content = $content['results'];

            foreach ($content as $customer) {
                $existingCustomer = $this->em->getRepository(Customer::class)
                    ->findBy(['email' => $customer['email']]);

                if (!empty($existingCustomer)) {
                    $customerObject = $existingCustomer[0];
                } else {
                    $customerObject = new Customer();
                    $customerObject->setEmail($customer['email']);
                }

                $customerObject->setFirstName($customer['name']['first']);
                $customerObject->setLastName($customer['name']['last']);
                $customerObject->setCountryCode($customer['nat']);
                $customerObject->setUsername($customer['login']['username']);
                $customerObject->setGender($customer['gender']);
                $customerObject->setCity($customer['location']['city']);
                $customerObject->setPhone($customer['phone']);

                $this->em->persist($customerObject);
                $this->em->flush();
            }

        } catch (HttpExceptionInterface $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }
}