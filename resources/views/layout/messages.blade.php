@if(session("error"))
    <div class="alert alert-danger" role="alert">
        {{ session("error") }}
    </div>
@endif

@isset($error)
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
@endisset

@if(session("success"))
    <div class="alert alert-success" role="alert">
        {{ session("success") }}
    </div>
@endif

@error("email")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@error("password")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@error("name")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@error("account")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@error("serial")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@error("type_device_id")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@error("state")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@error("brand")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@error("model")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror

@error("labeling")
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror
