<form id="verifyOTP" action="javascript:;" method="post">@csrf
    <div class="otp-verify">
        <div class="otp-container">
            <h1>{{$title}}</h1>
            <p>
              We Emailed you the six digit code to {{$email}}, <br />
              Enter the code below to {{$subtitle}}.
            </p>
            <input type="hidden" id="email" value="{{$email}}">
            <input type="hidden" id="password" value="{{$password}}">
            <h3 style="color:red;" id="otp-error"></h3>
            <div class="otp">
              <input type="text" class="code" maxlength="1" />
              <input type="text" class="code" maxlength="1" />
              <input type="text" class="code" maxlength="1" />
              <input type="text" class="code" maxlength="1" />
              <input type="text" class="code" maxlength="1" />
              <input type="text" class="code" maxlength="1" />
            </div>
            <button class="verify-otp">Validate</button><br />
            <small>
              If you didn't get the code! <strong><a href="">Resend Code</a> </strong>
            </small>
        </div>
    </div>
</form>