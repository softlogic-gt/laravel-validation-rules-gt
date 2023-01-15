<?php
namespace SoftlogicGT\ValidationRulesGT\Rules;

use Illuminate\Contracts\Validation\Rule;

class Nit implements Rule
{
    /** @var bool */
    protected $nit;

    /** @var string */
    protected $attribute;

    public function __construct(bool $nit = true)
    {
        $this->nit = $nit;
    }

    public function nullable(): self
    {
        $this->nit = false;

        return $this;
    }

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        if ($this->nit == 'CF') {
            return true;
        }

        //Validation logic

        return true;
    }

    public function message(): string
    {
        return __('validationRulesGT::messages.nit', [
            'attribute' => $this->attribute,
        ]);
    }
}
