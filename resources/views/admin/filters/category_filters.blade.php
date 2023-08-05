@php 
use App\Models\ProductsFilter;
$productFilters = ProductsFilter::productFilters();
if(isset($product['category_id'])) {
    $category_id = $product['category_id'];
}
@endphp

@foreach($productFilters as $productFilter)
    @if(isset($category_id))
        @php 
            $filterAvailable = ProductsFilter::filterAvailable($productFilter['id'],$category_id);
        @endphp
        @if($filterAvailable=="Yes")
            @if(count($productFilter['filter_values']))
                <div class="form-group">
                    <label for="{{$productFilter['filter_column']}}">Select {{$productFilter['filter_name']}}</label>
                    <select class="select2single" name="{{$productFilter['filter_column']}}" id="{{$productFilter['filter_column']}}" required>
                        <option value="" selected disabled>-- Select {{$productFilter['filter_name']}} --</option>
                        @foreach($productFilter['filter_values'] as $value)
                        <option value="{{$value['filter_value']}}" @if(!empty($product[$productFilter['filter_column']]) && $product[$productFilter['filter_column']] == $value['filter_value']) selected @endif>{{ucwords($value['filter_value'])}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        @endif
    @endif    
@endforeach