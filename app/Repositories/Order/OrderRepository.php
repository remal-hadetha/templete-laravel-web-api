<?php


namespace App\Repositories\Order;


use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProducts;
use Illuminate\Support\Arr;
class OrderRepository implements OrderInterface
{
    public function __construct(Order $order,Product $product, OrderProducts $orderProduct)
    {
        $this->model = $order;
        $this->product = $product;
        $this->orderProduct = $orderProduct;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    public function getByID($id)
    {
        // TODO: Implement getByID() method.
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        $total = 0;
        $sub_total =0;
        for($i=0; $i < count($attributes['items'])  ; $i++){
            $product =  $this->product->find($attributes['items'][$i]);
            $total += $product->price * $attributes['quantity'][$i];
            $sub_total += $product->price * $attributes['quantity'][$i];
        }

        $attributes['sub_total'] = $sub_total;
        // TODO: Implement create() method.
        if ($attributes['enable_tax'] == '1') {
           $total = $total + ($total * $attributes['tax'] / 100 );
        }else{
            $attributes['tax'] = '';
        }

        if($attributes['discount'] =='persentage'){
            $total = $total - ($total * $attributes['price_persentage_discount'] / 100 );
        }elseif($attributes['discount'] =='money'){
            $total = $total -  $attributes['price_money_discount'] ;
        }else{
            $attributes['price_money_discount'] ='';
            $attributes['price_persentage_discount'] = '';
        }

        $total = $total + $attributes['delivery_price'];
        $attributes['total'] = $total;
        $attributes['date'] = \Carbon\Carbon::createFromFormat('Y-m-d',$attributes['date']);
        $attributes['time'] = \Carbon\Carbon::createFromFormat('H:i',$attributes['time']);
        $order = $this->model->create(Arr::except($attributes,['items','quantity']));
        
        for($i=0; $i < count($attributes['items'])  ; $i++){
            $product =  $this->product->find($attributes['items'][$i]);
            $orderProduct = new $this->orderProduct ();
            $orderProduct->product_id = $product->id;
            $orderProduct->order_id   = $order->id;
            $orderProduct->quantity   = $attributes['quantity'][$i];
            $orderProduct->save();
        }

        return $order;
    }

    public function update($id, array $attributes)
    {

        $total = 0;
        $sub_total =0;
        for($i=0; $i < count($attributes['items'])  ; $i++){
            $product =  $this->product->find($attributes['items'][$i]);
            $total += $product->price * $attributes['quantity'][$i];
            $sub_total += $product->price * $attributes['quantity'][$i];
        }

        $attributes['sub_total'] = $sub_total;
        // TODO: Implement create() method.
        if ($attributes['enable_tax'] == '1') {
           $total = $total + ($total * $attributes['tax'] / 100 );
        }else{
            $attributes['tax'] = '';
        }

        if($attributes['discount'] =='persentage'){
            $total = $total - ($total * $attributes['price_persentage_discount'] / 100 );
        }elseif($attributes['discount'] =='money'){
            $total = $total -  $attributes['price_money_discount'] ;
        }else{
            $attributes['price_money_discount'] ='';
            $attributes['price_persentage_discount'] = '';
        }
        
        // TODO: Implement update() method.
        $order = $this->model->findOrFail($id);
        $attributes['date'] = \Carbon\Carbon::createFromFormat('Y-m-d',$attributes['date']);
        $attributes['time'] = \Carbon\Carbon::createFromFormat('H:i',$attributes['time']);
        $order->update(Arr::except($attributes,['items','quantity']));
        $order->save();

        for($i=0; $i < count($attributes['items'])  ; $i++){
            $product =  $this->product->find($attributes['items'][$i]);
            $orderProduct = new $this->orderProduct ();
            $orderProduct->product_id = $product->id;
            $orderProduct->order_id   = $order->id;
            $orderProduct->quantity   = $attributes['quantity'][$i];
            $orderProduct->save();
        }

        return $order;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $order = $this->getByID($id);
        return $order->delete();
    }
}