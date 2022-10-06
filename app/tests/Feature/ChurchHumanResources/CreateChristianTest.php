<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\ChurchHumanRessources;

use App\Models\ChurchHumanRessources\Christian;
use Illuminate\Http\UploadedFile;
use Tests\Feature\ChurchHumanResources\TestCase;

class CreateChristianTest extends TestCase
{
    /** @test */
    public function user_signin()
    {
        $before = Christian::all()->toArray();

        $this
            ->postJson('/authentication/signin', [
                'firstname' => 'Florence',
                'lastname' => 'HOFMANN',
                'email' => 'fgaconcamoz@gmail.com',
                'password' => '@Zertyu1p23',
                'birthdate' => '1987-03-03',
                'phone' => '+33600000000',
                'profile_picture' => UploadedFile::fake()->image('avatar.jpg'),
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'code',
                'message',
                'data' => ['token']
            ]);
        
        $after = Christian::all()->toArray();

        $this->assertCount(count($before) + 1, $after);

        $christian = Christian::where('email', 'fgaconcamoz@gmail.com')->first();

        $this->assertEquals('Florence', $christian->firstname);
        $this->assertEquals('HOFMANN', $christian->lastname);
        $this->assertEquals('fgaconcamoz@gmail.com', $christian->email);
        $this->assertEquals('1987-03-03', $christian->birthdate);
        $this->assertEquals('+33 6 00 00 00 00', $christian->phone);
        $this->assertNotEmpty($christian->profile_picture);
    }
}
