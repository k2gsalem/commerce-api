<?php

namespace App\Entities\Config;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class ConfVendorCat extends Model implements Auditable
{
    
    use AuditingAuditable,SoftDeletes;

    protected $fillable = [
        'vendor_cat_desc','title','status_id', 'created_by', 'updated_by',
    ];
    public function confStatus()
    {
        return $this->hasOne(ConfStatus::class,'id','status_id');
        # code...
    }
    public function vendor()
    {
        return $this->belongsTo('App\Entities\Vendor\Vendor','vendor_category_id','id');
    }
}
