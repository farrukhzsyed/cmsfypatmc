<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'projectId', 'issuedTo', 'invoiceSerial', 'amountToPay', 'dueDate', 
        'paymentEvidence', 'paymentDate', 'isPayEvidenceApproved', 
        'user_id', 'user_type','confirmed_user_id', 'confirmed_user_type',
    ];


     /**
     * Get the projects for the invoice.
     */
    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'projectId');
    }

     /**
     * Get the projects for the invoice.
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'issuedTo');
    }

    /**
     * Get the parent
     */
    public function generatedBy()
    {
        return $this->morphTo('user');
    }

    /**
     * Get the parent
     */
    public function paymentConfirmedBy()
    {
        return $this->morphTo('confirmed_user');
    }


    /**
     * The attributes that are date.
     *
     * @var array
     */
    protected $date = [
        'dueDate', 'paymentDate', 
    ];

}
