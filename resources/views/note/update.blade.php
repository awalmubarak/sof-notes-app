<form action="{{route('notes.update', $note->id)}}" method="post">
    @csrf
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" value="{{$note->title}}">
    </div>

    <div>
        <label for="body"></label>
        <textarea name="body" id="" cols="30" rows="10">{{$note->body}}</textarea>
    </div>

    <button type="submit">Update note</button>
</form>