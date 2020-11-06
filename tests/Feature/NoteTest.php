<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Note;

class NoteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public $notesArray = [
        ['title'=>'hello there', 'body'=>'this is a long body'],
        ['title'=>'hello there2', 'body'=>'this is a long body again'],
    ];

    public function setUp(): void{
        parent::setUp();
        foreach($this->notesArray as $note){
            Note::create($note);
        }
    }


    public function test_if_can_retrieve_all_notes(){
        $response = $this->get('/notes');
        $response->assertStatus(200);
        $response ->assertSeeTextInOrder([$this->notesArray[0]['title'], $this->notesArray[0]['body'], $this->notesArray[1]['title'], $this->notesArray[1]['body']]);
    }

}
