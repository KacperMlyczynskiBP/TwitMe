<?php
namespace Tests\Feature;

use App\Models\Client;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClientTest extends TestCase
{
   public function test_store_client(){
       $client=Client::factory()->create();
    $response=$this->post('clients/store', $client->toArray());
    $response->assertRedirect(route('clients.index'));
      $this->assertDatabaseHas('clients',$client->toArray());
   }

   public function test_update_client(){
       $client=Client::factory()->create();
       $client->contact_name='Marek Blasczek';
       $response=$this->put(route('clients.update', ['client'=>$client->id]), $client->toArray());
       $response->assertRedirect(route('clients.index'));
       $this->assertDatabaseHas('clients', ['id'=>$client->id, 'contact_name'=>'Marek Blasczek']);
   }

   public function test_delete_client(){
       $client=Client::factory()->create();
       $response=$this->get(route('clients.destroy',['client'=>$client->id]));
       $this->assertDatabaseMissing('clients', ['id'=>$client->id]);
   }

   public function test_edit_client(){
       $client=Client::factory()->create();
       $response=$this->get(route('clients.edit', ['client'=>$client->id]));
       $response->assertOk();
       $response->assertViewIs('clients.edit');
   }

   public function test_index_client(){
       $response=$this->get(route('clients.index'));
       $response->assertOk();
       $response->assertViewIs('clients.index');
   }
}
