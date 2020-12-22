<?php

namespace App\Repositories;
use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all()
    {
        return Customer::orderBy('name')
                    ->where('active',1)
                    ->with('user')
                    ->get()
                    ->map(function($customer){
                        return $this->format($customer);
                    });
    }

    public function findById($customerId)
    {
        $customer = Customer::where('id',$customerId) 
                        ->where('active',1)
                        ->with('user')
                        ->firstOrFail();

        return $this->format($customer);
    }
    
    protected function format($customer)
    {
        return [
            'customer_id' => $customer->id,
            'name' => $customer->name,
            'created_by' => $customer->user->email,
            // 'last_updated' => $customer->updated_at->diffForHumans(),
        ];
    }
}