<?php

declare(strict_types=1);

namespace PayNL\Sdk\Hydrator;

use Zend\Hydrator\ClassMethods;
use PayNL\Sdk\Hydrator\{
    BankAccount as BankAccountHydrator,
    Status as StatusHydrator
};
use PayNL\Sdk\Model\{
    Amount,
    BankAccount,
    Directdebit as DirectdebitModel,
    Status
};

/**
 * Class Directdebit
 *
 * @package PayNL\Sdk\Hydrator
 */
class Directdebit extends AbstractHydrator
{
    /**
     * @inheritDoc
     *
     * @return DirectdebitModel
     */
    public function hydrate(array $data, $object): DirectdebitModel
    {
        $this->validateGivenObject($object, DirectdebitModel::class);

        if (true === array_key_exists('amount', $data)) {
            $data['amount'] = (new ClassMethods())->hydrate($data['amount'], new Amount());
        }

        if (true === array_key_exists('bankAccount', $data)) {
            $data['bankAccount'] = (new BankAccountHydrator())->hydrate($data['bankAccount'], new BankAccount());
        }

        if (true === array_key_exists('status', $data) && null !== $data['status']['code']) {
            $data['status'] = (new StatusHydrator())->hydrate($data['status'], new Status());
        }

        if (true === array_key_exists('declined', $data) && null !== $data['declined']['code']) {
            $data['declined'] = (new StatusHydrator())->hydrate($data['declined'], new Status());
        }

        foreach (['status', 'declined'] as $statusField) {
            if (false === ($data[$statusField] instanceof Status)) {
                unset($data[$statusField]);
            }
        }

        /** @var DirectdebitModel $directdebit */
        $directdebit = parent::hydrate($data, $object);
        return $directdebit;
    }
}
