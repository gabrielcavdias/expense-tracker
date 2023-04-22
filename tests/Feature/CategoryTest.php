<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
   use RefreshDatabase;

   public function test_category_can_be_created(){
    // Arrange
    $this->withoutExceptionHandling();
    $category = Category::factory()->make();
    
    // Act
    Category::create($category->toArray());
    
    // Assert
    $this->assertDatabaseHas('categories', $category->toArray());
   }

   public function test_category_title_can_be_invoked_from_transaction(){
      // Arrange
      $this->withoutExceptionHandling();
      $category = Category::create(["title" => "Alimentação", "color" => "#00ff00", "icon" => "fas fa-hamburger", "type" => "expense"]);

      // Act
      $transaction = Transaction::create(
         [...Transaction::factory()->make()->toArray(), 'category_id' => $category->id]
      );

      // Assert
      $transaction_with_category = Transaction::where('id', $transaction->id)->with('category')->first();
      $this->assertEquals($transaction_with_category->category->title, $category->title);
   }

}
