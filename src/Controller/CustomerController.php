<?php
/**
 * Created by PhpStorm.
 * User: Aram
 * Date: 05/08/2021
 * Time: 21:11
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Customer;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomerController extends AbstractController
{
    public function index(): JsonResponse
    {
        $query = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->createQueryBuilder('c')
            ->select(["c.id", "CONCAT(c.firstName, ' ', c.lastName) as fullName", "c.email", "c.countryCode"])
            ->getQuery();
        $customers = $query->getArrayResult();
        if ($customers) {
            return new JsonResponse(['data' => $customers]);
        } else {
            return new JsonResponse(['error' => 'No data']);
        }

    }

    public function show(int $id): JsonResponse
    {
        $customer = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->createQueryBuilder('c')
            ->select(["c.id", "CONCAT(c.firstName, ' ', c.lastName) as fullName", "c.email", "c.countryCode",
                "c.username", "c.gender", "c.city", "c.phone"])
            ->where('c.id=:id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
        if ($customer) {
            return new JsonResponse(['data' => $customer]);
        } else {
            return new JsonResponse(['error' => 'Not found'], 404);
        }
    }
}