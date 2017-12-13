<?php

namespace Tests\Feature;

use App\Invitation;
use Tests\TestCase;
use App\Facades\InvitationCode;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvitePromoterTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function inviting_a_promoter_via_cli()
	{
		InvitationCode::shouldReceive('generate')->andReturn('TESTCODE1234');

	    $this->artisan('invite-promoter', ['email' => 'john@example.com']);

	    $this->assertEquals(1, Invitation::count());
	    $invitation = Invitation::first();
	    $this->assertEquals('john@example.com', $invitation->email);
	    $this->assertEquals('TESTCODE1234', $invitation->code);
	}
}
