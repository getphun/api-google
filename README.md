# api-google

Google API provider. Module ini menyediakan service dengan nama `google` yang bisa
di akses dari kontroler dengan perintah `$this->google->{method}`.

Modul `google` membutuhkan file json yang berisi service account google untuk 
autentikasi api yang disimpan di `./etc/api-google.json`. Silahkan ikuti
[langkah pembuatan service account](#).

## Contoh

Mengambil token untuk google analytics:

```php
$token = $this->google->forRAnalytics()->getAccessToken();
// Array
// (
//     [access_token] => ya29.EllgBAP-T7VeXxhAiOqMI--...
//     [token_type] => Bearer
//     [expires_in] => 3600
//     [created] => 1496634988
// )
```