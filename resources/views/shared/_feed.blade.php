@if($feedItems->isNotEmpty())
    <ul class="list-unstyled">
        @foreach($feedItems as $status)
            @include('$status._status', ['user' => $status])
        @endforeach
    </ul>
    <div class="mt-5">
        {!! $feedItems !!}
    </div>
@else
    <p>no数据</p>
@endif
