@if ($property->type->id == 2)

    </span> | <span>{{$property->suite_amount}} <i class="fa fa-bed"></i>
    <span>|</span> {{$property->bathroom_amount}} <i class="fa fa-bath"></i> 
    <span>|</span> @if (in_array($property->type->id, array(2,3,4,5,6,7,8,11,20)) ) {{$property->roofed_surface}} @else {{$property->surface}} @endif m²</span>
    {{--SURFACE--}}
   

    <!-- Garage -->
    

    <!-- Banio -->
   

    <!-- AMBIENTES -->
    

@elseif ($property->type->id == 3 )
    {{--SURFACE--}}
</span> | <span>2 <i class="fa fa-bed"></i>
    <span>|</span> 2 <i class="fa fa-bath"></i> 
    <span>|</span> 920 m²</span>

    <!-- Cochera -->
   

    <!-- Banio -->
   

    <!-- Dormitorio -->
   

@elseif ($property->type->id == 8 || $property->type->id == 1)

    {{--SURFACE--}}
</span> | <span>2 <i class="fa fa-bed"></i>
    <span>|</span> 2 <i class="fa fa-bath"></i> 
    <span>|</span> 920 m²</span>

@elseif ($property->type->id == 10)

    {{--SURFACE--}}
    
</span> | <span>2 <i class="fa fa-bed"></i>
    <span>|</span> 2 <i class="fa fa-bath"></i> 
    <span>|</span> 920 m²</span>
@elseif ($property->type->id == 5)

    {{--SURFACE--}}
    

    <!-- Garage -->
</span> | <span>2 <i class="fa fa-bed"></i>
    <span>|</span> 2 <i class="fa fa-bath"></i> 
    <span>|</span> 920 m²</span>

    <!-- Banio -->
   
@elseif ($property->type->id == 7)

    {{--SURFACE--}}
</span> | <span>2 <i class="fa fa-bed"></i>
    <span>|</span> 2 <i class="fa fa-bath"></i> 
    <span>|</span> 920 m²</span>
    <!-- Garage -->
    

@elseif ($property->type->id == 14)

    {{--SURFACE--}}
</span> | <span>2 <i class="fa fa-bed"></i>
    <span>|</span> 2 <i class="fa fa-bath"></i> 
    <span>|</span> 920 m²</span>
    <!-- Garage -->
   

@else

    {{--SURFACE--}}
  
    <!-- AMBIENTES -->
</span> | <span>2 <i class="fa fa-bed"></i>
    <span>|</span> 2 <i class="fa fa-bath"></i> 
    <span>|</span> 920 m²</span>
    <!-- Cochera -->
   

    <!-- Banio -->
    

   
@endif 