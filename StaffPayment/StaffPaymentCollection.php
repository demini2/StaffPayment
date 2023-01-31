<?php

namespace Glavfinans\Core\Entity\StaffPayment;

use Glavfinans\Core\Collection;

/**
 * Коллекция оплаты персонала для передачи в адаптер.
 *
 * @package Glavfinans\Core\Entity\StaffPayment
 */
class StaffPaymentCollection extends Collection
{
    /**
     * Добавление нового объекта в коллекцию
     *
     * @param StaffPayment $StaffPaymentDTO
     */
    public function add(StaffPayment $StaffPaymentDTO)
    {
        $this->addObject($StaffPaymentDTO);
    }
}
