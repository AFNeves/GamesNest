<?php

namespace App\Rules;

use App\Models\Review;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueUserProduct implements DataAwareRule, ValidationRule
{
    protected array $data = [];

    /**
     * Set additional data for the rule.
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Validate the rule.
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $user_id = $value; // The value being validated is the user_id

        // Ensure the product_id is present in the provided data
        $product_id = $this->data['product_id'] ?? null;

        if (!$product_id) {
            $fail('The product_id field is required for this validation.');
            return;
        }

        // Check if the review already exists for the user and product
        $exists = Review::where('user_id', $user_id)
                        ->where('product_id', $product_id)
                        ->exists();

        if ($exists) {
            $fail('The user has already reviewed this product.');
        }
    }
}
