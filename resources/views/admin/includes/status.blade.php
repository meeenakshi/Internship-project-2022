@if(strtolower($status)=="pending")
    {{"bg-warning-light text-warning"}}
@elseif(strtolower($status)=="assigned")
    {{"bg-info-light text-info"}}
@elseif( (strtolower($status)=="complete") || (strtolower($status)=="closed"))
    {{"bg-success-light text-success"}}
@elseif(strtolower($status)=="wip")
    {{"bg-amethyst-lighter text-primary"}}
@elseif(strtolower($status)=="diagnosed")
    {{"bg-amethyst-lighter text-amethyst"}}
@elseif(strtolower($status)=="warranty")
    {{"bg-city-lighter text-city"}}
@else
    {{"bg-smooth-lighter text-smooth"}}
@endif
