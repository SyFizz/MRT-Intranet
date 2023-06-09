<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Invoice extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function delete()
    {
        Storage::disk('public')->delete($this->filePath);
        return parent::delete(); // TODO: Change the autogenerated stub
    }
}
