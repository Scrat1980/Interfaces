<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.05.17
 * Time: 12:09
 */

namespace Playkot\PhpTestTask\Payment;


use PHPUnit\Framework\Constraint\IsInstanceOf;

class Payment implements IPayment
{
    private $paymentId;
    private $created;
    private $updated;
    private $isTest;
    private $currency;
    private $amount;
    private $taxAmount;
    private $state;

    public static function instance(
        string                  $paymentId,
        \DateTimeInterface      $created,
        \DateTimeInterface      $updated,
        bool                    $isTest,
        Currency                $currency,
        float                   $amount,
        float                   $taxAmount,
        State                   $state
    ): IPayment
    {
        return new self (
            $paymentId,
            $created,
            $updated,
            $isTest,
            $currency,
            $amount,
            $taxAmount,
            $state
        );
    }

    public function __construct(
        $paymentId,
        $created,
        $updated,
        $isTest,
        $currency,
        $amount,
        $taxAmount,
        $state
    )
    {
        $createdValid = ($created instanceof \DateTimeInterface);
        if (!$createdValid) {
            throw new \InvalidArgumentException("Field Created at is of invalid type");
        }

        $isTestType = gettype($isTest);
        if ($isTestType !== 'boolean') {
            throw new \InvalidArgumentException("Wrong type provided for isType
            variable: boolean expected, $isTestType given");
        }

        $this->paymentId = $paymentId;
        $this->created = $created;
        $this->updated = $updated;
        $this->isTest = $isTest;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->taxAmount = $taxAmount;
        $this->state = $state;
    }

    public function getId(): string
    {
        return $this->paymentId;
    }

    public function getCreated(): \DateTimeInterface
    {
        return $this->created;
    }

    public function getUpdated(): \DateTimeInterface
    {
        return $this->updated;
    }

    public function isTest(): bool
    {
        return $this->isTest;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    public function getState(): State
    {
        return $this->state;
    }

}