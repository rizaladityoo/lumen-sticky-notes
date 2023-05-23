<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class NoteControllerTestUnit extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testGetNote()
    {
        $note = Note::factory()->create();

        $request = new \Illuminate\Http\Request([
            'page_size' => 10,
        ]);

        $controller = new NoteController();
        $response = $controller->getNote($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStructure($response->getContent(), [
            'data' => [
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'content',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'pagination' => [
                    'total',
                    'current_page',
                    'per_page',
                    'next_page_url',
                    'previous_page_url',
                    'first_page_url',
                    'last_page_url',
                ],
            ],
        ]);
    }
}