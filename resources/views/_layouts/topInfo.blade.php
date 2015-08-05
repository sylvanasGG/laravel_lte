@if (count($errors) > 0 || session('info'))
        @foreach ($errors->all() as $error)
        <div class="alert alert-warning" style="margin-bottom: 0;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $error }}
        </div>
        @endforeach
        @if(session('info'))
            <div class="alert alert-success" style="margin-bottom: 0;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('info') }}
            </div>
        @endif
@endif