<?php
declare(strict_types=1);

namespace Glavfinans\Core\Entity\StaffPayment;

use DateTimeInterface;
use Glavfinans\Core\Entity\IncomingTransfer\PaymentDestination;
use Glavfinans\Core\Money;
use OutOfBoundsException;

/**
 * Класс DTO для формы поиска,
 * для дальнейшей передачи в репозиторий.
 */
class StaffPaymentSearchDTO implements StaffPaymentSearchInterface
{
    public ?int $loanId = null;
    public ?int $staffId = null;
    public ?Money $sum = null;
    public ?StaffPaymentType $type = null;
    public ?PaymentDestination $destination = null;
    public ?DateTimeInterface $paymentDate = null;

    /**
     * Устанавливает paymentDate
     *
     * @param DateTimeInterface|null $paymentDate
     */
    public function setPaymentDate(?DateTimeInterface $paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }

    /**
     * Устанавливает staffId
     *
     * @param int|null $staffId
     */
    public function setStaffId(?int $staffId): void
    {
        if (null !== $staffId && $staffId < 0) {
            throw new OutOfBoundsException(message: 'Staff Id не может быть отрицательным! ' . $staffId);
        }

        $this->staffId = $staffId;
    }

    /**
     * Устанавливает destination
     *
     * @param PaymentDestination|null $destination
     */
    public function setDestination(?PaymentDestination $destination): void
    {
        $this->destination = $destination;
    }

    /**
     * Устанавливает type
     *
     * @param StaffPaymentType|null $type
     */
    public function setType(?StaffPaymentType $type): void
    {
        $this->type = $type;
    }

    /**
     * Устанавливает sum
     *
     * @param int|null $sum
     */
    public function setSum(?int $sum): void
    {
        if (null === $sum) {

            return;
        }

        if ($sum < 0) {
            throw new OutOfBoundsException(message: 'Сумма не может быть отрицательной! ' . $sum);
        }

        $this->sum = Money::fromRub($sum);
    }

    /**
     * Устанавливает loanId
     *
     * @param int|null $loanId
     */
    public function setLoanId(?int $loanId): void
    {
        if (null !== $loanId && $loanId < 0) {
            throw new OutOfBoundsException(message: 'Loan Id не может быть отрицательным! ' . $loanId);
        }

        $this->loanId = $loanId;
    }

    /**
     * @inheritdoc
     */
    public function getLoanId(): ?int
    {
        return $this->loanId;
    }

    /**
     * @inheritdoc
     */
    public function getSum(): ?Money
    {
        return $this->sum;
    }

    /**
     * @inheritdoc
     */
    public function getPaymentDate(): ?DateTimeInterface
    {
        return $this->paymentDate;
    }

    /**
     * @inheritdoc
     */
    public function getStaffId(): ?int
    {
        return $this->staffId;
    }

    /**
     * @inheritdoc
     */
    public function getType(): ?StaffPaymentType
    {
        return $this->type;
    }

    /**
     * @inheritdoc
     */
    public function getDestination(): ?PaymentDestination
    {
        return $this->destination;
    }
}
