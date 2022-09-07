<?php

namespace App\DataFixtures;


use App\Entity\Company;
use App\Entity\ExpenseReport;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyFixtures extends Fixture
{
    public const DEFAULT_COMPANY_REFERENCE = 'company';

    public function load(ObjectManager $manager): void
    {
        $company = (new Company())->setSocialReason('Company 1');
        $manager->persist($company);
        $this->addReference(self::DEFAULT_COMPANY_REFERENCE, $company);

        $company2 = (new Company())->setSocialReason('Company 2');
        $manager->persist($company2);

        $company3 = (new Company())->setSocialReason('Company 3');
        $manager->persist($company3);

        $manager->flush();

    }
}
