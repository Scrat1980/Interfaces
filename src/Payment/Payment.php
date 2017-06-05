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
    public $paymentId;
    public $created;
    public $updated;
    public $isTest;
    public $currency;
    public $amount;
    public $taxAmount;
    public $state;

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
        $this->validateInput($amount, $taxAmount, $paymentId);
        $this->assignProperties(
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

    private function assignProperties(
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
        $this->paymentId = $paymentId;
        $this->created = clone $created;
        $this->updated = clone $updated;
        $this->isTest = $isTest;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->taxAmount = $taxAmount;
        $this->state = $state;

    }

    private function validateInput($amount, $taxAmount, $paymentId)
    {
        $amountIsValid = ($amount >= 0);
        if (!$amountIsValid) {
            throw new \InvalidArgumentException("Amount is negative");
        }

        $taxAmountIsValid = ($taxAmount >= 0);
        if (!$taxAmountIsValid) {
            throw new \InvalidArgumentException("Tax amount is negative");
        }

        $paymentIdIsValid = (strlen($paymentId) > 0);
        if (!$paymentIdIsValid) {
            throw new \InvalidArgumentException("Payment id is invalid");
        }

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