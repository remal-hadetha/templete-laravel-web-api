<?php


namespace App\Repositories\Coupon;


interface CouponInterface
{
    public function getAll();
    public function getByID($id);
    public function create(array $attributes);
    public function update($id,array  $attributes);
    public function delete($id);
}