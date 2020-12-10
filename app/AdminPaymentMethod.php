<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class AdminPaymentMethod extends Model
{
    use Filterable;

    protected $fillable = [
        'payment_type_id', 'financial_entity_id', 'target_acount', 'document_type_id', 'document', 'target_name', 'file_image', 'file_path', 'status_id'
    ];

    private static $whiteListFilter = [
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function payment_type()
    {
        return $this->belongsTo('App\PaymentType');
    }

    public function financial_entity()
    {
        return $this->belongsTo('App\FinancialEntity');
    }

    public function document_type()
    {
        return $this->belongsTo('App\DocumentType');
    }

}
