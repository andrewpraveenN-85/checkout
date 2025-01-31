<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property string $transaction_date
 * @property int $account_id
 * @property int $company_id
 * @property string $type
 * @property float $amount
 * @property string|null $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Accounts $account
 * @property Companies $company
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_date', 'created_at', 'updated_at'], 'safe'],
            [['account_id', 'company_id', 'type', 'amount'], 'required'],
            [['account_id', 'company_id'], 'integer'],
            [['type'], 'string'],
            [['amount'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accounts::class, 'targetAttribute' => ['account_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_date' => 'Transaction Date',
            'account_id' => 'Account ID',
            'company_id' => 'Company ID',
            'type' => 'Type',
            'amount' => 'Amount',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Account]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Accounts::class, ['id' => 'account_id']);
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }
}
