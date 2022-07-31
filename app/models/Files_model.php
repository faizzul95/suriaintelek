<?php

class Files_model extends Model
{
    public $table      = 'files';
    public $primaryKey = 'files_id';
    public $uniqueKey  = ['user_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'files_name',
        'files_original_name',
        'files_folder',
        'files_type',
        'files_mime',
        'files_extension',
        'files_size',
        'file_compression',
        'files_description',
        'files_path',
        'file_path_is_url',
        'entity_type',
        'entity_file_type',
        'entity_id',
        'user_id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected $rules = [];

    /**
     * Custom message for validation
     *
     * @return array
     */
    protected $messages = [];

    /**
     * Call funtion relation
     *
     * @return array
     */
    public $with = [];

    ###################################################################
    #                                                                 #
    #               Start custom function below                       #
    #                                                                 #
    ###################################################################

}
