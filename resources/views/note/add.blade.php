<form action="{{route('notes.add')}}" method="post">
    @csrf
    <div>
        <label for="title">Title</label>
        <input type="text" name="title">
    </div>

    <div>
        <label for="body"></label>
        <textarea name="body" id="" cols="30" rows="10"></textarea>
    </div>

    <button type="submit">Create note</button>
</form>