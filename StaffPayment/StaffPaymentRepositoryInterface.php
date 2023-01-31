<?php

namespace Glavfinans\Core\Entity\StaffPayment;

use DateTimeInterface;

/**
 * Интерфейс класса StaffPaymentRepository
 */
interface StaffPaymentRepositoryInterface
{
    /**
     * Возвращает StaffPayment по incoming_transfer_id
     *
     * @param int $incomingTransferId
     * @return array
     */
    public function findAllByIncomingTransferId(int $incomingTransferId): array;

    /**
     * Возвращает объекты по дате
     *
     * @param DateTimeInterface $beginDate
     * @param DateTimeInterface $endDate
     * @return iterable
     */
    public function findAllByPaymentDate(DateTimeInterface $beginDate, DateTimeInterface $endDate): iterable;

    /**
     * Принимает IncomingTransferId, возвращает true если нашел объект,
     * false если нет
     *
     * @param int $incomingTransferId
     * @return bool
     */
    public function existByIncomingTransferId(int $incomingTransferId): bool;

    /**
     * Возвращает общее количество оплаты персонала по критериям поиска.
     *
     * @param StaffPaymentSearchDTO $staffPaymentSearchDTO
     * @param array|null $arrayStaffId
     * @return int
     */
    public function countStaffPayment(StaffPaymentSearchDTO $staffPaymentSearchDTO, ?array $arrayStaffId = null): int;

    /**
     * Метод принимает собранную DTO, класса StaffPaymentSearchDTO с параметрами поиска.
     * Возвращает коллекцию оплаты персонала по параметрам.
     *
     * @param int $offset
     * @param int $limit
     * @param string $sort
     * @param string $direction
     * @param StaffPaymentSearchDTO $staffPaymentSearchDTO
     * @param array|null $arrayStaffId
     * @return StaffPaymentCollection
     */
    public function findStaffPaymentCollection(
        int                   $offset,
        int                   $limit,
        string                $sort,
        string                $direction,
        StaffPaymentSearchDTO $staffPaymentSearchDTO,
        ?array                $arrayStaffId = null
    ): StaffPaymentCollection;
}
