<?php
declare(strict_types=1);

namespace Glavfinans\Core\Entity\StaffPayment;

use Cycle\Database\Injection\Parameter;
use Cycle\ORM\Select;
use Cycle\ORM\Select\Repository;
use DateFmt;
use DateTimeInterface;

/**
 * Репозиторий класса StaffPayment
 * @package Glavfinans\Core\Entity\StaffPayment
 */
class StaffPaymentRepository extends Repository implements StaffPaymentRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function findAllByIncomingTransferId(int $incomingTransferId): array
    {
        return $this->select->load('staff')->where(['incoming_transfer_id' => $incomingTransferId])->fetchAll();
    }

    /**
     * @inheritdoc
     */
    public function findAllByPaymentDate(DateTimeInterface $beginDate, DateTimeInterface $endDate): iterable
    {
        $params = ['payment_date' => ['between' => [
            $beginDate->setTime(0, 0)->format(DateFmt::DT_DB),
            $endDate->setTime(23, 59)->format(DateFmt::DT_DB),],],];

        return $this->select->load('staff')->where($params)->fetchAll();
    }

    /**
     * @inheritdoc
     */
    public function existByIncomingTransferId(int $incomingTransferId): bool
    {
        return null === $this->findOne(['incoming_transfer_id' => $incomingTransferId]);
    }

    /**
     * @inheritdoc
     */
    public function countStaffPayment(
        StaffPaymentSearchDTO $staffPaymentSearchDTO,
        ?array                $arrayStaffId = null,
    ): int {
        return $this->selectWithSearchParams(
            staffPaymentSearchDTO: $staffPaymentSearchDTO,
            arrayStaffId: $arrayStaffId)
            ->count('*');
    }

    /**
     * @inheritdoc
     */
    public function findStaffPaymentCollection(
        int                   $offset,
        int                   $limit,
        string                $sort,
        string                $direction,
        StaffPaymentSearchDTO $staffPaymentSearchDTO,
        ?array                $arrayStaffId = null
    ): StaffPaymentCollection {
        $collection = new StaffPaymentCollection();

        $staffPayments = $this->selectWithSearchParams(
            staffPaymentSearchDTO: $staffPaymentSearchDTO,
            arrayStaffId: $arrayStaffId)->limit($limit)
            ->offset($offset)->load('staff')
            ->orderBy($sort, $direction)->fetchAll();

        /** @var StaffPayment $staffPayment */
        foreach ($staffPayments as $staffPayment) {
            $collection->add($staffPayment);
        }

        return $collection;
    }

    /**
     * Метод создает запрос по всем параметрам поиска пришедшим с формы.
     *
     * @param StaffPaymentSearchDTO $staffPaymentSearchDTO
     * @param array|null $arrayStaffId
     * @return Select
     */
    protected function selectWithSearchParams(
        StaffPaymentSearchDTO $staffPaymentSearchDTO,
        ?array                $arrayStaffId = null,
    ): Select {
        $params = [];
        if (null !== $staffPaymentSearchDTO->getPaymentDate()) {
            $params['paymentDate'] = ['between' => [
                $staffPaymentSearchDTO->getPaymentDate()->setTime(0, 0)->format(DateFmt::DT_DB),
                $staffPaymentSearchDTO->getPaymentDate()->setTime(23, 59, 59)->format(DateFmt::DT_DB)]];
        }
        if (null !== $staffPaymentSearchDTO->getStaffId()) {
            $params['staffId'] = $staffPaymentSearchDTO->getStaffId();
        }
        if (null !== $staffPaymentSearchDTO->getLoanId()) {
            $params['loanId'] = $staffPaymentSearchDTO->getLoanId();
        }
        if (null !== $staffPaymentSearchDTO->getSum()) {
            $params['sum'] = $staffPaymentSearchDTO->getSum();
        }
        if (null !== $staffPaymentSearchDTO->getType()) {
            $params['type'] = $staffPaymentSearchDTO->getType();
        }
        if (null !== $staffPaymentSearchDTO->getDestination()) {
            $params['destination'] = $staffPaymentSearchDTO->getDestination();
        }
        if (null !== $arrayStaffId) {
            $params['staffId'] = ['IN' => new Parameter(array_keys($arrayStaffId))];
        }

        return $this->select()->where($params);
    }
}
