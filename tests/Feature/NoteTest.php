<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_if_can_retrieve_all_notes(){
        $note = factory('App\Note')->create();
        $response = $this->get(route('notes.all'));
        $response->assertStatus(200)
            ->assertSeeText($note->title)
            ->assertSeeText($note->body);
    }

    public function test_if_can_add_new_note(){
        $newNote = ['title'=>'new note title', 'body'=>'and here is a long body'];
        $response = $this->post(route('notes.add'), $newNote);
        $response->assertStatus(302)->assertRedirect(route('notes.all'));
    }

    public function test_if_can_delete_note(){
        $note = factory('App\Note')->create();
        $response = $this->delete(route('notes.delete', $note));
        $response->assertStatus(302)->assertRedirect(route('notes.all'));
    }

    public function test_if_can_update_note(){
        $note = factory('App\Note')->create();
        $newNote = ['title'=>'new note title', 'body'=>'and here is a long body'];
        $response = $this->put(route('notes.update', $note), $newNote);
        $response->assertStatus(302)->assertRedirect(route('notes.all'));
    }

}
