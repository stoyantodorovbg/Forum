@forelse( $threads as $thread)
    @include('threads._list-item')
@empty
    <p>{{ label('no_results') }}</p>
@endforelse