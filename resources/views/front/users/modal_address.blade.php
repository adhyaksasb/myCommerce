<div class="modals" id="modal">
    <div class="modal-header">
      <div class="title">Add Address</div>
      <a class="close-button"><i class="fas fa-times"></i></a>
    </div>
    <div class="modal-body">
        <form id="addressForm" action="javascript:;" method="post">@csrf
            <input type="hidden" id="address-id" name="id" class="text-field" value="0" placeholder="Enter Name" >
            <div class="u-s-m-b-30">
                <label for="address-name">Recipient's Name</label>
                <input type="text" id="address-name" name="name" class="text-field" value="" placeholder="Enter Name" >
                <p style="color:red;" id="errAddress-name"></p>
            </div>
            <div class="u-s-m-b-30">
                <label for="address-mobile">Recipient's Mobile</label>
                <input type="number" id="address-mobile" name="mobile" class="text-field" value="" placeholder="Enter Mobile">
                <p style="color:red;" id="errAddress-mobile"></p>
            </div>
            <div class="u-s-m-b-30">
                <label for="address-address">Address</label>
                <input type="text" id="address-address" name="address" class="text-field" value="" placeholder="Enter Address" >
                <p style="color:red;" id="errAddress-address"></p>
            </div>
            <div class="u-s-m-b-30">
                <label for="address-country">Country
                </label>
                <select name="country" id="address-country" class="selectCountry">
                    <option value="" selected disabled>-- Select Country --</option>
                    @foreach($countries as $country)
                    <option value="{{ $country['country_name'] }}">{{ $country['country_name'] }}</option>
                    @endforeach
                </select>
                <p style="color:red;" id="errAddress-country"></p>
            </div>
            <div class="group-inline u-s-m-b-13">
                <div class="group-1 u-s-p-r-16">
                    <label for="address-state">State</label>
                    <input type="text" id="address-state" name="state" class="text-field" value="" placeholder="Enter State" >
                    <p style="color:red;" id="errAddress-state"></p>
                </div>
                <div class="group-2">
                    <label for="address-city">City</label>
                    <input type="text" id="address-city" name="city" class="text-field" value="" placeholder="Enter City" >
                    <p style="color:red;" id="errAddress-city"></p>
                </div>
            </div>
            <div class="u-s-m-b-30">
                <label for="address-pincode">PIN Code</label>
                <input type="text" id="address-pincode" name="pincode" class="text-field" value="" placeholder="Enter PIN Code" >
                <p style="color:red;" id="errAddress-pincode"></p>
            </div>
            <button class="button button-primary right">Save Address</button>
        </form>
    </div>
</div>