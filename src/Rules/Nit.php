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

        if ($value == 'CF') {
            return true;
        }

        preg_match('/^[0-9]+(-?[0-9kK])?$/', $value, $matches);

        if (empty($matches)) {
            return false;
        }

        $value  = str_replace('-', '', $value);
        $parity = strtolower(substr($value, -1, 1));
        $index  = strlen($value);
        $total  = 0;
        for ($i = 0; $i < strlen($value) - 1; $i++) {
            $total += ($value[$i] * $index);
            $index--;
        }

        $modulus       = (11 - ($total % 11)) % 11;
        $computedCheck = ($modulus == 10 ? 'k' : $modulus);

        return $parity == $computedCheck;
    }

    public function message(): string
    {
        return __('validationRulesGT::messages.nit', [
            'attribute' => $this->attribute,
        ]);
    }
}
