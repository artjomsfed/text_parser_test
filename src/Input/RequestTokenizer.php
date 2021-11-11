<?php
declare(strict_types=1);


namespace TextParser\Input;


class RequestTokenizer
{
    public function tokenize(array $input): array
    {
        $arguments = array_slice($input, 1);

        $tokens = [];

        $argumentCount = count($arguments);
        for ($i = 0; $i < $argumentCount; $i++) {
            $nextIndex = $i + 1;
            $value = $arguments[$i];
            $nextValue = $nextIndex < $argumentCount ? $arguments[$nextIndex] : null;

            if ($this->isLongFlag($value)) {
                $parts = explode('=', $value);
                $token = reset($parts);
                $tokenValue = count($parts) > 1 ? end($parts) : '';
                $tokens[$token] = $tokenValue;

                continue;
            }

            if ($this->isShortFlagWithValue($value, $nextValue)) {
                $tokens[$value] = $nextValue;
                $i++;

                continue;
            }

            if ($this->isSingleShortFlag($value, $nextValue)) {
                $tokens[$value] = '';
            }
        }

        return $tokens;
    }

    private function isShortFlagWithValue(string $input, ?string $nextValue): bool
    {
        if (!$nextValue) {
            return false;
        }

        return str_starts_with($input, '-') && !($this->isLongFlag($nextValue) || $this->isShortFlag($nextValue));
    }

    private function isSingleShortFlag(string $input, ?string $nextValue): bool
    {
        $isShortFlag = $this->isShortFlag($input);

        return $isShortFlag && ($this->isLongFlag($nextValue) || $this->isShortFlag($nextValue) || $nextValue === null);
    }

    private function isShortFlag(?string $input): bool
    {
        if (!$input) {
            return false;
        }

        return str_starts_with($input, '-');
    }

    private function isLongFlag(?string $input): bool
    {
        if (!$input) {
            return false;
        }

        return str_starts_with($input, '--');
    }
}