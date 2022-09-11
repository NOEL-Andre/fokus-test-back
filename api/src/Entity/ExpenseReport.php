<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Config\ExpenseReportType;
use App\Repository\ExpenseReportRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\EventListener\ExpenseReportListener;

#[ApiResource]
#[ORM\EntityListeners([ExpenseReportListener::class])]
#[ORM\Entity(repositoryClass: ExpenseReportRepository::class)]
class ExpenseReport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $paymentDate = null;

    #[ORM\Column(nullable: true)]
    private ?float $amount = null;

    #[ORM\Column(type: Types::STRING, enumType: ExpenseReportType::class)]
    private ExpenseReportType $type;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThanOrEqual(propertyPath: 'paymentDate')]
    private ?\DateTimeInterface $recordDate = null;

    #[ORM\ManyToOne(inversedBy: 'expenseReports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $refundUser = null;

    #[ORM\ManyToOne(inversedBy: 'expenseReports')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $refundCompany = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(?\DateTimeInterface $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getType(): ExpenseReportType
    {
        return $this->type;
    }


    public function setType(ExpenseReportType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getRecordDate(): ?\DateTimeInterface
    {
        return $this->recordDate;
    }

    public function setRecordDate(\DateTimeInterface $recordDate): self
    {
        $this->recordDate = $recordDate;

        return $this;
    }

    public function getRefundUser(): ?User
    {
        return $this->refundUser;
    }

    public function setRefundUser(?User $refundUser): self
    {
        $this->refundUser = $refundUser;

        return $this;
    }

    public function getRefundCompany(): ?Company
    {
        return $this->refundCompany;
    }

    public function setRefundCompany(?Company $refundCompany): self
    {
        $this->refundCompany = $refundCompany;

        return $this;
    }
}
