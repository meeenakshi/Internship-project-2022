@if(strtolower($designation)=="sales")
    {{"bg-warning-light text-warning"}}
@elseif(strtolower($designation)=="technician")
    {{"bg-info-light text-info"}}
@elseif(strtolower($designation)=="admin")
    {{"bg-success-light text-success"}}
@else
    {{"bg-smooth-lighter text-smooth"}}
@endif
