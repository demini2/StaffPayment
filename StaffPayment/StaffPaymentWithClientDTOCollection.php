<?php
declare(strict_types=1);

namespace Glavfinans\Core\Entity\StaffPayment;

use Glavfinans\Core\Collection;

/**
 * Коллекция платежей и клиентов для передачи в twig
 *
 * @package Glavfinans\Core\Entity\StaffPayment
 */
class StaffPaymentWithClientDTOCollection extends Collection
{
    /**
     * Добавление нового объекта в коллекцию
     *
     * @param StaffPaymentWithClientDTO $StaffPaymentDTO
     */
    public function add(StaffPaymentWithClientDTO $StaffPaymentDTO)
    {
        $this->addObject($StaffPaymentDTO);
    }
}
