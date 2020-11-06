<a href="{{route('notes.add')}}">Add Note</a>
@if(isset($notes) && count($notes)>0)
    @foreach($notes as $note)
        <div style="margin:10px 0px">
            <h2>{{$note->title}}</h2>
            <p>{{$note->body}}</p>
            <p> <a href="{{route('notes.update', $note)}}">update note</a> &nbsp; <a href="#" onclick="event.preventDefault();
                                      document.getElementById('delete-form{{$note->id}}').submit();">delete note</a> </p>
            <form id="delete-form{{$note->id}}" action="{{route('notes.delete', $note->id)}}" method="POST" style="display: none;">
                      {{method_field('DELETE')}}
                        @csrf
            </form>
        </div>
    @endforeach

@else
    <p>No notes found</p>
@endif