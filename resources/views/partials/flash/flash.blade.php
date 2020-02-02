
@if (session('status'))
    @include('partials.flash._template', ['type' => 'success', 'message' => session('status') ])
@endif

@if (session('success'))
    @include('partials.flash._template', ['type' => 'success', 'message' => session('success') ])
@endif

@if (session('error'))
    @include('partials.flash._template', ['type' => 'danger', 'message' => session('error') ])
@endif

@if (session('info'))
    @include('partials.flash._template', ['type' => 'info', 'message' => session('info') ])
@endif