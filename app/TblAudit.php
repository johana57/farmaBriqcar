<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TblAudit extends Model
{
    protected $table = 'tbl_audit';
    
    protected $fillable = ['TableName', 'Operation', 'OldValue', 'NewValue'];
    protected $guarded = ['pk_audit', 'UserName', 'UpdateDate'];
}
