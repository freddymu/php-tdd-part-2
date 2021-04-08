# language: id
Fitur: Keranjang Belanja
  Untuk membeli produk
  Sebagai pelanggan
  Saya harus bisa memasukkan produk yang menarik ke dalam keranjang

  Dasar:
  - PPN sebesar 20%
  - Pengiriman untuk keranjang di bawah £10 adalah £3
  - Pengiriman untuk keranjang di atas £10 adalah £2

  Skenario: Buying a single product under £10
    Jika there is a "Sith Lord Lightsaber", which costs £5
    Ketika I add the "Sith Lord Lightsaber" to the basket
    Maka I should have 1 product in the basket
    Dan the overall basket price should be £9

  Skenario: Buying a single product over £10
    Jika there is a "Sith Lord Lightsaber", which costs £15
    Ketika I add the "Sith Lord Lightsaber" to the basket
    Maka I should have 1 product in the basket
    Dan the overall basket price should be £20

  Skenario: Buying two products over £10
    Jika there is a "Sith Lord Lightsaber", which costs £10
    Dan there is a "Jedi Lightsaber", which costs £5
    Ketika I add the "Sith Lord Lightsaber" to the basket
    Dan I add the "Jedi Lightsaber" to the basket
    Maka I should have 2 products in the basket
    Dan the overall basket price should be £20
