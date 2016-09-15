@if(Session::has('warning'))
                <div class="alert alert-warning margin-top-70">
                    @if(Session::has('flash_message_important')))
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    @endif
                    <span class="">{{ Session::get('warning') }}</span>
                </div>
@endif

@if(Session::has('success'))
                <div class="alert alert-success margin-top-70">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <span class="">{{ Session::get('success') }}</span>
                </div>
@endif

@if(Session::has('error'))
                <div class="alert alert-danger margin-top-70">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <span class="">{{ Session::get('error') }}</span>
                </div>
@endif


@if($errors)
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endif

