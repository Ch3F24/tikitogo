<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use App\Models\Order;

class OrderController extends ModuleController
{
    protected $moduleName = 'orders';

    protected $titleColumnKey = 'name';

    protected $indexOptions = [
//        'permalink' => false,
        'skipCreateModal' => true,
        'editInModal' => false,
        'create' => true,
    ];
    protected $previewView = 'orders/preview';
//    public function ordersIndex()
//    {
//
//    }

    public function edit($id, $submoduleId = null)
    {
        $order = Order::query()->with([
            'user','products','products.options','products.products'])->findOrFail($id);

        return view('admin.orders/preview',compact('order'));
//        return parent::edit($id, $submoduleId); // TODO: Change the autogenerated stub
    }

    public function editing($id, $submoduleId = null)
    {
        return parent::edit($id, $submoduleId); // TODO: Change the autogenerated stub
    }
}