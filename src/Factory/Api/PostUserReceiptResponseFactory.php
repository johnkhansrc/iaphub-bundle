<?php

namespace Johnkhansrc\IaphubBundle\Factory\Api;

use Johnkhansrc\IaphubBundle\Model\Api\PostUserReceiptResponse;

class PostUserReceiptResponseFactory
{
    /**
     * @throws \Exception
     */
    public static function build(array $data): PostUserReceiptResponse
    {
        try {

            $newTransactions = [];
            foreach ($data['newTransactions'] as $transactionData) {
                $newTransactions[] = TransactionFactory::build($transactionData);
            }
            $oldTransactions = [];
            foreach ($data['oldTransactions'] as $transactionData) {
                $oldTransactions[] = TransactionFactory::build($transactionData);
            }

            return new PostUserReceiptResponse($data['status'], $newTransactions, $oldTransactions);
        } catch (\Exception $exception) {
            dd($data, $exception);
        }
    }
}