<?php

readonly class SmartResult
{

    public function __construct(private string $searchedValue, private array $givenValues, private string $operationMethod, private int|float|string|null $result) {}

    /**
     * @return string
     */
    public function getSearchedValue(): string
    {
        return $this->searchedValue;
    }

    /**
     * @return string[]
     */
    public function getGivenValues(): array
    {
        return $this->givenValues;
    }

    /**
     * @return string
     */
    public function getOperationMethod(): string
    {
        return $this->operationMethod;
    }

    /**
     * @param int $dezimalPrecision
     * @return float|int|string|null
     */
    public function getResult(int $dezimalPrecision = 2): float|int|string|null
    {
        return round($this->result, $dezimalPrecision);
    }
}