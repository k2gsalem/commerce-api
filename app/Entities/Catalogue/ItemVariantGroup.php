<?php

namespace App\Entities\Catalogue;

use App\Entities\Config\ConfStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class ItemVariantGroup extends Model implements Auditable
{
    use SoftDeletes,AuditingAuditable;
    protected $fillable = [
        'item_id',
        'item_group_desc',        
        'status_id',
        'created_by',
        'updated_by',
    ];
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function conStatus()
    {
       return $this->hasOne(ConfStatus::class,'id','status_id');
    }
    //
}
