<?php

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Config\ExpenseReportType;
use App\Entity\Company;
use App\Entity\ExpenseReport;
use App\Entity\User;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseReportTest extends ApiTestCase
{
    public function testGetNotes(): void
    {
        $response = static::createClient()->request(
            Request::METHOD_GET,
            '/expense_reports',
        );

        self::assertResponseStatusCodeSame(200);

        self::assertJsonContains([
            '@context' => '/contexts/ExpenseReport',
            '@id' => '/expense_reports',
            '@type' => 'hydra:Collection',
        ]);

        self::assertGreaterThan(0, $response->toArray()['hydra:totalItems']);
    }

    public function testGetNote(): void
    {
        $expenseReportIri = $this->findIriBy(ExpenseReport::class, []);

        $response = static::createClient()->request(
            Request::METHOD_GET,
            $expenseReportIri,
        );

        self::assertResponseStatusCodeSame(Response::HTTP_OK);

        $expenseReport = $response->toArray();

        self::assertArrayHasKey('id', $expenseReport);
        self::assertArrayHasKey('paymentDate', $expenseReport);
        self::assertArrayHasKey('amount', $expenseReport);
        self::assertArrayHasKey('type', $expenseReport);
        self::assertArrayHasKey('recordDate', $expenseReport);
        self::assertArrayHasKey('refundUser', $expenseReport);
        self::assertArrayHasKey('refundCompany', $expenseReport);
    }

    public function testCreateExpenseReport(): void
    {
        $userIri = $this->findIriBy(User::class, []);
        $companyIri = $this->findIriBy(Company::class, []);

        static::createClient()->request(
            Request::METHOD_POST,
            '/expense_reports',
            ['json' => [
                'refundUser' => $userIri,
                'refundCompany' => $companyIri,
                'paymentDate' => (new DateTime())->sub(new \DateInterval('P3D'))->format('Y-m-d'),
                'amount' => 50,
                'type' => ExpenseReportType::essence,
            ]]
        );

        self::assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }

    public function testUpdateExpenseReport(): void
    {
        $expenseReportIri = $this->findIriBy(ExpenseReport::class, []);

        static::createClient()->request(
            Request::METHOD_PUT,
            $expenseReportIri,
            [
                'json' => [
                    'amount' => 100,
                ]
            ]
        );

        self::assertResponseStatusCodeSame(Response::HTTP_OK);

        $response = static::createClient()->request(
            Request::METHOD_GET,
            $expenseReportIri,
        );

        self::assertResponseStatusCodeSame(Response::HTTP_OK);
        self::assertEquals(100, $response->toArray()['amount']);
    }

    // This test do not reset the database, so it will fail if you run it multiple times because of no more expense report
    public function testDeleteExpenseReport(): void
    {
        $expenseReport = $this->findIriBy(ExpenseReport::class, []);

        static::createClient()->request(
            Request::METHOD_DELETE,
            $expenseReport,
        );

        self::assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }
}
