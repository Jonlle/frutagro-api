<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_type_id',
        'financial_entity_id',
        'supplier_id',
        'target_acount',
        'document_type_id',
        'document',
        'target_name',
        'file_image',
        'file_path',
        'status_id',
    ];

    public function admin_payments_methods()
    {
        return $this->hasMany('App\AdminPaymentMethod');
    }

    public function paymentType()
    {
        return $this->belongsTo(\App\Models\PaymentType::class);
    }

    public function documentType()
    {
        return $this->belongsTo(\App\Models\DocumentType::class);
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class);
    }

    public function financialEntity()
    {
        return $this->belongsTo(\App\Models\FinancialEntity::class);
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class);
    }
}
