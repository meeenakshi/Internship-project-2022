<?php

namespace App\Filters\V1;


use Illuminate\Http\Request;

class SlaFilter{

    protected $allowedParams = [
        'type' => ['eq','ne'],
        'location' => ['eq','ne'],
        'hours' => ['eq','ne'],

    ];


    protected $columnMap = [

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
