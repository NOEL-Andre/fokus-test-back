<?php

namespace App\EventListener;

use App\Entity\ExpenseReport;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

class ExpenseReportListener
{
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function prePersist(ExpenseReport $expenseReport): void
    {
        $expenseReport->setRecordDate((new DateTime()));
    }

}
