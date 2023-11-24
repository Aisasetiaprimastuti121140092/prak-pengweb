<?php

class InvalidNameException extends InvalidArgumentException {}
class InvalidNipException extends InvalidArgumentException {}
class InvalidDepartemenException extends InvalidArgumentException {}
class InvalidAlamatException extends InvalidArgumentException {}

class Validator {
    public static function validateName($nama) {
        $regex = '/^[a-zA-Z\s]+$/';
        if (!preg_match($regex, $nama)) {
            throw new InvalidNameException("Nama '$nama' harus terdiri dari huruf dan spasi.");
        }
    }

    public static function validateNip($nip) {
        $regex = '/^[0-9]{9}$/';
        if (!preg_match($regex, $nip)) {
            throw new InvalidNipException("NIP '$nip' harus terdiri dari 9 digit angka.");
        }
    }

    public static function validateDepartemen($departemen) {
        $regex = '/^[a-zA-Z\s]+$/';
        if (!preg_match($regex, $departemen)) {
            throw new InvalidDepartemenException("Departemen '$departemen' harus terdiri dari huruf dan spasi.");
        }
    }

    public static function validateAlamat($alamat) {
        $regex = '/^[a-zA-Z0-9\s\.,#-]+$/';
        if (!preg_match($regex, $alamat)) {
            throw new InvalidAlamatException("Alamat '$alamat' harus terdiri dari huruf, angka, dan karakter khusus.");
        }
    }
}

class Employee {
    protected $nama;

    public function setNama($nama) {
        Validator::validateName($nama);
        $this->nama = $nama;
    }

    public function getNama() {
        return $this->nama;
    }
}

class OfficeEmployee extends Employee {
    private $nip;
    private $departemen;
    private $alamat;

    public function __construct($nama, $nip, $departemen, $alamat) {
        parent::setNama($nama);
        $this->setNip($nip);
        $this->setDepartemen($departemen);
        $this->setAlamat($alamat);
    }

    public function setNip($nip) {
        Validator::validateNip($nip);
        $this->nip = $nip;
    }

    public function setDepartemen($departemen) {
        Validator::validateDepartemen($departemen);
        $this->departemen = $departemen;
    }

    public function setAlamat($alamat) {
        Validator::validateAlamat($alamat);
        $this->alamat = $alamat;
    }

    public function getNip() {
        return $this->nip;
    }

    public function getDepartemen() {
        return $this->departemen;
    }

    public function getAlamat() {
        return $this->alamat;
    }
}

try {
    $pegawai = new OfficeEmployee("Aisa Setia Primastuti", "121140092A", "Human Resources", "123 Main Street");
    echo "Nama: " . $pegawai->getNama();
} catch (InvalidArgumentException $error) {
    echo "Error: " . $error->getMessage(). "\n";
}

?>

