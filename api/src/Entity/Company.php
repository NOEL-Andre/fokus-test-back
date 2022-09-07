<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $socialReason = null;

    #[ORM\OneToMany(mappedBy: 'refundCompany', targetEntity: ExpenseReport::class)]
    private Collection $expenseReports;

    public function __construct()
    {
        $this->expenseReports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSocialReason(): ?string
    {
        return $this->socialReason;
    }

    public function setSocialReason(string $socialReason): self
    {
        $this->socialReason = $socialReason;

        return $this;
    }

    /**
     * @return Collection<int, ExpenseReport>
     */
    public function getExpenseReports(): Collection
    {
        return $this->expenseReports;
    }

    public function addExpenseReport(ExpenseReport $expenseReport): self
    {
        if (!$this->expenseReports->contains($expenseReport)) {
            $this->expenseReports[] = $expenseReport;
            $expenseReport->setRefundCompany($this);
        }

        return $this;
    }

    public function removeExpenseReport(ExpenseReport $expenseReport): self
    {
        if ($this->expenseReports->removeElement($expenseReport)) {
            // set the owning side to null (unless already changed)
            if ($expenseReport->getRefundCompany() === $this) {
                $expenseReport->setRefundCompany(null);
            }
        }

        return $this;
    }
}
