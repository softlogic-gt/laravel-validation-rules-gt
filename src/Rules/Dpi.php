<?php
namespace SoftlogicGT\ValidationRulesGT\Rules;

use Illuminate\Contracts\Validation\Rule;

class Dpi implements Rule
{
    /** @var bool */
    protected $dpi;

    /** @var string */
    protected $attribute;

    public function __construct(bool $dpi = true)
    {
        $this->dpi = $dpi;
    }

    public function nullable(): self
    {
        $this->dpi = false;

        return $this;
    }

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        $munisPorDepto = [
            /* 01 - Guatemala tiene:      */17/* municipios. */,
            /* 02 - El Progreso tiene:    */8/* municipios. */,
            /* 03 - Sacatepéquez tiene:   */16/* municipios. */,
            /* 04 - Chimaltenango tiene:  */16/* municipios. */,
            /* 05 - Escuintla tiene:      */13/* municipios. */,
            /* 06 - Santa Rosa tiene:     */14/* municipios. */,
            /* 07 - Sololá tiene:         */19/* municipios. */,
            /* 08 - Totonicapán tiene:    */8/* municipios. */,
            /* 09 - Quetzaltenango tiene: */24/* municipios. */,
            /* 10 - Suchitepéquez tiene:  */21/* municipios. */,
            /* 11 - Retalhuleu tiene:     */9/* municipios. */,
            /* 12 - San Marcos tiene:     */30/* municipios. */,
            /* 13 - Huehuetenango tiene:  */32/* municipios. */,
            /* 14 - Quiché tiene:         */21/* municipios. */,
            /* 15 - Baja Verapaz tiene:   */8/* municipios. */,
            /* 16 - Alta Verapaz tiene:   */17/* municipios. */,
            /* 17 - Petén tiene:          */14/* municipios. */,
            /* 18 - Izabal tiene:         */5/* municipios. */,
            /* 19 - Zacapa tiene:         */11/* municipios. */,
            /* 20 - Chiquimula tiene:     */11/* municipios. */,
            /* 21 - Jalapa tiene:         */7/* municipios. */,
            /* 22 - Jutiapa tiene:        */17, /* municipios. */
        ];

        preg_match('/^[0-9]{4}\s?[0-9]{5}\s?[0-9]{4}$/', $value, $matches);

        if (empty($matches)) {
            return false;
        }

        $value       = str_replace(' ', '', $value);
        $depto       = (int) substr($value, 9, 2);
        $muni        = (int) substr($value, 11, 2);
        $numero      = substr($value, 0, 8);
        $verificador = (int) substr($value, 8, 1);

        if ($depto === 0 || $muni === 0) {
            return false;
        }

        if ($depto > count($munisPorDepto)) {
            return false;
        }

        if ($muni > $munisPorDepto[$depto - 1]) {
            return false;
        }

        $total = 0;
        for ($i = 0; $i < strlen($numero); $i++) {
            $total += $numero[$i] * ($i + 2);
        }
        $modulo = ($total % 11);

        if ($modulo != $verificador) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return __('validationRulesGT::messages.dpi', [
            'attribute' => $this->attribute,
        ]);
    }
}
