@foreach($addresses as $key => $address)
<label class="address-list">
    <input type="radio" name="delivery-addresses" id="addresses-{{$address['id']}}" value="{{$address['id']}}" @if($key==0) checked @endif/>
    <div>
        <h6 class="address-name">{{$address['name']}}</h6>
        <h6>{{$address['mobile']}}</h6>
        <p>{{$address['address']}} <br>{{$address['state']}}, {{$address['city']}}, {{$address['pincode']}}</p>
        <span class="address-selected">✓</span>
    </div>
</label>
@endforeach