<?php



namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Customer extends Model
{
    // use HasFactory;
    protected $fillable = [
        'customer'
    ];

    public function project(){
        return $this->belongsTo('App\Models\Project');

    }
    public static function generateUuidForCustomers()
    {
        // Busca todos os customers que tem o campo uuid vazio
        $customers = self::whereNull('uuid')->get();

        // Percorre cada customer e adiciona um UUID4
        foreach ($customers as $customer) {
            $customer->uuid = Uuid::uuid4();
            $customer->save();
        }

        // Retorna o número de customers atualizados
        return count($customers);
    }




}
