<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

use App\Models\Review;

class UniqueUserProduct implements DataAwareRule, ValidationRule
{
    protected array $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        global $data;
        $user_id = $value;

        $product_id = $data['product_id'];

        $exists = Review::where('user_id', $user_id)
                        ->where('product_id', $product_id)
                        ->exists();

        if ($exists) {
            $fail('The user has already reviewed this product.');
        }
    }
}
