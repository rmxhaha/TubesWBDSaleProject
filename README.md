# Tugas 1 IF3110 Pengembangan Aplikasi Berbasis Web

Membuat Website Marketplace sederhana.

## Deskripsi Singkat

Pada tugas besar ini, Anda diminta untuk membuat aplikasi *marketplace* **berbasis web** yang memungkinkan seorang pengguna membeli dan menjual barang. Untuk menggunakan aplikasi ini, pengguna harus login terlebih dahulu. Pengguna tersebut dapat membeli dan menjual barang dengan akun yang sama.


## Anggota Tim
1. Candra Ramsi (13514090)
2. Heri Fauzan (13513028)
3. Muhammad Ikhsan (13511064)

## Technology require for running this program

1. PHP 5
2. MySQL
3. A browser

## Spesifikasi

### Login

![](mocks/login.jpg)

Pengguna dapat melakukan login sebagai user. Login hanya membandingkan username dan password saja, dan tidak perlu proteksi apapun. Halaman ini merupakan halaman pertama yang dibuka oleh pengguna ketika menjalankan aplikasi. Tidak ada proses otentikasi apakah pengguna sudah login atau belum dalam page lainnya. Identitas pengguna yang sedang login diberikan melalui HTTP GET pada URL (sebagai contoh: /catalog.php?id_active=2 menandakan bahwa pengguna yang sedang login memiliki id pengguna = 2).

### Register

![](mocks/register.jpg)

Pengguna dapat mendaftarkan diri sebagai user agar dapat menggunakan aplikasi ini. Hanya terdapat **satu** jenis user, yaitu user yang dapat membeli sekaligus menjual barang. Anda harus melakukan validasi bahwa email dan username yang sama tidak boleh digunakan untuk dua kali mendaftar. Setelah selesai register, otomatis masuk ke halaman Catalog dengan keadaan sudah login.

### Catalog

![](mocks/catalog.jpg)

Catalog merupakan halaman utama yang ditampilkan ketika user telah login. Catalog menampilkan list barang yang dijual oleh seluruh pengguna. Barang-barang tersebut ditampilkan terurut dimulai dari barang yang baru ditambahkan.

Perlu diperhatikan, tulisan di atas tombol logout memiliki format "Hi, <<username>>!". Selanjutnya, terdapat menu bar yang menampilkan 5 menu utama seperti pada gambar. Menu yang sedang dibuka diberikan warna background yang berbeda sebagai penanda halaman apa yang sedang dibuka pengguna.

Lalu, terdapat search bar. Pengguna dapat mencari barang dengan melakukan search ke `username (store)` atau `nama barang (product)` sesuai dengan pilihan pada radio button di bawah search bar.

Pada list barang, pengguna dapat membeli (buy) dan menyukai (like) barang. Terdapat juga informasi jumlah like dan jumlah barang tersebut yang sudah laku (purchased).

Ketika pengguna menekan tombol like, halaman tidak boleh refresh dan jumlah like akan berubah dan tersimpan ke basis data. **Fungsionalitas Like diimplementasi dengan menggunakan AJAX**. Selain itu, tulisan like akan berubah menjadi **Liked** dan **berubah warna menjadi merah**. Jumlah like akan berubah sesuai dengan banyaknya like pada basis data (jadi tidak asal nambah satu saja). Hal tersebut juga berlaku sebaliknya (unlike). Unlike dapat dilakukan dengan menekan tombol Liked.

Ketika pengguna menekan tombol buy, pengguna akan menuju halaman confirmation purchase.

### Confirmation Purchase

![](mocks/confirmation_purchase.jpg)

Pada halaman ini, pengguna harus mengisi identitas terkait pengiriman barang. Pada field selain credit card number, sudah terisi sesuai dengan data pengguna namun tetap dapat diubah. Untuk field quantity memiliki nilai default 1. Total harga otomatis dihitung dengan menggunakan javascript. Lakukan konfirmasi pembelian terlebih dahulu dengan javascript, seperti “Apakah data yang anda masukan benar?”. Setelah mengkonfirmasi, pengguna akan diarakahkan ke halaman *Purchases*.

### Your Products

![](mocks/your_products.jpg)

Halaman ini berisikan list barang yang dijual oleh pengguna. Pada menu ini, pengguna dapat melakukan edit dan delete pada barang. Untuk delete, lakukan konfirmasi penghapusan terlebih dahulu dengan javascript.

### Add Product

![](mocks/add_product.jpg)

Pengguna dapat menambahkan barang yang ingin dijual. Gunakan HTTP POST.  *Redirect* ke halaman *Your Products* setelah selesai menambahkan.

### Edit Product

![](mocks/edit_product.jpg)

Pengguna dapat mengubah info barang yang sudah dibuat. Form yang digunakan memiliki tampilan yang sama dengan form untuk add product, namun field-field yang ada sudah terisi. Gunakan HTTP POST. Untuk memudahkan pengerjaan, gambar tidak dapat diganti. *Redirect* ke halaman *Your Products* setelah selesai merubah.

### Sales

![](mocks/sales.jpg)

Halaman ini berisi histori penjualan barang yang dijual oleh pengguna. Apabila data barang tersebut diubah/dihapus, tidak mempengaruhi histori (tetap seperti pada data ketika dilakukan pembelian).

### Purchases

![](mocks/purchases.jpg)

Halaman ini berisi histori pembelian barang oleh pengguna. Apabila data barang tersebut diubah/dihapus, tidak mempengaruhi histori (tetap seperti pada data ketika dilakukan pembelian).

### Pembagian Tugas
*Disarankan semua anggota kelompok mengerjakan tampilan dan fungsionalitasnya. Bukan hanya tampilan atau fungsionalitasnya saja*

**Tampilan**
1. Login : 13513028, 13514090
2. Register : 13513028, 13514090
3. Header : 13513028, 13514090
4. Catalog : 13514090
5. Confirmation Purchase : 13514090
6. Your Products : 13514090
7. Add Product : 13514090
8. Edit Product : 13514090
9. Sales : 13514090
10. Purchase : 13514090

**Fungsionalitas**
1. Login : 13514090
2. Register : 13513028, 13514090
3. Catalog : 13514090
4. Confirmation Purchase : 13514090
5. Your Products : 13514090
6. Add Product : 13514090
7. Edit Product : 13514090
8. Sales : 13514090
9. Purchase : 13514090

## About

Asisten IF3110 2016

Adin | Chairuni | David | Natan | Nilta | Tifani | Wawan | William

Dosen : Yudistira Dwi Wardhana | Riza Satria Perdana
