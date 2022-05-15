<?php

namespace App\Rules\Admin;

use App\Models\CarType;
use App\Models\plan;
use Illuminate\Contracts\Validation\Rule;
use phpDocumentor\Reflection\Types\Integer;

class CheckPlan implements Rule
{
    private string $carType;

    /**
     * CheckPlan constructor.
     * @param string $carType
     */
    public function __construct(string $carType)
    {
        $this->carType = $carType;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $plan = plan::findOrFail($value);
        $carType = CarType::findOrFail($this->carType);
        return $plan->car_id === $carType->car_id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'نوع خودرو و گروه تعرفه ای مجاز نیستند';
    }
}
