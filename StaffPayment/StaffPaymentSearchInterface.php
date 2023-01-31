<?php
declare(strict_types=1);

namespace Glavfinans\Core\Entity\StaffPayment;

use DateTimeInterface;
use Glavfinans\Core\Entity\IncomingTransfer\PaymentDestination;
use Glavfinans\Core\Money;

/**
 * Интерфейс для StaffPaymentSearchDTO
 */
interface StaffPaymentSearchInterface
{
    /**
     * Возвращает Id займа
     *
     * @return int|null
     */
    public function getLoanId(): ?int;

    /**
     * Возвращает сумму платежа
     *
     * @return Money|null
     */
    public function getSum(): ?Money;

    /**
     * Возвращает дату платежа
     *
     * @return DateTimeInterface|null
     */
    public function getPaymentDate(): ?DateTimeInterface;

    /**
     * Возвращает Id работника
     *
     * @return int|null
     */
    public function getStaffId(): ?int;

    /**
     * Возвращает тип платежа
     *
     * @return StaffPaymentType|null
     */
    public function getType(): ?StaffPaymentType;

    /**
     * Возвращает назначение платежа
     *
     * @return PaymentDestination|null
     */
    public function getDestination(): ?PaymentDestination;
}
