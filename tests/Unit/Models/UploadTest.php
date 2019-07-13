<?php

namespace Tests\Unit\Models;

use App\Upload;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UploadTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->upload = new Upload;
    }
    /** @test */
    public function it_has_filename_size_approved_fillable()
    {
        // expected , actual
        $this->assertEquals([
        'filename',
        'size',
        'approved'
    ], $this->upload->getFillable());
    }
    /** @test */
    public function it_matches_the_class_type()
    {
       // foreign , local , tablename, type of class
        //dd(class_basename($this->upload->file()));
        $this->assertInstanceOf(BelongsTo::class,$this->upload->file());
    }
    /** @test */
    public function it_matches_the_files_table_key_as_foreign_key()
    {
     // dd($this->upload->file()->getQualifiedForeignKey());
        $this->assertEquals('uploads.file_id',$this->upload->file()->getQualifiedForeignKey());
    }
        /** @test */
    public function it_matches_the_files_table_key_as_local_key()
    {
    //  dd($this->upload->file()->getQualifiedParentKeyName());
        $this->assertEquals('uploads.id', $this->upload->file()->getQualifiedParentKeyName());
    }
    /** @test */
    public function it_matches_the_relationship_type_belongsTo()
    {
      //  dd(class_basename($this->upload->user()));
        $this->assertInstanceOf(BelongsTo::class, $this->upload->user());
    }
    /** @test */
    public function it_matches_the_users_table_key_as_foreign_key()
    {
     //   dd($this->upload->user()->getQualifiedForeignKey());
        $this->assertEquals('uploads.user_id', $this->upload->user()->getQualifiedForeignKey());
    }
    /** @test */
    public function it_matches_the_users_table_key_as_primary_key()
    {
       // dd($this->upload->user()->getQualifiedParentKeyName());
        $this->assertEquals('uploads.id', $this->upload->user()->getQualifiedParentKeyName());
    }

}
