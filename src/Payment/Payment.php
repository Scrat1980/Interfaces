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

    /**
     * Идентификатор платежа
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->paymentId;
    }

    /**
     * Дата создания платежа
     *
     * @return \DateTimeInterface
     */
    public function getCreated(): \DateTimeInterface
    {
        return $this->created;
    }

    /**
     * Дата последнего обновления платежа
     *
     * @return \DateTimeInterface
     */
    public function getUpdated(): \DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * Признак тестового платежа
     *
     * @return bool
     */
    public function isTest(): bool
    {
        return $this->isTest;
    }

    /**
     * Валюта платежа
     *
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * Сумма платежа включая сумму налога
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Сумма налога от платежа
     *
     * @return float
     */
    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    /**
     * Идентификатор состояния платежа
     *
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

}