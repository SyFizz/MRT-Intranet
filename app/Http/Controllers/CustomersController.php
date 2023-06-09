<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\View\View;


class CustomersController extends Controller
{



    public function index(Request $request): View
    {

        $customers = Customer::orderBy('name')->paginate(50);
        return view('customers.index')->with('customers' , $customers);
    }

    public function search(Request $request): View
    {
        $customers = Customer::where('id', 'like', '%'.$request->search.'%')
            ->orWhere('name', 'like', '%'.$request->search.'%')
            ->orWhere('email', 'like', '%'.$request->search.'%')
            ->orWhere('address', 'like', '%'.$request->search.'%')
            ->orWhere('phone', 'like', '%'.$request->search.'%')
            ->orWhere('vat_number', 'like', '%'.$request->search.'%')
            ->orWhere('siret', 'like', '%'.$request->search.'%')
            ->orWhere('legal_status', 'like', '%'.$request->search.'%')
            ->orderBy($request->has('sort') ? $request->sort : 'name')
            ->paginate(50);
        return view('customers.index')->with('customers' , $customers)->with('search', $request->search);
    }

    public function show($id)
    {
        //if $id is not a number, redirect to customers.index
        if(!is_numeric($id)){
            return to_route('customers')->with('error', 'Le numéro de client doit être un nombre entier.');
}
        if (Customer::all()->find($id) == null){
            return to_route('customers')->with('error', 'Le client n°' . $id . ' n\'existe pas.');
        }
        return view('customers.show')->with('customer', Customer::all()->find($id));
    }
    public function edit(int $id): View
    {
        return view('customers.edit')->with('customer', Customer::all()->find($id));
    }

    public function update(CustomerUpdateRequest $request, int $id): RedirectResponse
    {

        $validated = $request->validated();

        $customer = Customer::all()->find($id);
        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'];
        $customer->address = $validated['address'];
        $customer->legal_status = $validated['legal_status'];
        $customer->siret = $validated['siret'];
        $customer->vat_number = $validated['vat_number'];
        $customer->save();
        return to_route('customers.show', $customer->id)->with('success', 'Le client n°' . $customer->id . ' a bien été modifié.');
    }

    public function create(): View
    {
        return view('customers.create');
    }

    public function store(CustomerUpdateRequest $request): RedirectResponse
    {
        //Make the support pin a 8 digit unique random number
        $supportPin = rand(10000000, 99999999);
        while (Customer::where('support_pin', $supportPin)->exists()) {
            $supportPin = rand(10000000, 99999999);
        }

        $validated = $request->validated();

        $customer = new Customer();
        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'];
        $customer->address = $validated['address'];
        $customer->legal_status = $validated['legal_status'];
        $customer->siret = $validated['siret'];
        $customer->vat_number = $validated['vat_number'];
        $customer->support_pin = $supportPin;
        $customer->save();


        return redirect()->route('customers.show', $customer->id)->with('success', 'Le client n°' . $customer->id . ' a bien été créé.');
    }

    public function destroy(int $id): RedirectResponse
    {

        if(!Customer::all()->find($id)) {
            return to_route('customers')->with('error', 'Le client n°' . $id . ' n\'existe pas.');
        }
        $customer = Customer::all()->find($id);
        $invoices = $customer->invoices;
        /** @var Invoice $invoice */
        foreach ($invoices as $invoice) {
            $invoice->destroy($invoice->id);
        }
        $customer->delete();

        return to_route('customers')->with('success', 'Le client n°' . $id . ' a bien été supprimé.');
    }
}
