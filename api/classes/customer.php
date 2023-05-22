<?php

class customer
{
    public $id;
    public $order_id;
    public $name;
    public $last_name;
    public $email;
    public $phone;
    public $street;
    public $city;
    public $zip;
    public $state;
    public $country;
    public $payment_method;
    public $payment_transaction_id;
    public $paypal_payer_id;
    public $payment_date;
    public $payment_info = null;
    public $lineItems;
    public $total;
    public $created_at;
    public $updated_at;

    public function __construct($name = "", $last_name = "", $email = "", $phone = "", $street, $city, $zip, $state, $country, $lineItems = [], $total = 0, $payment_method = "PayPal")
    {
            $this->name = $name;
            $this->last_name = $last_name;
            $this->email = $email;
            $this->phone = $phone;
            $this->street = $street;
            $this->city = $city;
            $this->zip = $zip;
            $this->state = $state;
            $this->country = $country;
            $this->lineItems = json_encode($lineItems);
            $this->total = $total;
            $this->payment_method = $payment_method;
            $this->id = $this->generateCustomerId();
            $this->order_id = $this->generateOrderId();
    }

    public function approvePayment($customer_id, $paypal_payer_id) {
        $db = new DB();
        $db->query("UPDATE customers SET paypal_payer_id = :paypal_payer_id, payment_date = :payment_date WHERE id = :id");
        $db->bind(":paypal_payer_id", $paypal_payer_id);
        $db->bind(":payment_date", date("Y-m-d H:i:s"));
        $db->bind(":id", $customer_id);
        $db->execute();
    }

    public function updatePaymentStatus($customer_id, $status) {
        $db = new DB();
        $db->query("UPDATE customers SET bezahlt = :bezahlt WHERE id = :id");
        $db->bind(":bezahlt", $status);
        $db->bind(":id", $customer_id);
        $db->execute();
    }

    public function getPaymentInfo($customer_id) {
        $db = new DB();
        $db->query("SELECT * FROM customers WHERE id = :id");
        $db->bind(":id", $customer_id);
        $customer = $db->single();
        return $customer;
    }

    public function generateCustomerId()
    {
        $customer_id = md5(uniqid(rand(), true));
        return $customer_id;
    }

    public function generateOrderId()
    {
        $order_id = md5(uniqid(rand(), true));
        return $order_id;
    }

    public function getCustomer()
    {
        return $this;
    }

    public function getCustomerName()
    {
        return $this->name . " " . $this->last_name;
    }

    public function getCustomerEmail()
    {
        return $this->email;
    }

    public function getAllCustomers()
    {
        $db = new DB();
        $db->query("SELECT * FROM customers");
        $customers = $db->resultset();
        return $customers;
    }

    public function create()
    {
        try {
            $db = new DB();
            $db->query("INSERT INTO customers (id, order_id, name, last_name, email, phone, street, city, zip, state, country, payment_method, payment_transaction_id, paypal_payer_id, payment_date, lineItems, total) VALUES (:id, :order_id, :name, :last_name, :email, :phone, :street, :city, :zip, :state, :country, :payment_method, :payment_transaction_id, :paypal_payer_id, :payment_date, :lineItems, :total)");
            $db->bind(":id", $this->id);
            $db->bind(":order_id", $this->order_id);
            $db->bind(":name", $this->name);
            $db->bind(":last_name", $this->last_name);
            $db->bind(":email", $this->email);
            $db->bind(":phone", $this->phone);
            $db->bind(":street", $this->street);
            $db->bind(":city", $this->city);
            $db->bind(":zip", $this->zip);
            $db->bind(":state", $this->state);
            $db->bind(":country", $this->country);
            $db->bind(":payment_method", $this->payment_method);
            $db->bind(":payment_transaction_id", $this->payment_transaction_id);
            $db->bind(":paypal_payer_id", $this->paypal_payer_id);
            $db->bind(":payment_date", $this->payment_date);
            $db->bind(":lineItems", $this->lineItems);
            $db->bind(":total", $this->total);

            $db->execute();

            if ($db->lastInsertId()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update()
    {
        $db = new DB();
        $db->query("UPDATE customers SET name = :name, last_name = :last_name, email = :email, phone = :phone, , street = :street, city = :city, zip = :zip, state = :state, country = :country, payment_method = :payment_method, payment_transaction_id = :payment_transaction_id, paypal_payer_id = :paypal_payer_id, payment_date = :payment_date, lineItems = :lineItems, total = :total WHERE id = :id");
        $db->bind(":id", $this->id);
        $db->bind(":name", $this->name);
        $db->bind(":last_name", $this->last_name);
        $db->bind(":email", $this->email);
        $db->bind(":phone", $this->phone);
        $db->bind(":street", $this->street);
        $db->bind(":city", $this->city);
        $db->bind(":zip", $this->zip);
        $db->bind(":state", $this->state);
        $db->bind(":country", $this->country);
        $db->bind(":payment_method", $this->payment_method);
        $db->bind(":payment_transaction_id", $this->payment_transaction_id);
        $db->bind(":paypal_payer_id", $this->paypal_payer_id);
        $db->bind(":payment_date", $this->payment_date);
        $db->bind(":lineItems", $this->lineItems);
        $db->bind(":total", $this->total);
        $db->execute();
    }

    public function delete()
    {
        $db = new DB();
        $db->query("DELETE FROM customers WHERE id = :id");
        $db->bind(":id", $this->id);
        $db->execute();
    }
}
