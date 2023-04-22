<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Transaction;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_transactions_view_can_be_rendered()
    {
        // Arrange

        // Act
        $response = $this->withoutExceptionHandling()->get('/');

        // Assert
        $response->assertStatus(200);
    }

    public function test_transactions_list_can_be_fetched(){
        // Arrange
        $category_id = Category::factory()->create()->id;
        $transactions = Transaction::factory(5)->create(["category_id" => $category_id]);

        // Act
        $response = $this->withoutExceptionHandling()->getJson('/api/transactions');
        // Assert
        $response->assertStatus(200)->assertJsonCount(5);
        
    }

    public function test_transaction_single_can_be_fetched(){
        // Arrange
        $category_id = Category::factory()->create()->id;
        $transaction = Transaction::factory()->create(["category_id" => $category_id]);
        
        // Act
        $route = "/api/transactions/show/".$transaction->id;
        $response = $this->withoutExceptionHandling()->getJson($route);

        // Assert
        $response->assertStatus(200)->assertJson($transaction->toArray());

    }

    public function test_transactions_can_be_created(){
        // Arrange
        $this->withoutExceptionHandling();
        $transaction = Transaction::factory()->make();

        // Act
        $response = $this->postJson("/api/transactions/store", $transaction->toArray());

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas("transactions", $transaction->toArray());
    }

    public function test_transactions_can_be_updated(){
        // Arrange
        $this->withoutExceptionHandling();
        $transaction = Transaction::factory()->create();
        $updatedTransaction = [
            "title" => "Coca-cola 2.5L",
            "value" => "10.00",
            "type" => "expense",
        ];
        $route = "/api/transactions/update/".$transaction->id;
        // Act
        $response = $this->putJson($route, $updatedTransaction);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas("transactions", ["id" => $transaction->id, ...$updatedTransaction]);
    }

    /**
     * @dataProvider provideBadTransactionData
     */
    public function test_create_transaction_validations($missing, $transaction){
        // Arrange 
        // Arrange came from dataProvider
        

        // Act
        $response = $this->postJson('/api/transactions/store', $transaction);

        // Assert
        $response->assertJsonValidationErrors([$missing]);
    }

    /**
     * @dataProvider provideBadTransactionData
     */
    public function test_update_transaction_validations($missing, $transaction){
        // Arrange
        $transaction_id = Transaction::factory()->create()->id;
        $route = "/api/transactions/update/".$transaction_id;
        // Act
        $response = $this->putJson($route, $transaction);

        // Assert
        $response->assertJsonValidationErrors([$missing]);
    }


    public function provideBadTransactionData(){
        $transaction = Transaction::factory()->make();

        return [
            "missing title" => [
                'title', [
                    ...$transaction->toArray(),
                    "title" => null,
                ],
            ],
            "missing value" => [
                'value', [
                    ...$transaction->toArray(),
                    "value" => null,
                ],
            ],
            "missing type" => [
                'type', [
                    ...$transaction->toArray(),
                    "type" => null,
                ],
            ],
        ];
    }

    public function test_transactions_can_be_deleted(){
         // Arrange
         $this->withoutExceptionHandling();
         $transaction_id = Transaction::factory()->create()->id;
         $route = "/api/transactions/destroy/".$transaction_id;
         // Act
         $response = $this->delete($route);

        //  Assert
        $this->assertDatabaseMissing('transactions', [
            "id" => $transaction_id,
        ]);
        
    }

}
