<?php

namespace App\Services\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class SupplierDTO
{
    private ?int $id;
    private string $name;
    private string $type;
    private string $document;
    private string $email;
    private string $phone;
    private string $address;

    /**
     * Create a new class instance.
    */

    public function __construct(?int $id, string $name, string $type, string $document,string $email, string $phone, string $address,)
    {
        $this->name = $name;
        $this->type = $type;
        $this->document = $document;
        $this->email= $email;
        $this->phone = $phone;
        $this->address = $address;
    }

    public function setId(?int $id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setType(string $type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setDocument(string $document) {
        $this->document = $document;
    }

    public function getDocument() {
        return $this->document;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPhone(string $phone) {
        $this->phone = $phone;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setAddress(string $address) {
        $this->address = $address;
    }

    public function getAddress() {
        return $this->address;
    }

    public function toArray()
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "type" => $this->type,
            "document" => $this->document,
            "email"=> $this->email,
            "phone" => $this->phone,
            "address" => $this->address,
        ];
    }

    public static function fromArray(array $data){
        return new SupplierDTO(
            $data["id"] ?? null,
            $data["name"] ,
            $data["type"] ,
            $data["document"] ,
            $data["email"] ,
            $data["phone"] ,
            $data["address"]
        );
    }

    public static function fromRequest(Request $request)
    {
        return (new self(
            $request->id,
            $request->name,
            $request->type,
            $request->document,
            $request->email,
            $request->phone,
            $request->address,
        ));
    }

}
