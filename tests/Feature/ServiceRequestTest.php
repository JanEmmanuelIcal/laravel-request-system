<?php

use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a student can create a request owned by their account', function () {
    $student = User::factory()->create();

    $response = $this->actingAs($student)->post(route('requests.store'), [
        'item_name' => 'HDMI adapter STAGE-LIB-08',
        'quantity' => 1,
        'purpose' => 'Fictional staging smoke test',
    ]);

    $request = ServiceRequest::query()->firstOrFail();

    $response->assertRedirect(route('requests.index'));
    $this->assertSame($student->id, $request->user_id);
    $this->assertSame($student->name, $request->requester_name);
    $this->assertSame($student->email, $request->requester_email);
    $this->assertSame('pending', $request->status);

    $this->actingAs($student)
        ->get(route('requests.show', $request))
        ->assertOk()
        ->assertSee('HDMI adapter STAGE-LIB-08');
});

test('a student cannot view another students request', function () {
    $owner = User::factory()->create();
    $otherStudent = User::factory()->create();
    $request = makeServiceRequest($owner);

    $this->actingAs($otherStudent)
        ->get(route('requests.show', $request))
        ->assertForbidden();
});

test('a student only sees their own requests in the request list', function () {
    $student = User::factory()->create();
    $otherStudent = User::factory()->create();
    $ownRequest = makeServiceRequest($student);
    $otherRequest = makeServiceRequest($otherStudent, 'Other student request');

    $this->actingAs($student)
        ->get(route('requests.index'))
        ->assertOk()
        ->assertSee($ownRequest->item_name)
        ->assertDontSee($otherRequest->item_name);
});

test('a student cannot update a request status', function () {
    $student = User::factory()->create();
    $request = makeServiceRequest($student);

    $this->actingAs($student)
        ->patch(route('requests.updateStatus', $request), ['status' => 'approved'])
        ->assertForbidden();

    $this->assertSame('pending', $request->fresh()->status);
});

test('a student cannot create a request with invalid fields', function () {
    $student = User::factory()->create();

    $this->actingAs($student)
        ->from(route('requests.index'))
        ->post(route('requests.store'), [
            'item_name' => '',
            'quantity' => 0,
            'purpose' => '',
        ])
        ->assertSessionHasErrors(['item_name', 'quantity', 'purpose']);

    $this->assertDatabaseCount('requests', 0);
});

test('an administrator can update a request to an allowed status', function () {
    $administrator = User::factory()->create(['is_admin' => true]);
    $request = makeServiceRequest(User::factory()->create());

    $this->actingAs($administrator)
        ->patch(route('requests.updateStatus', $request), ['status' => 'approved'])
        ->assertRedirect(route('requests.show', $request))
        ->assertSessionHasNoErrors();

    $this->assertSame('approved', $request->fresh()->status);
});

test('a request status must be one of the allowed values', function () {
    $administrator = User::factory()->create(['is_admin' => true]);
    $request = makeServiceRequest(User::factory()->create());

    $this->actingAs($administrator)
        ->from(route('requests.show', $request))
        ->patch(route('requests.updateStatus', $request), ['status' => 'in-progress'])
        ->assertSessionHasErrors('status');

    $this->assertSame('pending', $request->fresh()->status);
});

function makeServiceRequest(User $owner, string $itemName = 'HDMI adapter'): ServiceRequest
{
    $request = new ServiceRequest;
    $request->user_id = $owner->id;
    $request->requester_name = $owner->name;
    $request->requester_email = $owner->email;
    $request->item_name = $itemName;
    $request->quantity = 1;
    $request->purpose = 'Fictional test data';
    $request->status = 'pending';
    $request->save();

    return $request;
}
