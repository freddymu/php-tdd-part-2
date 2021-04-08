# language: id
Fitur: Keranjang Belanja
  Untuk membeli produk
  Sebagai pelanggan
  Saya harus bisa memasukkan produk yang menarik ke dalam keranjang

  Dasar:
  - PPN sebesar 20%
  - Pengiriman untuk keranjang di bawah Rp100000 adalah Rp30000
  - Pengiriman untuk keranjang di atas Rp100000 adalah Rp20000

  Skenario: Membeli satu produk di bawah Rp100000
    Jika ada "Sith Lord Lightsaber", dengan harga Rp50000
    Ketika Saya menambahkan "Sith Lord Lightsaber" ke keranjang
    Maka Saya harus memiliki 1 produk di keranjang
    Dan harga keranjang keseluruhan Rp90000

  Skenario: Membeli satu produk di atas Rp100000
    Jika ada "Sith Lord Lightsaber", dengan harga Rp150000
    Ketika Saya menambahkan "Sith Lord Lightsaber" ke keranjang
    Maka Saya harus memiliki 1 produk di keranjang
    Dan harga keranjang keseluruhan Rp200000

  Skenario: Membeli dua produk di atas Rp100000
    Jika ada "Sith Lord Lightsaber", dengan harga Rp120000
    Dan ada "Jedi Lightsaber", dengan harga Rp150000
    Ketika Saya menambahkan "Sith Lord Lightsaber" ke keranjang
    Dan Saya menambahkan "Jedi Lightsaber" ke keranjang
    Maka Saya harus memiliki 2 produk di keranjang
    Dan harga keranjang keseluruhan Rp270000
