<?php
declare(strict_types=1);

namespace Glavfinans\Core\Entity\StaffPayment;

use DateFmt;
use DateTimeImmutable;
use Glavfinans\Core\Entity\IncomingTransfer\PaymentDestination;
use Glavfinans\Core\Money;
use OutOfBoundsException;

/**
 * Класс DTO для передачи в twig
 */
class StaffPaymentWithClientDTO
{
    private string $clientFio;
    private int $clientId;
    private Money $sum;
    private DateTimeImmutable $paymentDate;
    private StaffPaymentType $type;
    private string $staffFio;
    private ?PaymentDestination $destination;

    /**
     * @param string $clientFio
     * @param int $clientId
     * @param Money $sum
     * @param DateTimeImmutable $paymentDate
     * @param StaffPaymentType $type
     * @param string $staffFio
     * @param PaymentDestination|null $destination
     */
    public function __construct(
        string              $clientFio,
        int                 $clientId,
        Money               $sum,
        DateTimeImmutable   $paymentDate,
        StaffPaymentType    $type,
        string              $staffFio,
        ?PaymentDestination $destination,
    ) {
        if ($clientId < 0) {
            throw new OutOfBoundsException(message: 'client Id не может быть отрицательным! ' . $clientId);
        }

        $this->clientId = $clientId;

        if ($sum->getOnlyRub() < 0) {
            throw new OutOfBoundsException(message: 'Сумма не может быть отрицательной! ' . $sum->getOnlyRub());
        }

        $this->sum = $sum;

        $this->clientFio = $clientFio;
        $this->paymentDate = $paymentDate;
        $this->type = $type;
        $this->staffFio = $staffFio;
        $this->destination = $destination;
    }

    /**
     * Возвращает Ф.И.О. клиента
     *
     * @return string
     */
    public function getClientFio(): string
    {
        return $this->clientFio;
    }

    /**
     * Возвращает Id клиента
     *
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * Возвращает назначение платежа
     *
     * @return string|null
     */
    public function getNameDestination(): ?string
    {
        return $this->destination?->getName();
    }

    /**
     * Возвращает дату платежа
     *
     * @return string
     */
    public function getFormatPaymentDate(): string
    {
        return $this->paymentDate->format(DateFmt::DT_DB);
    }

    /**
     * Возвращает Ф.И.О. сотрудника
     *
     * @return string
     */
    public function getStaffFio(): string
    {
        return $this->staffFio;
    }

    /**
     * Возвращает сумму платежа
     *
     * @return int
     */
    public function getSumOnlyRub(): int
    {
        return $this->sum->getOnlyRub();
    }

    /**
     * Возвращает тип платежа
     *
     * @return string
     */
    public function getTypeTitle(): string
    {
        return $this->type->getTitle();
    }
}
