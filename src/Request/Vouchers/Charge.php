<?php

declare(strict_types=1);

namespace PayNL\Sdk\Request\Vouchers;

use PayNL\Sdk\{
    Exception\MissingParamException,
    Request\AbstractRequest,
    Request\Parameter\CardNumberTrait
};

/**
 * Class Charge
 *
 * @package PayNL\Sdk\Request\Voucher
 */
class Charge extends AbstractRequest
{
    use CardNumberTrait;

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $cardNumber = (string)$this->getParam('cardNumber');
        if (null === $cardNumber) {
            throw new MissingParamException('Missing param!');
        }
        $this->setCardNumber($cardNumber);
    }

    /**
     * @inheritDoc
     */
    public function getUri(): string
    {
        return "vouchers/{$this->getCardNumber()}/charge";
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return static::METHOD_PATCH;
    }
}
