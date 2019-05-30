<?php

namespace Folleah\Codegen;

class Generator
{
    private $length;
    private $isEasyRequired;
    private const MAX_LENGTH = 8;
    private const MIN_LENGTH = 4;

    public function __construct(int $length = 6, bool $isEasyRequired = false)
    {
        if ($length < self::MIN_LENGTH || $length > self::MAX_LENGTH) {
            throw new \Exception(
                sprintf('Code length must be between %s and %s.', self::MIN_LENGTH, self::MAX_LENGTH)
            );
        }
        $this->length = $length;
        $this->isEasyRequired = $isEasyRequired;
    }

    /**
     * Generate new code
     *
     * @throws \Exception
     */
    public function generate()
    {
        $digits = $this->length;
        $isEasyRequired = $this->isEasyRequired;
        $isGenCompleted = false;
        $code = null;

        while(!$isGenCompleted) {
            $code = random_int(pow(10, $digits - 1) + 1, pow(10, $digits) - 1);
            $symbols = str_split($code);
            $overlaps = array_count_values($symbols);

            // check that the character repeats no more than 2 times
            foreach ($overlaps as $overlap) {
                if ($overlap > 2) {
                    continue 2;
                }
            }

            foreach (array_count_values($overlaps) as $key => $value) {
                if ($key === 1) {
                    continue;
                }

                if ($key === 2 && $value > 1) {
                    continue 2;
                }
            }

            if ($isEasyRequired && !in_array(2, $overlaps)) {
                continue;
            }

            $isGenCompleted = true;
        }

        return $code;
    }
}