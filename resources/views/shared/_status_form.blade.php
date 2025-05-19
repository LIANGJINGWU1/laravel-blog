<form action="{{ route('statuses.store'}}" method = "POTS">
    @include('shared._errors')
    @csrf
    <textarea class="form-control" rows="3" placeholder="man~~" name="content">{{ old('content') }}</textarea>

    <div class="text-end">
        <button type="submit" class="btn btn-primary mt-3">发布</button>
    </div>
</form>
