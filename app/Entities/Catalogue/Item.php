<?php

namespace App\Entities\Catalogue;

use App\Entities\Assets\Asset;
use App\Entities\Config\ConfStatus;
use App\Entities\Config\ProdSubCat;
use App\Entities\Config\ProdCat;
use App\Entities\Stock\StockMaster;
use App\Entities\Stock\StockTracker;
use App\Entities\Vendor\Vendor;
use App\Entities\Vendor\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Item extends Model implements Auditable
{
    use AuditingAuditable, SoftDeletes;
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'item_code',
        'item_desc',
        'min_order_quantity',
        'min_order_amount',  
        'max_order_quantity',
        'max_order_amount',
        'discount_percentage',
        'discount_amount',
        'quantity',
        'threshold',
        'supplier_id',
        // 'item_image',
        'vendor_store_id',
        'status_id',
        'created_by',
        'updated_by',
    ];

    public function Category()
    {
        return $this->belongsTo(ProdCat::class, 'category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(ProdSubCat::class, 'sub_category_id');
    }
    public function store()
    {
        return $this->belongsTo(Vendor::class, 'vendor_store_id');
    }
    public function Supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function confStatus()
    {
        return $this->hasOne('App\Entities\Config\ConfStatus', 'id', 'status_id');
    }
    public function itemVariants()
    {
        return $this->hasMany(ItemVariant::class, 'item_id');
    }
    public function itemVariantGroups()
    {
        return $this->hasMany(ItemVariantGroup::class, 'item_id');
    }
    public function stock()
    {
        return $this->hasMany(StockMaster::class, 'item_id');
    }
    public function stockTrackers()
    {
        return $this->hasMany(StockTracker::class, 'item_id');
    }
    public function assets()
    {
        return $this->morphMany(Asset::class, 'imageable');
    }
}
