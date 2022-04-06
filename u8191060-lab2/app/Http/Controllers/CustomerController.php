<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show_customer_table(Request $request)
    {
        $filter = $request->query('filter');
        if (empty($filter)) {
            $customers = Customer::paginate(15);
            return view('customer_list', compact('customers'));
        } else {
            switch ($filter) {
                case "is_banned":
                    $customers = Customer::where('is_banned', '=', 'true')->paginate(15);
                    break;

                case "not_banned":
                    $customers = Customer::where('is_banned', '=', 'false')->paginate(15);
                    break;

                case "email":
                    $customers = Customer::where('email', 'like', '%'.$request->query('filter_value').'%')->paginate(15);
                    break;

                case "phone":
                    $customers = Customer::where('phone', 'like', '%'.$request->query('filter_value').'%')->paginate(15);
                    break;

                case "name":
                    $name_array = preg_split("/\s/", $request->query('filter_value'));
                    if (count($name_array) > 1) {
                        $customers = Customer::where('name', 'like', '%'.$name_array[0].'%')->where('surname', 'like', '%'.$name_array[1].'%')->paginate(15);
                    } else {
                        $customers = Customer::where('name', 'like', '%'.$name_array[0].'%')->paginate(15);
                    }
                    break;

                default:
                    $customers = Customer::paginate(15);
                    break;
            }
            return view('customer_list', compact('customers'));
        }
    }

    public function show_customer_info(int $id)
    {
        $customer = Customer::findOrFail($id);
        $addresses = $customer->addresses()->orderBy('created_at', 'DESC')->get();
        return view('customer_info', [
            'customer' => $customer,
            'addresses' => $addresses
        ]);
    }
}
