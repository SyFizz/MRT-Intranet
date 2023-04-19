<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function show($id){
        //Redirect to the PDF file of the invoice
        $invoice = Invoice::find($id);
        return view('invoices.view', compact('invoice'));

     }

    public function upload($id){
        $customer = Customer::find($id);
        return view('invoices.add', compact('customer'));
    }

    public function store(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:2048',
            'filename' => 'required|string|max:255',
        ]);

        $requestedFileName = $request->filename;
        $requestedFileName = preg_replace('/[^A-Za-z0-9\-]/', '_', $requestedFileName);
        $fileName = $request->customer_id.'-'.$requestedFileName .'.'.$request->file->extension();

        /** @var UploadedFile $invoiceFile */
        $invoiceFile = $request->file('file');

        $storedPath = $invoiceFile->storePubliclyAs('invoices', $fileName, 'public');

        $invoice = new Invoice();
        $invoice->filePath = $storedPath;
        $invoice->customer_id = $request->customer_id;
        $invoice->save();

        return redirect()->route('customers.show', $request->customer_id);
    }

    public function download($id){
        $invoice = Invoice::find($id);
        return response()->download(storage_path('app/public/'.$invoice->filePath));
    }

    public function destroy($id){
        $invoice = Invoice::find($id);
        $invoice->delete();

        return redirect()->route('customers.show', $invoice->customer_id);
    }

}
