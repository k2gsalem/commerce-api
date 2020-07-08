<?php

namespace App\Http\Controllers\Api\Catalogue;

use App\Entities\Assets\Asset;
use App\Entities\Catalogue\ItemVariant;
use App\Entities\Config\ConfStatus;
use App\Http\Controllers\Controller;
use App\Transformers\Catalogue\ItemVariantTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class ItemVariantController extends Controller
{
    use Helpers;    
    protected $model;

    public function __construct(ItemVariant $model)
    {
        $this->model = $model;
        $this->middleware('permission:List item variant')->only('index');
        $this->middleware('permission:List item variant')->only('show');
        $this->middleware('permission:Create item variant')->only('store');
        $this->middleware('permission:Update item variant')->only('update');
        $this->middleware('permission:Delete item variant')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $paginator = $this->model->paginate($request->get('limit', config('app.pagination_limit')));
        if ($request->has('limit')) {
            $paginator->appends('limit', $request->get('limit'));
        }      
       
    
        return $this->response->paginator($paginator, new ItemVariantTransformer());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [    
            'sub_category_id'=>'required|numeric',
            'item_code'=>'required|min:3|max:100',
            'item_desc'=>'required|max:300',           
            'vendor_store_id'=>'required|numeric',
            'status_id'=>'required|numeric',
            'created_by'=>'required|numeric',
            'updated_by'=>'required|numeric',                       
        ]);
        ConfStatus::findOrFail($request->status_id);
        $itemVariant = $this->model->create($request->all());
        if($request->has('file')){
            foreach($request->file as $file){
                $assets =$this->api->attach(['file'=>$file])->post('api/assets');
                $itemVariant->assets()->save($assets);
            }
        }else if($request->has('url')){
            $assets = $this->api->post('api/assets', ['url' => $request->url]);
            $itemVariant->assets()->save($assets);
        }else if($request->has('uuid')){
            $a=Asset::byUuid($request->uuid)->get();
            $assets= Asset::findOrFail($a[0]->id);
            $itemVariant->assets()->save($assets);         

        } 
        return $this->response->created(url('api/itemVariant/' . $itemVariant->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Catalogue\ItemVariant  $itemVariant
     * @return \Illuminate\Http\Response
     */
    public function show(ItemVariant $itemVariant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Catalogue\ItemVariant  $itemVariant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemVariant $itemVariant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Catalogue\ItemVariant  $itemVariant
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemVariant $itemVariant)
    {
        $record = $this->model->findOrFail($itemVariant->id);
        $record->delete();
        return $this->response->noContent();
    }
}
