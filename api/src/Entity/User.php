<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\MaxDepth;

#[ApiResource]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\OneToMany(mappedBy: 'refundUser', targetEntity: ExpenseReport::class, orphanRemoval: true)]
    private Collection $expenseReports;

    public function __construct()
    {
        $this->expenseReports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

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
            $expenseReport->setRefundUser($this);
        }

        return $this;
    }

    public function removeExpenseReport(ExpenseReport $expenseReport): self
    {
        if ($this->expenseReports->removeElement($expenseReport)) {
            // set the owning side to null (unless already changed)
            if ($expenseReport->getRefundUser() === $this) {
                $expenseReport->setRefundUser(null);
            }
        }

        return $this;
    }
}
