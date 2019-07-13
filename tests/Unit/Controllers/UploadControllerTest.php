<?php

namespace Tests\Unit\Controllers;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadControllerTest extends TestCase
{
    /** @test */
    public function it_should_return_file_name_with_extension()
    {
        $file = UploadedFile::fake()->image('whatever.png');
        dd($file->hashName());
    }


}