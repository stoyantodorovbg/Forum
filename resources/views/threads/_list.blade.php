@forelse( $threads as $thread)
    @include('threads._list-item')
@empty
    <p>There are no relevant results at this time.</p>
@endforelse