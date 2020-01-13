<?php
declare(strict_types=1);

namespace Fatkulnurk\Session\Sessions;

class Session
{
    /**
     * Memulai session dengan menggunakan function `session_start()` yang build in php
     */
    public static function start(): void
    {
        // run PHP's built-in equivalent
        if (\session_status() == PHP_SESSION_NONE) {
            \session_start();
        }
    }

    /**
     * Mengembalikan atau menetapkan ID sesi saat ini
     * Untuk mengubah ID sesi saat ini, berikan ID baru sebagai satu-satunya argumen untuk metode ini
     * Harap perhatikan bahwa jarang diperlukan versi metode ini yang * memperbarui * ID
     * Untuk sebagian besar tujuan, Anda mungkin menemukan metode `regenerasi` dari kelas yang sama ini lebih bermanfaat     *
     *
     * @param string|null $newId  (optional) ID sesi baru untuk menggantikan ID sesi saat ini
     * @return string ID sesi (lama) atau string kosong
     */
    public static function id($newId = null)
    {
        if ($newId === null) {
            return \session_id();
        }
        else {
            return \session_id($newId);
        }
    }

    /**
     * Menghasilkan kembali ID sesi dengan cara yang kompatibel dengan fungsi `session_regenerate_id ()` bawaan PHP
     * @param bool $deleteOldSession apakah akan menghapus sesi lama atau tidak
     */
    public static function regenerate(bool $deleteOldSession = false)
    {
        // run PHP's built-in equivalent
        \session_regenerate_id($deleteOldSession);
    }

    /**
     * Cek apakah ada nilai untuk kunci yang ditentukan dalam sesi
     * @param string $key key untuk diperiksa
     * @return bool apakah ada nilai untuk kunci yang ditentukan atau tidak
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Mengembalikan nilai yang diminta dan menghapusnya dari sesi
     * Ini identik dengan memanggil `get` dulu dan kemudian` hapus` untuk kunci yang sama
     * @param string $key keyuntuk mengambil dan menghapus nilai untuk
     * @param mixed $defaultValue nilai default untuk kembali jika nilai yang diminta tidak dapat ditemukan
     * @return mixed|null nilai yang diminta atau nilai default
     */
    public static function take(string $key, $defaultValue = null)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }
        else {
            return $defaultValue;
        }
    }

    /**
     * Mengembalikan nilai yang diminta dari sesi atau, jika tidak ditemukan, nilai default yang ditentukan
     *
     * @param string $key key untuk mengambil nilai
     * @param mixed $defaultValue nilai default untuk kembali jika nilai yang diminta tidak dapat ditemukan
     * @return mixed|null nilai yang diminta atau nilai default
     */
    public static function get(string $key, $defaultValue = null)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        else {
            return $defaultValue;
        }
    }

    /**
     * Menetapkan nilai untuk kunci yang ditentukan ke nilai yang diberikan
     * Setiap data yang sudah ada untuk kunci yang ditentukan akan ditimpa
     * @param string $key key untuk set value
     * @param mixed $value value untuk di set
     * @return bool hasil pengembaliannya
     */
    public static function set(string $key, $value): bool
    {
        try {
            $_SESSION[$key] = $value;
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Menghapus nilai untuk kunci yang ditentukan dari session.
     * @param string $key key yang spesifik
     * @return bool hasil penghapusannya
     */
    public static function delete(string $key): bool
    {
        try {
            unset($_SESSION[$key]);
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /*
     * Terispirasi dari
     * https://github.com/delight-im/PHP-Cookie/blob/master/src/Session.php
     * */
}