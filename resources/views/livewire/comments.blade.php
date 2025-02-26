<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    @if (count($comments))
        <div class="bg-white p-6 shadow rounded-lg mb-8">
            <ul>
                @foreach ($comments as $index => $comment)
                    <li>
                        {{ $comment }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
