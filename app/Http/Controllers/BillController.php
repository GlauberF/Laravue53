<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;

use App\Http\Requests;

class BillController extends Controller
{
    /**
     * @var Bill
     */
    private $model;

    public function __construct(Bill $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $bills = $this->model->latest()->get();

        return $bills;
    }

    public function store(Request $request) {
        $result = $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'value' => 'required|numeric|min:0',
            'due_date' => 'required|date'
        ]);

        $bill = $this->model->create($request->all());

        if ($request->ajax()) {
            return response()->json($bill,200);
        }

        return $bill;
    }

    public function update(Request $request, $id)
    {
        $result = $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'value' => 'required|numeric|min:0',
            'due_date' => 'required|date'
        ]);

        $bill = $this->model->find($id);
        $bill->update($request->all());

        if ($request->ajax()) {
            return response()->json($bill,200);
        }

        return $bill;
    }

    public function pay(Request $request, $id)
    {
        $bill = $this->model->find($id);
        $bill->done = 1;
        $bill->save();

        if ($request->ajax()) {
            return response()->json($bill,200);
        }

        return $bill;

    }

    public function unpay(Request $request, $id)
    {
        $bill = $this->model->find($id);
        $bill->done = 0;
        $bill->save();

        if ($request->ajax()) {
            return response()->json($bill,200);
        }

        return $bill;
    }

    public function destroy($id)
    {
        $this->model->find($id)->delete();

        return response()->json('Conta Apagada',200);
    }
}
