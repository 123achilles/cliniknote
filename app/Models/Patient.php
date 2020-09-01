<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primaryKey = 'clientId';
    protected $fillable = [
        'clientId',
        'firstName',
        'lastName',
        'email',
        'addressLine1',
        'addressLine2',
        'birthDate',
        'mobilePhone',
        'homePhone',
        'workPhone',
//        'dob',
//        'practiceId',
//        'deIdentifiedId',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class,'clientId','clientId');
    }

}
