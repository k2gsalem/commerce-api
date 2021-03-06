<?php

namespace App\Http\Controllers\Api\Config;

use App\Entities\Config\ConfStatus;
use App\Http\Controllers\Controller;
use App\Transformers\Config\ConfStatusTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class ConfStatusController extends Controller
{
    use Helpers;
    protected $model;
    public function __construct(ConfStatus $model)
    {
        $this->model = $model;
        $this->middleware('permission:List config status')->only('index');
        $this->middleware('permission:List config status')->only('show');
        $this->middleware('permission:Create config status')->only('store');
        $this->middleware('permission:Update config status')->only('update');
        $this->middleware('permission:Delete config status')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $cs = $this->model::all();
        // return $cs->audits;
        $paginator = $this->model->paginate($request->get('limit', config('app.pagination_limit')));
        if ($request->has('limit')) {
            $paginator->appends('limit', $request->get('limit'));
        }

        return $this->response->paginator($paginator, new ConfStatusTransformer());

        // return $this->response->Collection($this->model->all(), new ConfStatusTransformer());
        // $cs = $this->model::all();
        // return $this->response->item($cs, new ConfStatusTransformer());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  return $request->user()->id;
        $request['created_by'] = $request->user()->id;
        $request['updated_by'] = $request->user()->id;

        $rules = [
            'status_desc' => 'required|string|min:1|max:300',
            'title' => 'required|string|min:5|max:500|unique:conf_statuses,title',
        ];

        $this->validate($request, $rules);
        $confStatus = $this->model->create($request->all());
        return $this->response->created(url('api/confStatus/' . $confStatus->id));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Config\ConfStatus  $confStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ConfStatus $confStatus)
    {
        return $this->response->item($confStatus, new ConfStatusTransformer());
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Config\ConfStatus  $confStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfStatus $confStatus)
    {

        $request['updated_by'] = $request->user()->id;

        $rules = [
            'status_desc' => 'required|string|min:1|max:300',
            'title' => 'required|string|min:5|max:500|unique:conf_statuses,title,'.$confStatus->id,
        ];
        if ($request->method() == 'PATCH') {
            $rules = [
                'status_desc' => 'sometimes|required|string|min:1|max:300',
                'title' => 'sometimes|required|string|min:5|max:500|unique:conf_statuses,title,'.$confStatus->id,
            ];
        }
        $this->validate($request, $rules);
        $confStatus->update($request->except('created_by'));
        return $this->response->item($confStatus->fresh(), new ConfStatusTransformer());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Config\ConfStatus  $confStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfStatus $confStatus)
    {
        $record = $this->model->findOrFail($confStatus->id);

        if ($confStatus->item()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has items!'
            );
            return response()->json($response, 403);
          
        }
        if ($confStatus->itemVariant()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has item variants!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->itemVariantGroup()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has item variant groups!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->confSupplierCat()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has supplier categories!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->confVendorCat()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has vendor categories!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->prodCat()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has product categories!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->prodSubCat()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has product sub categories!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->vendor()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has vendors!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->vendorStore()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has vendor stores!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->supplier()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has suppliers!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->carts()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has carts!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->cartItems()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has cart items!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->cartItemVariants()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has cart item variants!'
            );
            return response()->json($response, 403);
          
        }

        if ($confStatus->stockTracker()->count()) {
            $response = array(
                'message' => 'Cannot delete: This status has stock tracker!'
            );
            return response()->json($response, 403);
          
        }

        $record->delete();
        return $this->response->noContent();
        //
    }
}
