<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Note;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_can_retrieve_all_notes(){
        $note1 = factory('App\Note')->create();
        $note2 = factory('App\Note')->create();
        $response = $this->get(route('api.notes.all'));
        $response->assertStatus(200)
            ->assertJson([$note1->toArray(), $note2->toArray()]);
    }

    public function test_if_can_add_new_note(){
        $this->assertTrue(Note::count()==0);
        $newNote = ['title'=>'new note title', 'body'=>'and here is a long body'];
        $response = $this->post(route('api.notes.add'), $newNote);
        $response->assertStatus(201)->assertJsonFragment($newNote);
        $this->assertTrue(Note::count()==1);
    }

    public function test_if_can_delete_note(){
        $note = factory('App\Note')->create();
        $this->assertTrue(Note::count()==1);
        $response = $this->delete(route('api.notes.delete', $note));
        $response->assertStatus(200)->assertJson($note->toArray());
        $this->assertTrue(Note::count()==0);
    }

    public function test_if_can_update_note(){
        $note = factory('App\Note')->create();
        $newNote = ['title'=>'new note title', 'body'=>'and here is a long body'];
        $response = $this->put(route('api.notes.update', $note), $newNote);
        $response->assertStatus(201)->assertJsonFragment($newNote);
    }
}
