<?php
namespace App\Transformers\Config;

use App\Entities\Config\ConfStatus;
use League\Fractal\TransformerAbstract;

class ConfStatusTransformer extends TransformerAbstract
{
    
    public function transform(ConfStatus $model)
    {
        
        return [
            'id' =>(int)$model->id,
            'status_desc' =>(string)$model->status_desc,
            'title'=>(string)$model->title,
            'created_at' => (string)$model->created_at->getTimestamp(),
            'updated_at' => (string)$model->updated_at->getTimestamp(),            
            // 'created_by' => $model->created_by,
            // 'updated_by' => $model->updated_by->toIso8601String(),
            // 'created_at' => $model->created_at->toIso8601String(),
        ];

    }
}
