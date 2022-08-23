@if(session()->has('message'))

    <div x-data="{show:true}" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="alert-message">
        {{ session('message') }}
    </div>

@endif