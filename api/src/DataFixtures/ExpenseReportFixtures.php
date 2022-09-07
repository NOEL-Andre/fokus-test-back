<?php

namespace App\DataFixtures;


use App\Config\ExpenseReportType;
use App\Entity\Company;
use App\Entity\ExpenseReport;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExpenseReportFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        /** @var User $user */
        $user = $this->getReference(UserFixtures::USER_REFERENCE);

        /** @var Company $company */
        $company = $this->getReference(CompanyFixtures::DEFAULT_COMPANY_REFERENCE);

        for ($i = 0; $i < 10; $i++) {
            $expenseReport = (new ExpenseReport())
                ->setRefundUser($user)
                ->setRefundCompany($company)
                ->setPaymentDate(new \DateTime())
                ->setAmount(random_int(2, 50))
                ->setType(ExpenseReportType::essence)
                ->setRecordDate(new \DateTime())
            ;
            $manager->persist($expenseReport);
        }
        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CompanyFixtures::class,
        ];
    }
}
