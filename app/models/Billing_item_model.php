<?php

class Billing_item_model extends Model
{
    public $table      = 'billing_item';
    public $primaryKey = 'billing_item_id';
    public $uniqueKey = [];
    public $foreignKey = ['billing_id', 'school_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'billing_item_description',
        'billing_item_qty',
        'billing_item_unit_price',
        'billing_item_total_price',
        'billing_item_type',
        'billing_id',
        'school_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [
        'billing_item_id' => 'numeric',
        'billing_id' => 'numeric',
        'school_id' => 'numeric',
    ];

    /**
     * Custom message for validation
     *
     * @return array
     */
    protected $messages = [];

    ###################################################################
    #                                                                 #
    #               Start custom function below                       #
    #                                                                 #
    ###################################################################


}
