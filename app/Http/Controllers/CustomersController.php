<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
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

    public function show(int $id): View
    {
        return view('customers.show')->with('customer', Customer::all()->find($id));
    }
    public function edit(int $id): View
    {
        return view('customers.edit')->with('customer', Customer::all()->find($id));
    }

    public function update(Request $request, int $id): RedirectResponse
    {

        $validated = $request->validate([
            'name' => 'required|min:3|max:255|regex:/^[a-zA-ZéèêëàâäôöûüïîçÉÈÊËÀÂÄÔÖÛÜÏÎÇ\s]+$/',
            'email' => 'required|email',
            'address' => 'required|min:3|max:255|regex:/^[a-zA-Z0-9éèêëàâäôöûüïîçÉÈÊËÀÂÄÔÖÛÜÏÎÇ\'\-,\s]+$/',
            'phone' => 'rrequired|phone:FR,INTERNATIONAL',
            'vat_number' => 'nullable|min:13|max:13|regex:/^[a-zA-Z]{2}[0-9]{11}$/',
            'siret' => 'nullable|min:14|max:14|regex:/^[0-9]{14}$/',
            'legal_status' => 'required|min:2|max:255|regex:/^[a-zA-ZéèêëàâäôöûüïîçÉÈÊËÀÂÄÔÖÛÜÏÎÇ\s]+$/',
        ]);

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

    public function store(): RedirectResponse
    {
        $validated = request()->validate([
            'name' => 'required|min:3|max:255|regex:/^[a-zA-ZéèêëàâäôöûüïîçÉÈÊËÀÂÄÔÖÛÜÏÎÇ\s]+$/',
            'email' => 'required|email',
            'address' => 'required|min:3|max:255|regex:/^[a-zA-Z0-9éèêëàâäôöûüïîçÉÈÊËÀÂÄÔÖÛÜÏÎÇ\'\-,\s]+$/',
            'phone' => 'required|phone:FR,INTERNATIONAL',
            'vat_number' => 'nullable|min:13|max:13|regex:/^[a-zA-Z]{2}[0-9]{11}$/',
            'siret' => 'nullable|min:14|max:14|regex:/^[0-9]{14}$/',
            'legal_status' => 'required|min:2|max:255|regex:/^[a-zA-ZéèêëàâäôöûüïîçÉÈÊËÀÂÄÔÖÛÜÏÎÇ\s]+$/',
        ]);
        $customer = Customer::create($validated);
        return redirect()->route('customers.show', $customer->id)->with('success', 'Le client n°' . $customer->id . ' a bien été créé.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $customer = Customer::all()->find($id);
        $invoices = $customer->invoices;
        /** @var Invoice $invoice */
        foreach ($invoices as $invoice) {
            $invoice->destroy($invoice->id);
        }
        $customer->delete();

        return to_route('customers');
    }
}
