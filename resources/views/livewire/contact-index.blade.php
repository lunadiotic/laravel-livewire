<div>
    <ul>
        @foreach ($contacts as $contact)
            <li>{{ $contact->name }}</li>
        @endforeach
    </ul>
</div>
