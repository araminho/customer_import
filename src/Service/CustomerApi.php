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

    public function getFromApi(int $count, string $countryCode): array
    {
        try {
            $response = $this->client->request(
                'GET',
                self::URL,
                [
                    'query' => [
                        'results' => $count,
                        'nat' => $countryCode,
                        // 'seed' => 'constant_seed'    // uncomment this to get the same results after every request
                    ]
                ]
            );
            $content = json_decode($response->getContent(), true);
            if (!empty($content['error'])) {
                echo $content['error'];
                return [];
            }
            $content = $content['results'];

            $customerList = [];
            if (!empty($content)) {
                foreach ($content as $row) {
                    $customerList[] = [
                        'first_name' => $row['name']['first'],
                        'last_name' => $row['name']['last'],
                        'email' => $row['email'],
                        'country_code' => $row['nat'],
                        'username' => $row['login']['username'],
                        'gender' => $row['gender'],
                        'city' => $row['location']['city'],
                        'phone' => $row['phone'],
                    ];
                }
            }
        } catch (HttpExceptionInterface $e) {
            echo $e->getMessage();
            return [];
        }
        return $customerList;
    }

    public function insertToDb(array $customersList): array
    {
        $insertedCount = 0;
        $updatedCount = 0;
        if (!empty($customersList)) {
            foreach ($customersList as $customer) {
                if (!isset($customer['email']) || !isset($customer['first_name']) || !isset($customer['last_name'])
                    || !isset($customer['country_code']) || !isset($customer['username']) || !isset($customer['gender'])
                    || !isset($customer['city']) || !isset($customer['phone'])
                ) {
                    continue;
                }
                $existingCustomer = $this->em->getRepository(Customer::class)
                    ->findBy(['email' => $customer['email']]);

                if (!empty($existingCustomer)) {
                    $customerObject = $existingCustomer[0];
                    $updatedCount++;
                } else {
                    $customerObject = new Customer();
                    $customerObject->setEmail($customer['email']);
                    $insertedCount++;
                }

                $customerObject->setFirstName($customer['first_name']);
                $customerObject->setLastName($customer['last_name']);
                $customerObject->setCountryCode($customer['country_code']);
                $customerObject->setUsername($customer['username']);
                $customerObject->setGender($customer['gender']);
                $customerObject->setCity($customer['city']);
                $customerObject->setPhone($customer['phone']);

                $this->em->persist($customerObject);
                $this->em->flush();
            }
        }
        return [
            'inserted' => $insertedCount,
            'updated' => $updatedCount,
        ];
    }
}