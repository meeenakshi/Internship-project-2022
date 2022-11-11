<?php

namespace App\Filters\V1;


use Illuminate\Http\Request;

class WorkOrderFilter{

    protected $allowedParams = [
        'status' => ['eq','ne'],
        'assignedTo' => ['eq','ne'],
        'approved' => ['eq','ne'],
        'chargeable' => ['eq','ne'],
        'createdAt' =>['eq','ne','gt','lte','gte'],
    ];


    protected $columnMap = [
      'assignedTo'=> 'assigned_to',
        'approved' => 'quotation_approved',
        'createdAt' =>'created_at'
    ];

    protected $operatorMap = [
        'eq'=>'=',
        'ne'=>'!=',
        'lt'=> '<',
        'lte'=> '<=',
        'gt'=> '>',
        'gte'=> '>='
    ];


    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->allowedParams as $param => $operators)
        {
            $query = $request->query($param);

            if(!isset($query))
            {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator)
            {
                if(isset($query[$operator]))
                {
                        $eloQuery[] = [$column,$this->operatorMap[$operator],$query[$operator]];
                }

            }
        }

        return $eloQuery;
    }



}
