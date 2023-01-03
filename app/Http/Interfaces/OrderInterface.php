<?php

namespace App\Http\Interfaces;

/**
 * Order interface
 */
interface OrderInterface {

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function getOrder($id);

    /**
     * @param $order
     * @return mixed
     */
    public function delete($order);

    /**
     * @return mixed
     */
    public function getOrders();

    /**
     * @return mixed
     */
    public function update(array $data, $id);

}
