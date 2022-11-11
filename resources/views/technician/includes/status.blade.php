



@if(strtolower($status)=="pending")

    {{"bg-warning-light text-warning"}}
@elseif(strtolower($status)=="assigned")
    {{"bg-info-light text-info"}}
@elseif( (strtolower($status)=="complete") || (strtolower($status)=="wip"))
    {{"bg-success-light text-success"}}
@else
    {{"bg-smooth-lighter text-smooth"}}
@endif
