<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 14/03/2018
 * Time: 17:01
 */
namespace common\constants;

class Order {
    const STATUS_NEW = 0;
    const STATUS_SENT = 1;
    const STATUS_DELIVERED = 2;
    const STATUS_RETURNED = 3;
    const STATUS_CANCELED = -1;

    static $statuses = [
        Order::STATUS_NEW => 'Mới',
        Order::STATUS_SENT => 'Đã Gửi',
        Order::STATUS_DELIVERED => 'Đã Nhận',
        Order::STATUS_RETURNED => 'Đã Trả Hàng',
        Order::STATUS_CANCELED => 'Đã Hủy',
    ];
}