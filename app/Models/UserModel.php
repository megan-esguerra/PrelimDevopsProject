<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $allowedFields = ['first_name', 'last_name', 'email', 'phone', 'password_hash', 'role', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data){
        if (isset($data['data']['password_hash'])) {
            // Check if the password is already hashed to prevent double hashing
            if (!password_get_info($data['data']['password_hash'])['algo']) {
                $data['data']['password_hash'] = password_hash($data['data']['password_hash'], PASSWORD_DEFAULT);
            }
        }
        return $data;
    }

    public function getUserByEmail($email){
        return $this->where('email', $email)->first();
    }
}